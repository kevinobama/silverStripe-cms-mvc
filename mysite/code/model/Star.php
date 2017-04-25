<?php

	class Star extends Member {

		private static $db = array(
			'Banner' => 'Text',
	        'Teaser' => 'Text',
	        'Youtube' => 'Text',
	        'Twitter' => 'Text',
	        'Facebook' => 'Text',
	        'Instagram' => 'Text',
	        'Video' => 'Varchar',
	        'ChannelsTitle' => 'Varchar',
	        'ChannelsName' => 'Varchar',
	        'BookTimer' => 'Boolean',
	        'Active' => 'Boolean',
	        'BookActive' => 'Boolean',
	        'SpecialNewsActive' => 'Boolean',
            'SpecialNews' => 'HTMLText',
            'SpecialNewsClaim' => 'HTMLText',
		);

		private static $has_one = array(
			'NewsImage' => 'Image',
			"MemberManager" => "Member",
	        'newsFBimage' => 'Image',
	        'faskFBimage' => 'Image' ,
	        'fanswerFBimage' => 'Image',
	        
		);

		private static $has_many = array(
			'Book' => 'Book',
			// 'StarPage' => 'StarPage'
		);

		private static $many_many = array(
			'Category' => 'Category',
			
		);

		private static $belongs_many_many = array(
			"Member" => "Member"
		);

		public  function getCMSFields(){
		    $fields = parent::getCMSFields();
		    $managers = Group::get()->byID(4);
		    $memberManager = $managers->Members()->map('ID', 'Email')->toArray();
		    $managerSelect = DropdownField::create('MemberManagerID', 'Manager')->setSource($memberManager);
		    $video = TextField::create('Video', 'Video');
		    // $coloriList = Colori::get()->sort('Name')->map('ID', 'CodiceNome')->toArray();
		    // $coloriSelect = DropdownField::create('ColoriID', 'Colori')->setSource($coloriList);

		    $fields->replaceField('MemberManagerID', $managerSelect);
		    $fields->insertAfter( $video, 'MemberManagerID');
		    $fields->addFieldToTab('Root.News', HTMLEditorField::create('SpecialNews', 'News Text'));
            $fields->addFieldToTab('Root.News', HTMLEditorField::create('SpecialNewsClaim', 'News Claim'));
            $fields->addFieldToTab('Root.News', UploadField::create('NewsImage','News Image')); 
            $fields->addFieldToTab('Root.News', CheckboxField::create('SpecialNewsActive','Active'));
		    return $fields;
		}

		public function StarPage(){
			$page = StarPage::get()->filter(array("StarID" => $this->ID, "Locale" => Translatable::get_current_locale()))->First();
			return $page;
		}

		public function getAge(){
			$birth = new DateTime($this->StarPage()->Birth);
			$now = new DateTime('today');
			$age = $now->diff($birth)->y;
			return $age;
		}
	}