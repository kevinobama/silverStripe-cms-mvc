<?php

	class Star_Category extends DataObject {

		private static $has_one = array(
			"StarCategory" => "StarCategory",
			"Star"	=> "Star"
		);

	}