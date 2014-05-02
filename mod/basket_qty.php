<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('../inc/autoload.php');

if(isset($_POST['qty']) && isset($_POST['id'])){
    $out = array();
    
    $id = $_POST['id'];
    $val = $_POST['qty'];
    
    $objCatalogue = new Catalogue();
    $product = $objCatalogue->getProduct($id);
    
    if(!empty($product)){
        
        switch ($val){
            case 0:
                Session::removeItem($id);
                break;
            default :
                Session::setItem($id, $val);
        }
    }
}