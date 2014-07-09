<?php

$objBasket = new Basket();

?>

<h2>
    Your Basket
</h2>

<dl id="basket_left">
    <dt>No. of items:</dt>
    <dd class="bl_ti"><span><?php echo $objBasket->_number_of_items; ?></span></dd>
    <dt>Sub-total:</dt>
    <dd class="bl_st"><span><?php echo number_format($objBasket->_sub_total,2); ?> <?php echo " ".Catalogue::$_euro ?></span></dd>
    <dt>IVA:(<span><?php echo $objBasket->_vat; ?></span>%)</dt>
    <dd class="bl_vat"><span><?php echo number_format($objBasket->_vat,2); ?> <?php echo " ".Catalogue::$_euro ?></span></dd>
    <dt>Total(inc):</dt>
    <dd class="bl_total"><?php echo number_format($objBasket->_total,2); ?> <?php echo " ".Catalogue::$_euro ?></dd>
</dl>

<div class="dev br_td">&#160</div>
<p><a href="/?page=basket">View Basket</a> | <a href="/page=checkout">Checkout</a></p>
<div class="dev br_td">&#160</div>

