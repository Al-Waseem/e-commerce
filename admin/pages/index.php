<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if(Login::isLogged(Login::$_login_admin)){
    Helper::redirect(Login::$_dashboard_admin);
}

$objForm = new Form();
$objValid = new Validation($objForm);

if($objForm->isPost('login_email')){
    $objAdmin = new Admin();
    
    if($objAdmin->isUser($objForm->getPost('login_email', $objForm->getPost('login_password')))){
        Login::loginAdmin($objAdmin->_id, Url::getReferrerUrl());
    }else{
        $objValid->add2Errors('login');
    }
}


//echo Login::string2hash('pa55w0rd');


require_once ('template/_header.php'); 

?>


<h1>Login</h1>

<form action="" method="">
    
    <table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
        <tr>
            <th><label for="login_email">Login:</label></th>
            <td>
                <?php echo $objValid->validate('login'); ?>
                <input type="text" name="login_email" id="login_email" class="fld" value="" />
            </td>
        </tr>
        <tr>
            <th><label for="login_password">Password:</label></th>
            <td>
                <input type="text" name="login_password" id="login_password" class="fld" value="" />
            </td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td>
                <label for="btn_login" class=" sbm sbm_blue fl_l">
                    <input type="submit" id="btn_login" class="btn" value="Login" />
                </label>
            </td>
        </tr>
    </table>
    
</form>


<?php
require_once ('template/_footer.php');