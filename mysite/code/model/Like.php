<?php

	class Like extends DataObject {
		
		private static $db = array(
			'Read' => 'Boolean'
		);

		private static $has_one = array(
        	'Member' => 'Member',
        	"Feed" => "Feed"
        );
	}