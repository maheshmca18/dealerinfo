<!--<style>
    .sizes{
        display: block;
        height: auto;
        max-width: 100%;}

   img{
        width: 100px;
        height: 100px;
    }
    .align {
        margin-bottom: 10px;
        margin-left: 20px;
        margin-top: 4px;
    }
    .margin_left{
        margin-left: 20px;
    }


</style>


<body>
<br/><h3><?php echo "Product Of The Day"; ?></h3>
                    <div class="thumbnail sizes" >
                        <table>
                            <?php  foreach($products as $product_widget){ ?>
                            <tr>
                                <td><div class="image"><a href="<?php echo $product_widget['href']; ?>"><img src="<?php echo $product_widget['thumb']; ?>" /></a> </div></td>
                                <td><h4 class="align"><a href="<?php echo $product_widget['href']; ?>" class="margin_left"><?php echo $product_widget['name']; ?><br>

                                            <?php  if ($product_widget['price']) { ?>
                                            <?php if (!$product_widget['special']) { ?>
                                            <h4 class="align"><?php echo $product_widget['price']; ?></h4>
                                            <?php } else { ?>
                                            <h4 class="align"><?php echo $product_widget['special']; ?> <?php echo $product_widget['price']; ?></h4>
                                            <?php } ?>
                                            <?php } ?>
                                            <div  class="align"><button type="button" onclick="cart.add('<?php echo $product_widget['product_id']; ?>');" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button></div>
                                            <!--<button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block"><?php echo $button_cart; ?></button>-->
                                        <!--</a></h4>
                                </td>
                            </tr>
                            <tr><td colspan="3"><hr style = "background-color:#C6C6C6  ;  color:#000000  ; display: inline-block; text-align: left; width:100%;" /></td></tr>
                    <?php  } ?>
                    </table>
                    </div>

</body>-->
<style>
    .responsive{
        width: 142px;
        height: 100px;
    }
  img {
        height: 100%;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }


</style>
<h3><?php echo "Product Of The Day"; ?></h3>
<div class="thumbnail sizes" >
<table>
<?php  foreach($products as $product){ ?>

    <tr>

        <td><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" class="responsive" /></a> </td>

       <td> <div class="caption">
            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>

            <?php  if ($product['price']) { ?>
            <p class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>

            </p>
            <?php } ?>

               <div  class="align"><button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button></div>
           </div>
        </td>
    </tr>
    <tr><td colspan="3"><hr style = "background-color:#C6C6C6  ;  color:#000000  ; display: inline-block; text-align: left; width:96%;" /></td></tr>
       <?php } ?>
</table>
</div>
