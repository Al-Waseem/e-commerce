<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author WASEEM ALKHALEL <waseem_khalel@hotmail.com>
 */
class Admin extends Application {
    
    private $_table = 'admins';
    private $_id;
    
    
    public function isUser($email = null, $password = null) {
        if (!empty($email) && !empty($password)){
            $password = Login::string2hash($password);
            $sql = "SELECT * FROM `{$this->_table}` "
                    . "WHERE `email` = '".$this->db->escape($email)."'"
                    . "AND `password` = '".$this->db->escape($password)."'";
            
            $result = $this->db->fetchOne($sql);
            
            if(!empty($result)){
                $this->_id = $result['id'];
                return TRUE;
            }
            
            return false;
        }
    }
    
}
