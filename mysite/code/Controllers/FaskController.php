<?php
//http://silverstripelocal/orders
//http://silverstripelocal/orders/add
//class Fask extends Page {}

class FaskController extends Page_Controller {

    public function index(SS_HTTPRequest $request) {

		$order = Order::create();
		$order->OrderNumber = date('Y-m-d H:i:s');
		$order->status = "1";
		$id = $order->write();

        $orders = Order::get()->sort('ID','DESC')
                              ->limit(5);

        foreach($orders as $order) {
            echo("<li>".$order->OrderNumber);
        }
        
        return $this->renderWith("Show");
    }

    public function add(SS_HTTPRequest $request) {

        $order = Order::create();
        $order->OrderNumber = rand();
        $order->status = "1";
        $id = $order->write();

        return array(
            'Title' => 'add orders'
        );        
    }
}