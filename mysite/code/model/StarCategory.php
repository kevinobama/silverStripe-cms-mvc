<?php

	class StarCategory extends DataObject {
		private static $db = array(
			'Title' => 'Varchar'
		);

		private static $has_many = array(
			"Star_Category" => "Star_Category",
		);

	}