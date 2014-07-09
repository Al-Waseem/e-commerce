<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Login::restrictFront();

$token1 = mt_rand();
$token2 = Login::string2hash($token1);

Session::setSession('token2', $token2);

$objBasket = new Basket();

$out = array();

$session = Session::getSession('basket');

if(!empty($session)){
    $objCatalogue = new Catalogue();
    foreach ($out as $key => $value) {
        
        $out[$key] = $objCatalogue->getProduct($key);
        
    }
}


require_once ('_header.php');
?>

<h1>Order Summary</h1>

<?php if(!empty($out)){ ?>
    
<div id="big_basket">
    <form action="" method="post" id="frm_basket">
        <table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat">
            <tr>
                <th>Item</th>
                <th class="ta_r">Oty</th>
                <th class="ta_r col_15">Price</th>
            </tr>
            <?php            
                foreach ($out as $item) {?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td class="ta_r"><?php echo $session[$item['id']]['qty']; ?></td>
            
            <td class="ta_r"><?php echo Catalogue::$_euro . " " ;
            echo number_format($objBasket->itemTotal($item['price'],$session[$item['id']]['qty']),2);
            ?>
            </td>
            <?php
            }
            ?>
            
            <?php
            if($objBasket->_vat_rate != 0){ ?>
            </tr>
            <tr>
                <td colspan="2" class="br_td">
                    Sub-total
                </td>
                <td colspan="2" class="br_td">
                    <?php echo Catalogue::$_euro." ";
                            echo number_format($objBasket->_sub_total,2);
                    ?>
                </td>
            </tr>
            
            <tr>
                <td>
                    IVA(<?php echo $objBasket->_vat_rate; ?>)
                </td>
                <td colspan="2" class="br_td">
                    <?php echo Catalogue::$_euro." ";
                            echo number_format($objBasket->_vat,2);
                    ?>
                </td>
            </tr>
            
            <tr>
                <td>
                    <strong>Total:</strong>
                </td>
                <td colspan="2" class="br_td">
                    <strong><?php echo Catalogue::$_euro." ";
                            echo number_format($objBasket->_total,2);
                            ?></strong>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="dev br_td">&#160;</div>
        <div class="sbm sbm_blue fl_r paypal" id="<?php echo $token1; ?>">
            <span class="btn">Proceed to PayPal</span>
        </div>
        <div class="sbm sbm_blue fl_l">
            <a href="/?page=basket" class="btn">Amend order</a>
        </div>
    </form>
    <div class="dev">&#160;</div>
</div>

<div class="dn">
    <img src="/images/loadinfo.net.gif" alt="Proceeding to PayPal"/>
</div>


<?php }else{ ?>

<p>Your basket is currently empty.</p>

<?php
}
require_once ('_footer.php');
