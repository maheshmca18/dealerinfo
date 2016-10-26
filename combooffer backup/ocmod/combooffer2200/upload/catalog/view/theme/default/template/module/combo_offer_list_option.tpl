<link media="screen" rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css">
   <?php  if ($product_details) { ?>
 
<!----option data here -->
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="max-height:64%; margin-top: 175px; margin-bottom:50px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <label><b><h3><?php  echo $option_title;  ?></h3></b></label>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body" style="height:250px; overflow-y: auto;  " >
<form method="post" id="combooptiondetails">
<div class="container-fluid bd-example-row">
          <div class="row">
          <?php $i=0; foreach ($product_details as $details) { ?>
 <?php if(!empty($details['plussymbol'])){ ?><div class="col-sm-1" style="font-size:35px;top: 35px;"><?php echo $details['plussymbol']; ?></div><?php } ?>
            <div product-index="<?php echo $i; ?>" class="col-md-4">

                    <a href="<?php echo $details['href']; ?>">
                        <img src="<?php echo $details['thumb']; ?>" alt="<?php echo $details['name']; ?>" title="<?php echo $details['name']; ?>" class="img-responsive" />
                    </a>
                <label><?php echo $details['name'];  ?></label> <br>
                <label><?php if(!$details['special']){ echo $details['price']; } else { echo $details['special']; } ?></label>
            <?php foreach ($details['product_option'] as $optiondetails) { ?>
                <?php foreach ($optiondetails as $option) { ?>
            <?php if ($option['type'] == 'select') { ?>

            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">

              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label><br>
              <select name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="optionselect">
                <option value=""><?php echo $text_select; ?></option>
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                <?php if ($option_value['price']) { ?>
                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                <?php } ?>
                </option>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'radio') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'checkbox') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'image') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <div id="input-option<?php echo $option['product_option_id']; ?>">
                <?php foreach ($option['product_option_value'] as $option_value) { ?>
                <div class="radio">
                  <label>
                    <input type="radio" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" />
                    <img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" class="img-thumbnail" /> <?php echo $option_value['name']; ?>
                    <?php if ($option_value['price']) { ?>
                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                    <?php } ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'text') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <input type="text" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class="" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'textarea') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <textarea name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" rows="5" placeholder="<?php echo $option['name']; ?>" id="input-option<?php echo $option['product_option_id']; ?>" class=""><?php echo $option['value']; ?></textarea>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'file') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label"><?php echo $option['name']; ?></label>
              <button type="button" id="button-upload<?php echo $option['product_option_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default btn-block"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
              <input type="hidden" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="" id="input-option<?php echo $option['product_option_id']; ?>" />
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'date') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group date">
                <input type="text" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD" id="input-option<?php echo $option['product_option_id']; ?>" class="" />
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'datetime') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group datetime">
                <input type="text" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <?php } ?>
            <?php if ($option['type'] == 'time') { ?>
            <div option_id="option-<?php echo $option['product_option_id']; ?>" class="form-group<?php echo ($option['required'] ? ' required' : ''); ?>">
              <label class="control-label" for="input-option<?php echo $option['product_option_id']; ?>"><?php echo $option['name']; ?></label>
              <div class="input-group time">
                <input type="text" name="option[<?php echo $i; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['value']; ?>" data-date-format="HH:mm" id="input-option<?php echo $option['product_option_id']; ?>" class="" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>

            <?php } ?>
                <?php } ?>
                <?php } $i++;?>
</div>

            <?php } ?>
</div>
</div>
 <input id="ProductBundlesProducts" type="hidden" name="products" value="<?php //echo $BundleProducts; ?>" />
        <input id="ProductBundlesDiscount" type="hidden" name="discount" value="<?php //echo $VoucherData; ?>" />
        <input id="proid" type="hidden" name="proid" value="<?php echo $combo_id; ?>" />
           </form>
          </div>
<div class="modal-footer">
                    <button type="button" onclick="addcart23(this)" proid="<?php echo $combo_id; ?>" id="combo"  class="btn btn-primary btn-default "><i class="fa fa-shopping-cart"></i><?php echo $button_cart; ?></button>
                    <button type="button" class="btn btn-primary btn-default" data-dismiss="modal">Close</button>
                </div>
</div>
 </div>
 </div>
           
 <?php } ?>
<!---option data end --->
<script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/moment.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script>
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
function addcart23(obj){
	$.ajax({
		url: 'index.php?route=module/combo_offerm/addcartoption',
		type: 'post',
		data: $('#combooptiondetails').serialize(),
		dataType: 'json',
		beforeSend: function() {
			$('#button-cart').button('loading');
		},
		complete: function() {
			$('#button-cart').button('reset');
		},
		success: function(json) {
		$('.alert, .text-danger').remove();
            if (json['error']) {
                if (json['error']['option']) {
                    for (i in json['error']['option']) {
                        for (n in json['error']['option'][i]) {
                            $('div[product-index="' + json['error']['option'][i][n].key + '"]').find('div[option_id=option-' + i + ']').after('<span class="text-danger">' + json['error']['option'][i][n].message + '</span>');
                        }
                    }
                }
            }
            if(json['success']) {
                window.location = "<?php echo html_entity_decode($cart_url); ?>";
            }
		},// eo success
            error: function (json) {
			console.log(json);			
			}
	});
}
</script>
