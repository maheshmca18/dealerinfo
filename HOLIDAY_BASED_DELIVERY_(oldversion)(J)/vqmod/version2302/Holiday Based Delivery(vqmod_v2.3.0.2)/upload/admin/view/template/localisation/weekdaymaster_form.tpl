<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-language" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title_week; ?></h1>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_addweekdays_week; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">

                 
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Sunday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="0"   class="form-control" <?php  echo (in_array(0,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Monday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="1"  class="form-control" <?php  echo (in_array(1,$arraycheckboxvalue) ? 'checked=checked': '');  ?>   />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Tuesday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]"  value="2"  class="form-control" <?php  echo (in_array(2,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Wednesday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="3"  class="form-control" <?php  echo (in_array(3,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Thursday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="4"  class="form-control" <?php  echo (in_array(4,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Friday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="5"  class="form-control" <?php  echo (in_array(5,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-code"><?php echo "Saturday"; ?></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="weekdays[]" value="6"  class="form-control" <?php  echo (in_array(6,$arraycheckboxvalue) ? 'checked=checked': '');  ?> />
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
    $('#datepick').datetimepicker({
        pickTime: false
    });
</script>
