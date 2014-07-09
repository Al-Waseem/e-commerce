<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$url = '/admin'.Url::getCurrentUrl(array('action', 'id'));
require_once ('template/_header.php');
?>

<h1>Products  :: Edit</h1>
<p>The record has been updated successfully.<br /></p>
<a href="<?php echo $url; ?>">Go back to the list of products.</a>

<?php

require_once ('template/_footer.php');
