<?php
class Order extends Feed {

	private static $db = array(
		"OrderNumber" => "Varchar(255)",
		"status" => "Int",
	);    
}