<?php
class Slider extends DataObject{
	private static $db = array(
		'Content' => 'HTMLText',
		'LinkText' => 'Varchar',
		'LinkURL' => 'Varchar',
		'VideoURL' => 'Varchar',
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'HomePage' => 'HomePage',
		'Sfondo' =>'Image',
		'Image' => 'Image',
	);

	static $summary_fields = array(
		'ID' => 'ID',
		'Image.CMSThumbnail' => ''
	);

	public static $default_sort = 'SortOrder';

	public function getCMSFields() {
        $fields = parent::getCMSFields();  
       
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Text'));
        $fields->addFieldToTab('Root.Main', TextField::create('LinkText', 'Link Text'));
        $fields->addFieldToTab('Root.Main', TextField::create('LinkURL', 'Link URL'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Sfondo', 'Background'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image'));

        return $fields;
    }

}