
<link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="catalog/view/javascript/jquery/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
<style>

    .scroll-pane
    {
        width: 100%;
        height: 435px;
        overflow: auto;
    }
</style>
<?php if( $limit > '1' ){ ?>
<style>
    .product-layout1{
        margin-top: 15px;
        margin-left: 10px;

    }
</style>
<?php } ?>
<h3><?php echo $heading_title; ?></h3>
<div  id="carousels<?php echo $modules; ?>" class="owl-carousel">
    <?php foreach ($products as $productdetails) { ?>
  <div class="product-layout1 " style=" text-align: center;">
    <div class="product-thumb transition scroll-pane"  >
        <h4 style="margin-left: 20px;"><?php echo $productdetails['c_name']; ?></h4>
            <?php foreach ($productdetails['product_details'] as $product) { ?>
            <div style="font-size:35px;  margin-left: 120px;"><?php echo $product['plussymbol']; ?></div>
                  <div class="caption"  style="width:100%; text-align: center;min-height: 100px;">
                <div class="image" ><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
                  <h4 style="align:center;"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
                    <?php if ($product['price']) { ?>
                    <p class="price">
                      <?php if (!$product['special']) { ?>
                      <?php echo $product['price']; ?>
                      <?php } else { ?>
                      <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                      <?php } ?>

                    </p>
                    <?php } ?>
                  </div>

                 <?php } ?>
    <div style=" text-align: center;color: #373729;font-weight:700;"><?php echo $comboprice; echo $productdetails['combo_price']; ?></div>
    <div style=" text-align: center;color: #373729;font-weight:700;"><?php echo $saveamount; echo $productdetails['discountamount']; ?></div>
           <button type="button" onclick="addcart(this)" proid="<?php echo $productdetails['combo_pro_id']; ?>" id="comboofferid"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>

  </div>
 </div>
  <?php } ?>

</div>
<div id="popup"></div>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.js" type="text/javascript"></script>


<script type="text/javascript"><!--

    $('#carousels<?php echo $modules; ?>').owlCarousel({

        items: "<?php echo $limit; ?>",
        autoPlay: <?php  if($carousel_status == 1){ echo 3000; } else { echo "false"; }  ?>,
        navigation: true,
        navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
        pagination: true
    });

    --></script>

<script type="text/javascript">

    function addcart(obj){

        $pro=$(obj).attr('proid');

        $.ajax({
            url: 'index.php?route=extension/module/combo_offerm/add',
            type: 'post',
            data: { proid:$pro},
            dataType: 'json',
            beforeSend: function() {
                $('#button-cart').button('loading');
            },
            complete: function() {
                $('#button-cart').button('reset');
            },

            success: function(json) {

                if(json['option']) {
                    $("#popup").html(json['option']);

                    $("#myModal").modal('show');
                }
                if(json['success']) {

                    window.location = "<?php echo html_entity_decode($cart_url); ?>";
                }

            },// eo success
            error: function (json) {
                console.log("hi");
                console.log(json);
            }
        });
    }
</script>
