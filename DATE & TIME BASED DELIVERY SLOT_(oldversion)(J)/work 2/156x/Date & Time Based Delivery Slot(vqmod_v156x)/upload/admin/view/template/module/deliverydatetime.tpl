<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>

    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">


                 <table class="form">
                    <tr>
		            <td><label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label></h2></td>

		           <td> <select name="deliverydatetime_status" id="input-status" class="form-control">
		                <?php if ($deliverydatetime_status) { ?>
		                <option value="1" selected="selected"><?php echo $text_status_enabled; ?></option>
		                <option value="0" ><?php echo "Disabled"; ?></option>
		                <?php } else { ?>
		                <option value="1"><?php echo "Enabled"; ?></option>
		                <option value="0"selected="selected"><?php echo $text_status_disabled; ?></option>
		                <?php } ?>
		               </select>
			 </td>
		   </tr>

                  <tr>
		    <td><?php echo "Time Interval"; ?></td>
		    <td><input type="text" name="deliverydatetime_timeinterval" value="<?php echo $deliverydatetime_timeinterval; ?>" />
		   
		      
		  </tr>
		  
		           <!--holiday added-->
                    <tr>
                       <td> <label class="col-sm-2 control-label" for="input-status" ><?php echo "Minimum Day"; ?></label></td>
                       <td>
                            <input class="form-control color" type="number" value="<?php echo $deliverydatetime_min_day; ?>" name="deliverydatetime_min_day" placeholder="<?php echo $text_min_day; ?>" >
                      </td>
                   </tr>

                    <tr>
                        <td><label class="col-sm-2 control-label" for="input-status" ><?php echo "Maximum day"; ?></label> </td>
                       <td>
                            <input class="form-control color" type="number" value="<?php echo $deliverydatetime_max_day; ?>" name="deliverydatetime_max_day" placeholder="<?php echo $text_max_day; ?>" />

                        </td>
                    </tr>
         
	<!--holiday added-->



                </table>
            </form>
        </div>
    </div>
</div>

<?php echo $footer; ?>
