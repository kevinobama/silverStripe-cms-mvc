<?php

	class Comment extends DataObject {
		
		private static $db = array(
        	'Text' => 'Text',
        	'Read' => 'Boolean'
        );

		private static $has_one = array(
        	'Member' => 'Member',
        	"Feed" => "Feed"
        );
	}