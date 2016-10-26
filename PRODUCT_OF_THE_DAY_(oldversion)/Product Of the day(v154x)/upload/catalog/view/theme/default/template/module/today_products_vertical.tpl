

<style>
    #box1{
        width: 195px;
    }
</style>
<div class="box" id="box1">
    <div class="box-heading"><?php echo "Product Of The Day"; ?></div>
    <div class="box-content">
       
            <?php  foreach($products as $product){ ?>

<table>
               <tr>
                   <td><a href="<?php echo $product['href']; ?>" ><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" class="responsive" /></a></td>

               <td> <ul>
                    <h4><a href="<?php echo $product['href']; ?>" style="text-decoration: none"><?php echo $product['name']; ?></a></h4>

                </ul>


                <?php  if ($product['price']) { ?>
                <p class="price">
                    <?php if (!$product['special']) { ?>
                    <?php echo $product['price']; ?>
                    <?php } else { ?>
                    <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                    <?php } ?>

                </p>
                <?php } ?>

                <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div></td>

            </tr>
    <tr><td colspan="3"><hr style = "background-color:#EEEEEE  ;  color:#EEEEEE  ; display: inline-block; text-align: left; width:100%;" /></td></tr>
            </table>
            <?php } ?>

       
    </div>
</div>
