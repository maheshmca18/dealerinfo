<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/javascript/jquery/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
<style>

    .product-thumb{
        margin-top: 15px;
        margin-left: 10px;
        
    }
</style>

<h3><?php echo "Product Of The Day"; ?></h3>
<div id="carousels<?php echo $modules; ?>" class="owl-carousel">

    <?php foreach ($products as $product) { ?>


    <div class="product-thumb transition" ><br>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" class="img-responsive" /></a> </div>

        <div class="caption" style="min-height:85px;">
            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>

            <?php if ($product['rating']) { ?>
            <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($product['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } ?>
                <?php } ?>
            </div>
            <?php } ?>
            <?php  if ($product['price']) { ?>
            <p class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
                <?php if ($product['tax']) { ?>
                <span class="price-tax"><?php echo "Ex Tax:"; ?> <?php echo $product['tax']; ?></span>
                <?php } ?>
            </p>
            <?php } ?>
        </div>

        <div class="button-group">
            <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"></span></button>
            <button type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
        </div>
    </div>



    <?php } ?>
</div>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.js" type="text/javascript"></script>
<script type="text/javascript"><!--

    $('#carousels<?php echo $modules; ?>').owlCarousel({
        items: 5,
        autoPlay: 3000,
        navigation: true,
        navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
        pagination: true
    });

    --></script>