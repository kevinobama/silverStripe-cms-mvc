<?php
	class News extends Feed  {

	    private static $has_one = array(
	        'VideoUpload' => 'File',
	        'AudioUpload' => 'File',
	        'PictureUpload' => 'File',
	    );
	}