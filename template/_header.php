<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$objCatalogue = new Catalogue();
$cats = $objCatalogue->getCategories();

$objBusiness = new Buisness();
$business = $objBusiness->getBusiness();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>E-commerce Website</title>
        <meta http-equiv="Content-Type" content="text/html" />
        <meta name="description" content="Ecommerce website project" />
        <meta name="keywords" content="Ecommerce website project" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="/css/core.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header">
            <div id="header_in">
                <h5><a href="/"><?php echo $business['name']; ?></a></h5>
                <?php
                    if(Login::isLogged(Login::$_login_front)){
                        echo '<div id="logged_as">Looged in as:<strong>';
                        echo Login::getFullNameFront(Session::getSession(Login::$_login_front));
                        echo '</strong> | <a href="/?page=orders">My orders</a>';
                        echo '| <a href="/?page=lougout">Logout</a></div>';
                    }else{
                        echo '<div id="logged_as"><a href="/?page=login>Login</a></div>"';
                    }
                
                ?> 
            </div>
        </div>
        <div id="wrapper">
            <div id="left">
                <?php require_once ('basket_left.php'); ?>
                <?php if (!empty($cats)){ ?>
                
                <h2>Categoties</h2>
                <ul id="navigation">
                    <?php 
                        foreach ($cats as $cat) {
                        echo "<li><a href=\"/?page=catalogue&amp;category=".$cat['id']."\"";
                        echo Helper::getActive(array('category' => $cat['id']));
                        echo ">";
                        echo Helper::encodeHTML($cat['name']);
                        echo "</a></li>";
                        }
                    ?>
                </ul>
                
                <?php    
                }
                ?>
            </div>
            
        </div>
    </body>
</html>