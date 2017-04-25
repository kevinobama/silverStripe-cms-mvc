<?php

	class Notification extends DataObject {

		private static $has_one = array(
			'Member' => 'Member',
			'Feed' => 'Feed'
			
		);
	}