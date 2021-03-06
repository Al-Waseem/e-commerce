<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$cat = Url::getParam('category');

if(empty($cat)){
    require_once ("error.php");
}else{
    $objCatalogue = new Catalogue();
    $categories = $objCatalogue->getCategories($cat);
    
    if(empty($categories)){
        require_once ("error.php");
    }else{
        $rows = $objCatalogue->getProducts($cat);
        
        //crear objeto de Paging
        $objPaging = new Paging($rows, 5);
        $rows = $objPaging->getRecords();
        
        require_once ("_header.php");
        
        ?>

<h1> Catalogue :: <?php echo$categories['name'] ?></h1>

<?php

if(!empty($rows)){
    foreach ($rows as $$row) {
        ?>
<div class="catalogue_wrapper">
    <div class="catalogue_wrapper_left">
        <?php 
        $image = !empty($row['image']) ? 
                $objCatalogue->_path.$row['image']:
                $objCatalogue->_path.'unavailable.png';
        
        $width = Helper::getImgSize($image,0);
        $width = $width > 120 ? 120 : $width;
        
        ?>
        <a href="=/?page=catalogue-item&a&amp;categpry=<?php echo $categories['id']; ?> &a&amp;id= 
           <?php echo $row['id']; ?> "><img src="<?php echo $image; ?> " alt="<?php echo Helper::encodeHTML($row['name'], 1); ?>" 
               width="<?php echo $width; ?>"/></a>
    </div>
    <div class="catalogue_wrapper_right">
        <h4>
            <a href="/?page=catalogue-item&amp;;category=<?php echo $categories['id']; ?>&amp;id=<?php echo $row['id']; ?>">
            <?php echo Helper::encodeHTML($row['name'], 1)?>
            </a>
        </h4>
        <h4>
            Price: <?php echo Catalogue::$_euro; echo number_format($row['price'],2); ?>
        </h4>
        <p>
            <?php echo Helper::shortenString(Helper::encodeHTML($row['descrption'])); ?>
        </p>
        <p>
            <?php echo Basket::activButton($row['id']); ?>
        </p>
    </div>
</div>
<?php
    }
    
    echo $objPaging->getPaging();
}else {
    ?>
<p>
    There are no products in this category
</p>
<?php
    
}
        require_once ("_footer.php");
    }
}
