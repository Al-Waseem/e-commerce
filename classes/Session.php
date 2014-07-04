<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author WASEEM
 */
class Session {
    
    public static function setItem($id, $qty = 1) {
        $_SESSION['basket'][$id]['qty'] = $qty;
    }
    
    
    public static function removeItem($id, $qty = null){
        if($qty != NULL && $qty < $_SESSION['basket'][$id]['qty']){
            $_SESSION['basket'][$id]['qty'] = 
                    ($_SESSION['basket'][$id]['qty'] - $qty);
        }else{
            $_SESSION['basket'][$id] = NULL;
            unset($_SESSION['basket'][$id]);
        }
    }
    
    public static function getSession($name = null){
        if(!empty($name)){
            return isset($_SESSION[$name]) ? $_SESSION[$name] :null;
        }
    }
    
    public static function setSession($name = null, $value = null){
        if(!empty($name) && !empty($value)){
            $_SESSION[$name]= $value;
        }
    }
}
