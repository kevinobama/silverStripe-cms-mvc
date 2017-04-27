<?php
class Walkthrough extends DataObject  {

		private static $db = array(
	        'Text' => 'Text',
            'Sort' => 'Int',
            'Page' => 'Varchar(255)'
	    );

        private static $defaults = array(
            'Sort' => 0,
            'Page' => 'all',
        );

	    private static $summary_fields = array(
          'ID',
          'Text',
          'Sort'
        );
}