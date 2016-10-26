
<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div class="box">
        <div class="heading">
            <h1><img src="view/image/language.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">

                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

                        <table class="form">

                           <b></bb> <?php echo $text_addtimeslot; ?></b>
                           <!-- <tr>
                                <td><span class="required">*</span> <label class="col-sm-2 control-label" for="input-code"><?php echo $text_timeslot_title; ?></label></td>
                                <td><input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title" id="input-code" size="56" class="form-control" /><br />
                                    <?php if ($error_name) { ?>
                                    <div class="text-danger"><?php echo $error_name; ?></div>
                                    <?php } ?></td>
                            </tr>-->





                            <tr>
                                <td><span class="required"></span> <label class="col-sm-2 control-label" for="input-code"><?php echo "From Time "; ?></label></td>
                               <td> <input id="from" type="text"   name="from_time" value="<?php echo $from_time; ?>" readonly></td>
                                   
                            </tr>

                             <tr>
                                <td><span class="required"></span> <label class="col-sm-2 control-label" for="input-code"><?php echo "To Time "; ?></label></td>
                               <td> <input id="to" type="text" name="to_time" value="<?php echo $to_time; ?>" readonly></td>
                                   
                            </tr>










                            <tr>
							  <td><?php echo $text_timeslot_status; ?></td>
							  <td><select name="status" >
								  <?php if ($status) { ?>
								  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
								  <option value="0"><?php echo $text_disabled; ?></option>
								  <?php } else { ?>
								  <option value="1"><?php echo $text_enabled; ?></option>
								  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								  <?php } ?>
								</select></td>
			 </tr>


                      

                        </table>

                    </form>
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
