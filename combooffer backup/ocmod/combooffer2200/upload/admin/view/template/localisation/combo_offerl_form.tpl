
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-combo_offer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-combo_offer" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-title"><?php echo $entry_title; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="c_name" value="<?php echo $c_name; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title" class="form-control" />
                            <?php if ($error_title) { ?>
                            <div class="text-danger"><?php echo $error_title; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-symbol-left"><?php echo $entry_discount_price; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="c_discount_price" value="<?php echo $c_discount_price; ?>" placeholder="<?php echo $entry_discount_price; ?>" id="input-symbol-left" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-symbol-right"><?php echo $entry_product; ?></label>
                         <div class="col-sm-10">
                  <input type="text" name="related" value="" placeholder="<?php echo $entry_product; ?>" id="input-related" class="form-control" />
                  <div id="products" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($products as $product_related) { ?>
                    <div id="products<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                      <input type="hidden" name="products[]" value="<?php echo $product_related['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-decimal-place"><?php echo $entry_start_date; ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="startdate" name="c_start_date" placeholder="<?php echo $entry_start_date; ?>" value="<?php echo $c_start_date; ?>" data-date-format="DD/MM/YYYY" class="form-control">
                        </div>
                    </div>
 <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-decimal-place"><?php echo $entry_end_date; ?></label>
                        <div class="col-sm-10">
                            <input type="text" id="enddate" name="c_end_date" placeholder="<?php echo $entry_end_date; ?>" value="<?php echo $c_end_date; ?>" data-date-format="DD/MM/YYYY" class="form-control">
                        </div>
                    </div>
                   
 <div class="form-group ">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_value; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="c_sort_order" value="<?php echo $c_sort_order; ?>" placeholder="<?php echo $entry_value; ?>" id="input-code" class="form-control" />
                            <?php if ($error_code) { ?>
                            <div class="text-danger"><?php echo $error_code; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="c_status" id="input-status" class="form-control">
                                <?php if ($c_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// Related
$('input[name=\'related\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=localisation/combo_offerl/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'related\']').val('');
		
		$('#products' + item['value']).remove();
		
		$('#products').append('<div id="products' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="products[]" value="' + item['value'] + '" /></div>');	
	}	
});

$('#products').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
</script> 
<script type="text/javascript">

    $('#enddate').datetimepicker({
        pickTime: false

    });
 $('#startdate').datetimepicker({
        pickTime: false

    });

</script>
<?php echo $footer; ?>
