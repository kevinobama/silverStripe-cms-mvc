<?php

class MemberExtension extends DataExtension
{
    private static $db = array(
        'Country' => 'Varchar(100)',
        'Citta' => 'Varchar(100)',
        'RemainingFask' => 'Int',
        'Fattore' => 'Int',
        'PrivacyPolicy' => 'Boolean',
        'TermsOfUse' => 'Boolean',
        'Lat' => 'Varchar',
        'Lng' => 'Varchar',
    );

    private static $has_one = array(
        'ImageProfile' => 'Image',
        'ImageBg' => 'Image',
    );

    private static $has_many = array(
        'Notification' => 'Notification'
    );

    private static $many_many = array(
        'Star' => 'Star',
    );

    private static $defaults = array(
        'Fattore' => '1000',
        'RemainingFask' => '3',
    );


    private static $belongs_to = array(
        'MessageFrom' => 'Message',
        'MessageTo' => 'Message',
        'Feed' => 'Feed'
    );


    public function getCMSFields() {
        $this->extend('updateCMSFields', $fields);
        return $fields;
    }


    function updateCMSFields(FieldList $fields){
        $fields->addFieldToTab("Root.Main", TextField::create('Lat', 'Latitudine')); 
        $fields->insertAfter((TextField::create('Lng', 'Longitudine')), 'Lat'); 

        $fields->addFieldToTab("Root.Main", UploadField::create('ImageProfile', 'Immagine Profilo'));
        $fields->insertAfter((new UploadField('ImageBg', 'Immagine Background')), 'ImageProfile');


        $CountryField = DropdownField::create('Country', 'Nazione', Helper::getCountries())
               ->setEmptyString('(Seleziona)');

        $fields->replaceField('Country',$CountryField);

    }

    public function getCommentsByTarget(){
        $comments = Comment::get()->filter(array("Feed.MemberID" => $this->owner->ID))->exclude(array("MemberID" => $this->owner->ID));
        return $comments;
    }

    public function getLikeByTarget(){
        $like = Like::get()->filter(array("Feed.MemberID" => $this->owner->ID))->exclude(array("MemberID" => $this->owner->ID));
        return $like;
    }

    public function getNewsFanswer(){

        $feed = News::get()->sort(array('Created' => 'DESC'))->filterByCallback(function($item, $list){
            $itemstar = $item->Star();
            $member = $this->owner;
            $stars = $member->getManyManyComponents('Star');

            if($item->ClassName == "Fanswer"){
                if($item->Fask()->OnBook){
                    return false;
                }
            }

            foreach($stars as $star){


               if($star->ID == $itemstar->ID){
                    return true;
                } 
            }                    
        });

        return $feed;
    }

    public function getNewsFanswerNots(){
        return Notification::get()->filter(array("MemberID" => $this->owner->ID));
    }

    
    public function getNotifications(){


        return  $this->getCommentsByTarget()->filter(array("Read" => 0))->Count() + $this->getLikeByTarget()->filter(array("Read" => 0))->Count() + $this->getNewsFanswerNots()->Count();

    }


    public function getLikes(){
        $likes = Like::get();
        return $likes->filter(array("MemberID" => $this->owner->ID));
    }

    public function isStarManager($starID){
        
        $star = Star::get()->byId($starID);
        $member =$this->owner;
        if($star){
            if ($star->ID == $member->ID) {
                return true;
            }

            if($member->inGroup("Manager")){

                if($star->MemberManagerID == $member->ID){
                    return true;
                }
            }
        }

        return false;
    }

    public function isRelatedEditor($starID){
        
        $star = Star::get()->byId($starID);
        $member =$this->owner;
        $isRelated = false;


        if(!$member->inGroup("BookEditor")){

            return false;
        }

        $related = $member->getManyManyComponents("Star");
        

        foreach($related as $relatedStar){
            if($relatedStar->ID == $star->ID){
				
				
                $isRelated = true;
            }
        }
 
        if(!$isRelated){
            return false;
        }

        return true;
    }

    public function followStar($starID){
        $star = Star::get()->byId($starID);
        $this->owner->Star()->add($star);

    }

    public function getPoints(){

        $like = Like::get()->filter(array("MemberID" => $this->owner->ID));
        $comment = Comment::get()->filter(array("MemberID" => $this->owner->ID));
        $fanswer = Fask::get()->filter(array("MemberID" => $this->owner->ID))->filterByCallback(function($item, $list) {
            return ($item->Fanswer());
        });

        $points = $like->Count()*Helper::getLikePoints() + $comment->Count()*Helper::getCommentPoints() + $fanswer->Count()*Helper::getFanswerPoints();

        return $points;

    }
}





