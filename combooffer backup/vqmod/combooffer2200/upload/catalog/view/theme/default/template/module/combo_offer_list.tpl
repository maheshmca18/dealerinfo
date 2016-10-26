
<?php echo $header; ?>

<div class="container">
<h3><?php echo $heading_title;?></h3> 

  <?php foreach ($products as $productdetails) { ?>
  <div class="row" >
    <div class="product-thumb transition"  >

<h4 style="margin-left: 20px;"><?php echo $productdetails['c_name']; ?></h4>
<?php foreach ($productdetails['product_details'] as $product) { ?>
<?php if(!empty($product['plussymbol'])){ ?><div class="col-sm-1" style="font-size:35px;top: 35px;"><?php echo $product['plussymbol']; ?></div><?php } ?>
<div class="col-sm-2">
      <div class="caption"  >
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
    </div>
 <?php } ?>
<div class="col-sm-2" style="color: #373729;">
<b><?php echo $comboprice; ?> </b><?php echo $productdetails['combo_price']; ?><br>
<b><?php echo $saveamount; ?> </b><?php echo $productdetails['discountamount']; ?>
<button type="button" onclick="addcart(this)" proid="<?php echo $productdetails['combo_pro_id']; ?>" id="comboofferid"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>
</div>
<div id="popup"></div>

</div>
 </div>
 <?php } ?>
</div></div>
<?php echo $footer; ?>
<script type="text/javascript">
 $(document).ready(function(){

 $('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);

						$(node).parent().find('input').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
 });
</script>
<script type="text/javascript">

function addcart(obj){
	
$pro=$(obj).attr('proid');

	$.ajax({
		url: 'index.php?route=module/combo_offerm/add',
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
