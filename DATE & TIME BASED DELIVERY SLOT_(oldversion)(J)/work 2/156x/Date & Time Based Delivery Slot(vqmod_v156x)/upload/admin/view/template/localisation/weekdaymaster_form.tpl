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
                    <h1><img src="view/image/language.png" alt="" /> <?php echo $heading_title_week; ?></h1>
                    <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
                </div>


           <!-- <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_addweekdays_week; ?></h3>
            </div>-->
        <div class="content">
                <form action="" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

                    <table class="form">

                        <!--<tr><td colspan="2" align="center"><b><h3><?php echo $text_addweekdays_week; ?></h3></b></td></tr>-->
                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Sunday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="0"   class="form-control" <?php  echo (in_array(0,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>

                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Monday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="1"   class="form-control" <?php  echo (in_array(1,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>

                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Tuesday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]"  value="2"  class="form-control" <?php  echo (in_array(2,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>
                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Wednesday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="3"  class="form-control" <?php  echo (in_array(3,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>
                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Thursday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="4"  class="form-control" <?php  echo (in_array(4,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>
                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Friday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="5"  class="form-control" <?php  echo (in_array(5,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>
                        <tr>
                            <td><label class="col-sm-2 control-label" for="input-code"><?php echo "Saturday"; ?></label></td>
                            <td><input type="checkbox" name="weekdays[]" value="6"  class="form-control" <?php  echo (in_array(6,$arraycheckboxvalue) ? 'checked=checked': '');  ?> /></td>
                        </tr>


                </form>

        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
    $('#datepick').datepicker({
        //pickTime: false
        dateFormat: 'dd-mm-yy'
    });
</script>
