<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validation
 *
 * @author WASEEM
 */
class Validation{
    
   //form object
   private $objForm;
   
   //storing all error ids
   private $_errors = array();
   
   //validation msg
   public $_msg = array(
       "first_name" => "Please provide your first name",
       "last_name" => "Please provide your last name",
       "address" => "Please provide your address",
       "town" => "Please provide your town name",
       "county" => "Please privde your county name",       
       "post_code" => "Please provide your post code",
       "country" => "Please provide your country name",
       "email" => "Please provide your valid email address",
       "login" => "Username and/or password are incorrect",
       "Password" => "Please chose a password",
       "confirm_password" => "Please confirm your password",
       "password_mismatch" => "passwords did not match",
       "email_duplicate" => "This email address is already taken",
       "category" => "Please select the category",
       "name" => "Please provide a name",
       "description" => "Please provide a description",
       "price" => "Please provide a price"
   );
   
   //list of expected fields
   public $_expected = array();
   
   //list of required fields
   public $_required = array();
   
   
   // list of special validation fields
   // array('field_name' => 'format')
   
   public $_special = array();
   
    // post array
    public $_post = array();
    
    // fields to be removed from post array
    public $_post_remove = array();
    
    //fields to be specifically formatted
    public $_post_format = array();
    
    
    public function __construct($objForm) {
        $this->objForm = $objForm;
    }
    
    
    public function proccess() {
        if($this->objForm->isPost && !empty($this->_required)){
            //get only espected fields
            $this->_post = $this->objForm->getPostArray($this->_expected);
            if(!empty($this->_post)){
                foreach ($this->_post as $key => $value) {
                    $this->check($key,$value);
                }
            }
        }
    }
    
    
    public function add2Errors($key) {
        
        $this->_errors[$key];
        
    }
    
    
    public function check($key,$value) {
        if(!empty($this->_special) && array_key_exists($key, $this->_special)){
            $this->checkSpecial($key,$value);
        }else{
            if(in_array($key, $this->_required) && empty($value)){
                $this->add2Errors($key);
            }
        }
    }
    
    
    public function checkSpecial($key,$value) {
        switch ($this->_special[$key]) {
            case 'email':
                if(!$this->isEmail($value)){
                    $this->add2Errors($key);
                }
                break;
        }
    }
    
    
    public function isEmail($email = null) {
        
        if(!empty($email)){
            $result = filter_var($email, FILTER_VALIDATE_EMAIL);
            return !$result ? FALSE : TRUE;
        }
        return FALSE;        
    }
    
    
    public function isValid() {
        
        $this->proccess();
        if(empty($this->_errors) && !empty($this->_post)){
            //remove all unwanted fields
            if(!empty($this->_post_remove)){
                foreach ($this->_post_remove as $value) {
                    unset($this->_post[$value]);
                }
            }
            //format all required fields
            if(!empty($this->_post_format)){
                foreach ($this->_post_format as $key => $value) {
                    $this->format($key,$value);
                }
            }
            return TRUE;
        }
        return FALSE;        
    }
    
    
    public function format($key, $value) {
        switch ($value) {
            case 'password':
                $this->_post[$key] = Login::string2hash($this->_post[$key]);
                break;
        }
    }
    
    
    public function validate($key) {
        
        if(!empty($this->_errors) && in_array($key, $this->_errors)){
            return $this->wrapWarn($this->_msg[$key]);
        }        
    }
    
    
    public function wrapWarn($mess = null){
        if(!empty($mess)){
            return "<span class=\"warn\">{$mess}</span>";
        }
    }
    
    
}