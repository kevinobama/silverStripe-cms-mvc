<?php

	class BookAdmin extends ModelAdmin {
		private static $managed_models = array(
	        'Book',
    	);

    	private static $url_segment = 'books';

    	private static $menu_title = 'eBooks';
	}