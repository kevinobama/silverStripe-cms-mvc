<?php
class Walkthrough extends DataObject  {

		private static $db = array(
	        'Text' => 'Text',
            'Sort' => 'Int'
	    );

        private static $defaults = array(
            'Sort' => 0,
        );

	    private static $summary_fields = array(
          'ID',
          'Text',
          'Sort'
        );
}