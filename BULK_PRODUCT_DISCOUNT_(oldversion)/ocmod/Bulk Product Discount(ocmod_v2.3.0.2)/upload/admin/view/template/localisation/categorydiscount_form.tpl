<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-language" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">

          <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                  <div class="col-sm-10">
                     <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
               <div id="product-category" class="scrollbox1">
                  <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php  //foreach ($categories as $product_category) { ?> 
                    <div id="product-category-value"><i class="fa fa-minus-circle"></i> <?php echo $category_name; ?>
                      <input type="hidden" name="category_id" value="<?php echo  $category_id; ?>" />
                    </div>
                    <?php //} ?>
                  </div>
                </div>
              </div>




      <div class="form-group">
            <label class="col-sm-2 control-label" for="input-code"> <?php echo $entry_customer_group; ?></label>
		 <div class="col-sm-10">
                 <select name="customer_group_id">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>                              
              <?php if ($error_customer_group) { ?>
              <span class="error"><?php echo $error_customer_group; ?></span>
              <?php } ?>
                </div>         
              </div> 
             


 
           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_percentage; ?></label>
              <div class="col-sm-10">
		  <input type="text" name="percentage" value="<?php echo $percentage; ?>" />				                            
                <?php if ($error_percentage) { ?>
				<span class="alert alert-danger"><?php echo $error_percentage; ?></span>
				<?php } ?>              
                </div>         
              </div>
        
           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_status; ?></label>
		 <div class="col-sm-10">
               <select name="status">
                <?php if ($status) { ?>
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
<?php echo $footer; ?>
<script>
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			//url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
url: 'index.php?route=localisation/categorydiscount/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#product-category' + item['value']).remove();
		
		$('#product-category-value').html('<div id="product-category-value"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_id" value="' + item['value'] + '" /></div>');	
	}
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

</script>

