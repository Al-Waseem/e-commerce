<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$code = Url::getParam('code');

if(!empty($code)){
    $objUser = new User();
    $user = $objUser->getUserByHash($code);
    
    if(!empty($user)){
        if($user['active'] == 0){
            if($objUser->makeActive($user['id'])){
                $mess = "<h1> Thank you for activating your account</h1> ";
                $mess .= "<p>Yoyr account has been activated successfully.<br/>";
                $mess .= "You can log in and continue with your order.</p>";
                
            }else{
                $mess = "<h1> Activation has not been done successfully.</h1><br/><p>Please, try again later.</p>";
            }
        }else{
            $mess = "<h1>Account already ativated </h1>";
        }
    }else{
        Helper::redirect("/?page=error");
    }
    
    require_once ('_header.php');
    
    echo $mess;
    
    require_once ('_header.php');
}else{
    Helper::redirect("/?page=error");
}
