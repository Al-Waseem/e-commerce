<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('../inc/autoload.php');

//token

$token2 = Session::getSession('token2');
$objForm = new Form();
$token1 = $objForm->getPost('token');

if ($token2 == Login::string2hash($token1)) {

    //create order
    $objOrder = new Order();
    if ($objOrder->createOrder()) {

        //publulate order details
        $order = $objOrder->getOrder();
        $items = $objOrder->getOrderItems();

        if (!empty($order) && !empty($items)) {
            $objBasket = new Basket();
            $objCatalogue = new Catalogue();
            $objPayPal = new PayPal();

            foreach ($items as $item) {
                $product = $objCatalogue->getProduct($item['product']);
                $objPayPal->add($item['product'], $item['name'], $item['price'], $item['qty']
                );
            }

            $objPayPal->_tax_cart = $objBasket->_vat;

            //populate client's details
            $objUser = new User();
            $user = $objUser->getUser($order['client']);


            if (!empty($user)) {
                // get user country record
                $objCountry = new Country();
                $country = $objCountry->getCountry($user['country']);
                
                //pass client's details to the paypal instance
                $objPayPal->_populate = array(
                    'address1'  => $user['address_1'],
                    'address2'  => $user['address_2'],
                    'city'      => $user['town'],
                    'state'     => $user['country'],
                    'zip'       => $user['post_code'],
                    'country'   => $country['id'],// code of the country
                    'email'     => $user['email'],
                    'first_name'=> $user['first_name'],
                    'last_name' => $user['last_name']
                );
                
                
                //redirect client to PayPal website
                echo $objPayPal->run($order['id']);
                
            }
        }
    }
}

