<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	'type' => 'MySQLPDODatabase',
	'server' => 'localhost',
	'username' => 'kevingates',
	'password' => '654321',
	'database' => 'silverstripelocal',
	'path' => ''
);

// Set the site locale
i18n::set_locale('en_US');
CMSMenu::remove_menu_item('help');
