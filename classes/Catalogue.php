<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Catalogue
 *
 * @author WASEEM
 */
class Catalogue extends Application {
    
    private $_table = 'categories';
    private $_table_2 = 'products';
    public $_path = 'media/catalogue/';


    public function getCategories() {
        $sql = "SELECT * FROM `{$this->_table}` ORDER BY `name` ASC";
        
        return $this->db->fetchAll($sql);
        
    }
    
    public function getCategory($id) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `id` = '".$this->db->escape($id)."'";
        
        return $this->db->fetchOne($sql);
    }
    
    public function getProducts($cat) {
        $sql = "SELECT * FROM `{$this->_table_2}` WHERE `CATEGORY` = '".$this->db->escape($cat)."' ORDER BY `DATE` DESC";
        
        return $this->db->fetchAll($sql);
    }
    
}
