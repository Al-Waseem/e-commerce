<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Buisness
 *
 * @author WASEEM
 */
class Buisness extends Application {
    
    private $_table = 'buisness';
    
    public function getBusiness() {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `ID` = 1";
        
        return $this->db->fetchOne($sql);
    }
    
    
    public function getVatRate(){
        $buisness = $this->getBusiness();
        return $buisness['vat_rate'];
    }
    
    
    
}
