<?php

	class StarAdmin extends ModelAdmin {
		private static $managed_models = array(
	        'Star',
    	);

    	private static $url_segment = 'stars';

    	private static $menu_title = 'Le Star';
	}