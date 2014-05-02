<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$objForm = new Form();


require_once ('_header.php');
?>

<h1>Checkout</h1>
<p>Please check your details and click <strong>Next</strong></p>

<form action="" method="post">
    <table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
        <tr>
            <th>
                <label for="first_name">First name:*</label>
            </th>
            <td>
                <input type="text" name="first_name" id="first_name" class="fld" value="<?php echo $objForm->stickyText('first_name'); ?>" />
            </td>
        </tr>
        
        <tr>
            <th>
                <label for="last_name">Last name:*</label>
            </th>
            <td>
                <input type="text" name="last_name" id="last_name" class="fld" value="<?php echo $objForm->stickyText('last_name'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="address_1">Address 1:*</label>
            </th>
            <td>
                <input type="text" name="address_1" id="address_1" class="fld" value="<?php echo $objForm->stickyText('address_1'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="address_2">Address 2:</label>
            </th>
            <td>
                <input type="text" name="address_2" id="address_2" class="fld" value="<?php echo $objForm->stickyText('address_2'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="town">Town:*</label>
            </th>
            <td>
                <input type="text" name="town" id="town" class="fld" value="<?php echo $objForm->stickyText('town'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="country">Country:*</label>
            </th>
            <td>
                <?php echo $objForm->getCountrySelect($record); ?>
            </td>
        </tr>
        <tr>
            <th>
                <label for="post_code">Post code:*</label>
            </th>
            <td>
                <input type="text" name="post_code" id="post_code" class="fld" value="<?php echo $objForm->stickyText('post_code'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="email">Email:*</label>
            </th>
            <td>
                <input type="text" name="email" id="email" class="fld" value="<?php echo $objForm->stickyText('email'); ?>" />
            </td>
        </tr>
        <tr>
            <th>
                &nbsp;
            </th>
            <td>
                <label for="btn" class="sbm sbm_blue fl_l">
                <input type="submit" name="" id="btn" class="btn" value="Next" /></label>
            </td>
        </tr>
    </table>
</form>


<?php

require_once ('_footer.php');