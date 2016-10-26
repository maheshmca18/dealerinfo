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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">

                     <table class="form">

                          
                         <div class="form-group">
                              <label class="col-sm-2 control-label" for="input-code"><?php echo "From Time "; ?></label>
                             <div class="col-sm-10">
                                <input id="from" type="text"   name="from_time" value="<?php echo $from_time; ?>" readonly></td>
                                   
                            </div>
                         </div>

                        <div class="form-group">
                              <label class="col-sm-2 control-label" for="input-code"><?php echo "To Time "; ?></label>
                             <div class="col-sm-10">
                                  <input id="to" type="text" name="to_time" value="<?php echo $to_time; ?>" readonly>
                             </div>
                        </div>

                       <div class="form-group">
			      <label class="col-sm-2 control-label" for="input-code"><?php echo $text_timeslot_status; ?></label>
				 <div class="col-sm-10">
                                   <select name="status" >
				     <?php if ($status) { ?>
				     <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
				     <option value="0"><?php echo $text_disabled; ?></option>
				     <?php } else { ?>
			             <option value="1"><?php echo $text_enabled; ?></option>
			             <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				     <?php } ?>
			         </select></td>
			     </div>
                       </div>

                    </form>
              </div>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="view/irstimepiecker/css/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="view/irstimepiecker/css/mtimepicker.css" />
<script type="text/javascript" src="view/irstimepiecker/js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="view/irstimepiecker/js/mtimepicker.js"></script>
<script type="text/javascript">
$(document).ready( function(){
var from_time=$("#from").val();
var to_time=$("#to").val();
	$('#from').mTimePicker().mTimePicker( 'setTime',from_time);
	$('#to').mTimePicker().mTimePicker( 'setTime',to_time );

});
</script>
<?php echo $footer; ?>
