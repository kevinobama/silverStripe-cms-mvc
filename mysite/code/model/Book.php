<?php

    class Book extends DataObject {

        private static $db = array(
            'Title' => 'Varchar',
            'Description_it' => 'Text',
            'Description_en' => 'Text',
            'Description_es' => 'Text',
            'Active' => 'Boolean'
        );

    	 private static $has_one = array(
            'Star' => 'Star',
            'BookCover' => 'Image' ,

        );

    	private static $many_many = array(
    		'BookLink' => 'BookLink',
    	); 

    	 public function getCMSFields() {
	       $fields = parent::getCMSFields();
	       $conf = GridFieldConfig_RecordEditor::create();
	       $conf->addComponent(new GridFieldSortableRows('SortOrder'));
	       $linksField = new GridField(
	            'BookLink',  
	            'BookLink', 
	            $this->BookLink(),
	            $conf
	        );        

	         
	        $fields->addFieldToTab('Root.BookLink', $linksField); 


	       return $fields;
	   }
	   public static $summary_fields = array(
	   	'BookCover.CMSThumbnail' => ''
	   );
      
    }