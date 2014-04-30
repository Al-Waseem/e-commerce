<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dbase
 *
 * @author WASEEM
 */
class Dbase {
    
    private $_host = "localhost";
    private $_user = "root";
    private $_password = "password";
    private $_dbName = "ecommerce";
    
    private $_connectDB = false;
    
    public $_last_query = null;
    public $_affected_rows = 0;
    
    public $_insert_keys = array();
    public $_insert_values = array();
    public $_update_sets = array();
    
    public $_id;
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        $this->_connectDB = mysql_connect($this->_host,  $this->_user, $this->_password);
        
        if(!$this->_connectDB){
            die("Connection to database failed: <br/>" . mysql_error());
        }else {
            $_select = mysql_select_db($this->_dbName, $this->_connectDB);
            
            if(!$_select){
                die("Database selection failed:<br/>" . mysql_error());
            }
        }
        
        mysql_set_charset("utf8", $this->_connectDB);
    }
    
    
    public function close() {
        if(!mysql_close($this->_connectDB)){
            die("Closing connection failed");
        }
    }
    
    public function escape($value) {
        if(function_exists("mysql_real_escape_string")){
            if(get_magic_quotes_gpc()){
                $value = stripcslashes($value);
            }
            $value = mysql_real_escape_string($value);
        }else{
            if(get_magic_quotes_gpc()){
                $value= addslashes($value);
            }
        }
        
        return $value;
    }
    
    public function query($sql) {
        $this->_last_query = $sql;
        $result = mysql_query($sql, $this->_connectDB);
        $this->displayQuery($result);
        return $result;
    }
    
    public function displayQuery($result){
        if(!$result){
            $output = "Database query failed:<br/>". mysql_error();
            $output.= "Last SQL query was:" . $this->_last_query;
        }else{
            $this->_affected_rows= mysql_affected_rows($this->_connectDB);
        }
    }
    
    public function fetchAll($sql) {
        $result = $this->query($sql);
        $out =array();
        while ($row = mysql_fetch_assoc($result)){
            $out[] = $row;
        }
        mysql_free_result($result);
        return $out;
    }
    
    public function fetchOne($sql) {
        $out = $this->fetchAll($sql);
        return array_shift($out);
    }
    
    public function lastId() {
        return mysql_insert_id($this->_connectDB);
    }
}
