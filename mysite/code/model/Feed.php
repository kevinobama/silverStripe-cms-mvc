<?php
	class Feed extends DataObject  {

		private static $db = array(
	        'Text' => 'Text',
	       	'OnBook' => 'Boolean',
	        'OnTop' => 'Boolean',
	        'Selected' => 'Boolean',
	        'Pending' => 'Boolean',
	        'Ranking' => 'Int',
	        'RankingFive' => 'Int',
	        'Sticky' => 'Boolean',
            'Read' => 'Boolean',
	    );

	    private static $has_one = array(
	        'Star' => 'Member', 
	        'Member' => 'Member', 
	    );

	    private static $has_many = array(
	        'Comment' => 'Comment',
	        'Like' => 'Like',
	        'Notification' => 'Notification'
	    );

	    private static $defaults = array(
	        'Ranking' => 999,
    	);

	    public function yourComment() {
            
            if ($member = Member::currentUser()){
                $star = Feed::get()->byId($this->ID)->Star();
                $starPage = $star->StarPage();

                $fields = new FieldList(
                    new hiddenField('StarPage', 'StarPage', Director::absoluteBaseURL() . $starPage->URLSegment),
                    new hiddenField('ID', 'ID', $this->ID),
                    TextareaField::create('Text','')->setAttribute('class', 'form-control mb15')
                );

                $actions = new FieldList(
                    FormAction::create('submitComment',  _t('Page.INVIACOMMENTO', 'Invia Commento'))->addExtraClass('btn btn-red')->setAttribute('style', 'color:#fff')
                );

               return Form::create($starPage, 'yourComment', $fields, $actions, new RequiredFields('Text'))->setEncType('multipart/form-data');

             } else {

                 return _t('Page.LOGGEDTOCOMMENT', "Devi essere loggato per commentare");

             }

        }

	    public function getIveLike(){

	    	if($this->ClassName == "Fanswer"){
	    		$myLikes = $this->Fask()->Like()->filter(array("MemberID" => Member::currentUserID()));
	    	} else {
	    		$myLikes = $this->Like()->filter(array("MemberID" => Member::currentUserID()));
	    	}

	    	
	    	if($myLikes->Count() > 0){
	    		return true;
	    	}
	    }
	    
}