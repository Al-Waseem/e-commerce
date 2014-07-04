<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author WASEEM
 */
class Application {
    
    public $db;

    public function __construct()
    {		
    	$this->db = new Dbase();
    }
    
}
