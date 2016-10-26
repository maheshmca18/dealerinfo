<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">

                <button type="submit"  onclick="$('#form').submit();" form="form-cod" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">

    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
                <select name="Zaakpay_status" id="input-status" class="form-control">
                    <?php if ($Zaakpay_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

   
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $merchantIdentifier; ?></label>
            <div class="col-sm-10">
                <input type="text" name="Zaakpay_merchantIdentifier" value="<?php echo $Zaakpay_merchantIdentifier; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_merchantIdentifier)) { ?>
                <div class="text-danger"><?php echo $error_merchantIdentifier; ?></div>
                <?php } ?>
            </div>
        </div>

	
        <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $secret_key; ?></label>
            <div class="col-sm-10">
                <input type="text" name="Zaakpay_secret_key" value="<?php echo $Zaakpay_secret_key; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_secret_key)) { ?>
                <div class="text-danger"><?php echo $error_secret_key; ?></div>
                <?php } ?>
            </div>
        </div>


        <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-top"><?php echo $mode; ?></label>
            <div class="col-sm-10">
                <div class="checkbox">
                    <label>
                        <?php if($Zaakpay_test) { ?>
                        <input type="checkbox" name="Zaakpay_test"  checked="checked" id="input-top" />
                        <?php } else { ?>
                        <input type="checkbox" name="Zaakpay_test"  id="input-top" />
                        <?php } ?>
                        &nbsp; </label>
                </div>
            </div>
        </div>
  

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-top"><?php  echo $log; ?></label>
            <div class="col-sm-10">
                <div class="checkbox">
                    <label>
                        <?php if($Zaakpay_log) { ?>
                        <input type="checkbox" name="Zaakpay_log"  checked="checked" id="input-top" />
                        <?php } else { ?>
                        <input type="checkbox" name="Zaakpay_log"  id="input-top" />
                        <?php } ?>
                        &nbsp; </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
                <select name="Zaakpay_geo_zone_id" id="input-status" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php if ($geo_zone['geo_zone_id'] == $Zaakpay_geo_zone_id) { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>

                    <?php } else { ?>
                    <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>

                    <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>

</form>
            </div>
        </div>
    </div>
<script type="text/javascript"><!--
$.tabs('.tabs a'); 
//--></script>
<?php echo $footer; ?>
