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
                <h5><a href="/admin/?page=products">Content Manegment System</a></h5>
                <?php
                    if(Login::isLogged(Login::$_login_admin)){
                        echo '<div id="logged_as">Looged in as:<strong>';
                        echo Login::getFullNameFront(Session::getSession(Login::$_login_admin));
                        echo '</strong>';
                        echo '| <a href="/?page=lougout">Logout</a></div>';
                    }else{
                        echo '<div id="logged_as"><a href="/admin/">Login</a></div>"';
                    }
                
                ?> 
            </div>
        </div>
        <div id="wrapper">
            <div id="left">
                
                <?php
                    if(Login::isLogged(Login::$_login_admin)){
                ?>
                                
                <h2>Navigation</h2>
                <div class="dev br_td">&nbsp;</div>
                <ul id="navigation">
                    <li><a href="/admin/?page=products"
                        
                        <?php echo Helper::getActive(array('page' => 'products')); ?>
                                   >Products</a></li>
                    <li><a href="/admin/?page=categories"
                        
                        <?php echo Helper::getActive(array('page' => 'categories')); ?>
                                   >Categories</a></li>
                    <li><a href="/admin/?page=orders"
                        
                        <?php echo Helper::getActive(array('page' => 'orders')); ?>
                                   >Orders</a></li>
                    <li><a href="/admin/?page=clients"
                        
                        <?php echo Helper::getActive(array('page' => 'clients')); ?>
                                   >Clients</a></li>
                    <li><a href="/admin/?page=business"
                        
                        <?php echo Helper::getActive(array('page' => 'business')); ?>
                                   >Business</a></li>
                </ul>
                
                    <?php } else { ?>
                
                &nbsp;
                        
                    <?php } ?>

            </div>
            
        </div>
    </body>
</html>