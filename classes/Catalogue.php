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
    public static $_euro = '&euro;';

    public function getCategories() {
        $sql = "SELECT * FROM `{$this->_table}` ORDER BY `name` ASC";

        return $this->db->fetchAll($sql);
    }

    public function getCategory($id) {
        $sql = "SELECT * FROM `{$this->_table}` WHERE `id` = '" . $this->db->escape($id) . "'";

        return $this->db->fetchOne($sql);
    }

    public function getProducts($cat) {
        $sql = "SELECT * FROM `{$this->_table_2}` WHERE `CATEGORY` = '" . $this->db->escape($cat) . "' ORDER BY `DATE` DESC";

        return $this->db->fetchAll($sql);
    }

    public function getProduct($id) {
        $sql = "SELECT * FROM `{$this->_table_2}` WHERE `id` = '" . $this->db->escape($id) . "'";

        return $this->db->fetchOne($sql);
    }
    
    public function getAllProducts($srch = null) {
        $sql = "SELECT * FROM `{$this->_table_2}`";
        if(!empty($srch)){
            $srch = $this->db->escae($srch);
            $sql .= "WHERE `name` LIKE '%{$srch}%' || `id` = `{$srch}`";
        }
        $sql .= " ORDER BY `date` DESC";
        
        return $this->db->fetchAll($sql);
    }
    
    public function addProduct($params = null) {
        if(!empty($params)){
            $params['date'] = Helper::setDate();
            $this->db->prepareInsert($params);
            $out = $this->db->insert($this->_table_2);
            $this->_id = $this->db->_id;
            return $out;
        }
        return false;
    }
    
    public function updateProduct($params = null, $id = null) {
        if(!empty($params) && !empty($id)){
            $this->db->prepareUpdate($params);
            return $this->db->update($this->_table_2,$id);
        }
    }
    
    
    public function removeProduct($id = null) {
        if(!empty($id)){
            $product = $this->getProduct($id);
            if(!empty($product)){
                if(is_file(CATALOGUE_PATH.DS.$product['image'])){
                    unlink(CATALOGUE_PATH.DS.$product['image']);
                }
                $sql = "DELETE FROM `{$this->_table_2}` "
                        . "WHERE `id` = '".$this->db->escape($id)."'";
                
                return $this->db->query($sql);
            }
            return false;
        }
        return false;
    }

}
