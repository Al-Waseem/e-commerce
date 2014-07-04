<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Login::restrictFront();

$objOrder = new Order();

$orders = $objOrder->getClientOrders(Session::getSession(Login::$_login_front));

$objPaging = new Paging($orders, 5);

$rows = $objPaging->getRecords();

require_once ('_header.php');

?>

<h1>My Orders</h1>


<?php

if(!empty($rows)){
    ?>
<table cellspacing="0" cellpadding="0" border="0" class="tbl_repeat">
    <tr>
        <th>Id</th>
        <th class="ta_r">Date</th>
        <th class="ta_r col_15">Status</th>
        <th class="ta_r col_15">Total</th>
        <th class="ta_r col_15">Invoice</th>
    </tr>
    <?php
        foreach ($rows as $row) { ?>
    <tr>
        <td><?php echo $row[$id]; ?></td>
        <td class="ta_r"><?php echo Helper::setDate(1, $row['date']); ?></td>
        <td class="ta_r">
            <?php 
            
                $status = $objOrder->getStatus($order['status']);
                echo $status['name'];
                
            ?>
        </td>
        <td class="ta_r">
            <?php echo number_format($order['total'], 2); ?>
        </td>
        <td class="ta_r">
            <?php
                if($order['pp_status'] == 1){
                    echo '<a href="/?page=invoice&amp;id=';
                    echo $row['id'];
                    echo '" target="_blank">Invoice</a>';
                }  else {
                    echo '<span class="inactive">Invoice</span>';                                        
                }
            ?>
        </td>
    </tr>
    <?php
            
        }
    ?>
    
</table>



<?php

$objPaging->getPaging();
    
}else{
    ?>
<p>Currently, you donn't have any order.</p>
<?php

}


require_once ('_footer.php');