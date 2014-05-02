<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("../inc/autoload.php");

$objBasket = new Basket();

$out= array();

$out['bl_ti'] = $objBasket->_number_og_items;
$out['bl_st'] = number_format($objBasket->_sub_total, 2);
$out['bl_vat'] = number_format($objBasket->_vat, 2);
$out['bl_total'] = number_format($objBasket->_total, 2);

echo json_encode($out);
