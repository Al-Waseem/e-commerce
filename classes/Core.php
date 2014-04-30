<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Core
 *
 * @author WASEEM
 */
class Core {
    
    
    public function run() {
        ob_start();
        require_once(Url::getPage());
        ob_get_flush();
    }
}
