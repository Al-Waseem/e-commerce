<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$objCatalogue = new Catalogue();
$cats = $objCatalogue->getCategories();

$objBusiness = new Business();
$business = $objBusiness->getBusiness();