<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('../inc/autoload.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    Session::removeItem($id);
}