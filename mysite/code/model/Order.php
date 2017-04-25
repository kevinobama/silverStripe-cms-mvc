<?php
class Order extends DataObject {

	private static $db = array(
		"OrderNumber" => "Varchar(255)",
		"status" => "Int",
	);    

	
	static $api_access = true;
}