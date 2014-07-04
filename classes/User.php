<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author WASEEM
 */
class User extends Application {
    
    private $_table = "cliens";
    
    public $_id;
    
    
    
    public function isUser($email, $password) {
        $password = Login::string2hash($password);
        $sql = "SELECT * FROM `{$this->_table}` WHERE `email` ='".$this->db->escape($email)."' AND `PASSWORD`= '".$this->db->escape($password)."' aAND 'ACTIVE' = 1";
        
        $result = $this->db->fetchone($sql);
        
        if(!empty($result)){
            $this->_id = $result['id'];
            return true;
        }
        return false;
    }
    
    
    public function addUser($params = null, $password = null){
        if(!empty($params) && !empty($password)){
            $this->db->prepareInsert($params);
            if($this->db->insert($this->_table)){
                
                //send email
                $objEmail = new Email();
                if($objEmail->process(1, array(
                    'email' => $params['email'] ,
                    'first_name' => $params['first_name'] ,
                    'last-name' => $params['last_name'] ,
                    'password' => $password ,
                    'hash' => $params['hash'] ,
                ))){
                return true;
            }
            return false;
        }
        return false;
    }
}


    public function getUserByHash($hash = null){
        if(!empty($hash)){
            $sql = "SELECT * FROM `{$this->_table}`WHERE `hash` = '";
             $sql .= $this->db->escape($hash)."'";

            return $this->db->fetchOne($sql);

        }
    }

    
    public function makeActive($id = null) {
        if(!empty($id)){
            $sql = "UPDATE `{$this->_table}` SET `active` = 1 WHERE `id` = '".$this->db->escape($id)."'";
            return $this->db->query($sql);
        }
    }
    
    
    public function getByEmail($email = NULL) {
        if(!empty($email)){
            $sql = "SELECT `id` FROM `{$this->_table}` WHERE `email` = '".$this->db->escape($email)."' AND `active` = 1";
            
            return $this->db->fetchOne($sql);
        }
    }



    public function getUser($id=NULL) {
        if(!empty($id)){
            $sql = "SELECT * FROM `{$this->_table}` "
            . "WHERE `id` = '".$this->db->escape($id)."'";
            
        return $this->db->fetchOne($sql);
            
        }
    }
        
    
    public function updateUser($array = null, $id){
        if(!empty($array) && !empty($id)){
            $this->db->prepareUpdate($array);
            if($this->db->update($this->_table,$id)){
                return true;;
            }
            return false;
        }
    }

}