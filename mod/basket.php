<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('../inc/autoload.php');

if(isset($_POST['jop']) && isset($_POST['id'])){
    
    $out = array();
    $jop = $_POST['jop'];
    $id = $_POST['id'];
    
    $objCatalogue = new Catalogue();
    $product = $objCatalogue->getProduct($id);
    
    if(!empty($product)){
        switch ($jop){
            case 0:
                Session::removeItem($id);
                $out['jop'] = 1;
                break;
            case 1:
                Session::setItem($id);
                $out['jop'] = 0;
                break;
        }
        
        echo json_encode($out);
    }
}