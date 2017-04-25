<?php

	class AppSlider extends DataObject {
		private static $db = array(
			'Title' => 'Varchar',
			'Link' => 'Text',
            'Locale' => "Enum('en,it,es')",
		);

        private static $has_one = array(
            'AppSlideImage' => 'Image',
                    );


	}