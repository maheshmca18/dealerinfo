<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">

 <button type="submit"  onclick="$('#form').submit();" form="form-cod" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
<h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php  echo $text_edit; ?></h3>
<div class="pull-right">
 <a href="http://wepay.com/payments-api" class="btn btn-primary" target="_blank" style="text-decoration: none; font-weight: bold; padding: 6px 13px;">Get API Credentials</a> 
            </div>
            </div>
            <div class="panel-body">
         
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

 <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_staging; ?></label>
            <div class="col-sm-10">
                <select name="wepay_staging" id="input-status" class="form-control">
                    <?php if ($wepay_staging == 'P') { ?>
                <option value="P" selected="selected">Production</option>
                <option value="S">Staging</option>
                <?php } else { ?>
                <option value="P">Production</option>
                <option value="S" selected="selected">Staging</option>
                <?php } ?>
                 <?php if ($error_staging) { ?>
              <span class="error"><?php echo $error_staging; ?></span>
              <?php } ?>
                </select>
            </div>
        </div>

<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_accountid; ?></label>
            <div class="col-sm-10">
                <input type="text" name="wepay_accountid" value="<?php echo $wepay_accountid; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_accountid)) { ?>
                <div class="text-danger"><?php echo $error_accountid; ?></div>
                <?php } ?>
            </div>
        </div>

<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_clientid; ?></label>
            <div class="col-sm-10">
                <input type="text" name="wepay_clientid" value="<?php echo $wepay_clientid; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_clientid)) { ?>
                <div class="text-danger"><?php echo $error_clientid; ?></div>
                <?php } ?>
            </div>
        </div>

<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_clientsecret; ?></label>
            <div class="col-sm-10">
                <input type="text" name="wepay_clientsecret" value="<?php echo $wepay_clientsecret; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_clientsecret)) { ?>
                <div class="text-danger"><?php echo $error_clientsecret; ?></div>
                <?php } ?>
            </div>
        </div>

<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_accesstoken; ?></label>
            <div class="col-sm-10">
                <input type="text" name="wepay_accesstoken" value="<?php echo $wepay_accesstoken; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" />
                <?php if (isset($error_accesstoken)) { ?>
                <div class="text-danger"><?php echo $error_accesstoken; ?></div>
                <?php } ?>
            </div>
        </div>

<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_feepayer; ?></label>
            <div class="col-sm-10">
                <select name="wepay_feepayer" id="input-status" class="form-control">
                    <?php if ($wepay_feepayer == 'Payer') { ?>
                <option value="Payer" selected="selected">Payer</option>
                <option value="Payee">Payee</option>
                <?php } else { ?>
                <option value="Payer">Payer</option>
                <option value="Payee" selected="selected">Payee</option>
                <?php } ?>
                 <?php if ($error_feepayer) { ?>
              <span class="error"><?php echo $error_feepayer; ?></span>
              <?php } ?>
                </select>
            </div>
        </div>
<div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $entry_chargetax; ?></label>
                <div class="col-sm-10">
                  <?php if ($wepay_chargetax == '1') { ?>
              <input type="radio" name="wepay_chargetax" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="wepay_chargetax" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="wepay_chargetax" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="wepay_chargetax" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?>
              
                <?php if ($error_chargetax) { ?>
              <span class="error"><?php echo $error_chargetax; ?></span>
              <?php } ?>
                </div>
              </div>

<div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
                <select name="wepay_geo_zone_id" id="input-status" class="form-control">
                    <option value="0"><?php echo $text_all_zones; ?></option>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $wepay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
        </div>

 <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
                <select name="wepay_status" id="input-status" class="form-control">
                    <?php if ($wepay_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

<div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_pending_status; ?></label>
            <div class="col-sm-10">
                <select name="wepay_pending_status_id" id="input-status" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $wepay_pending_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
        </div>

<div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_processed_status; ?></label>
            <div class="col-sm-10">
                <select name="wepay_processed_status_id" id="input-status" class="form-control">
                    <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $wepay_processed_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
                </select>
            </div>
        </div>

<div class="form-group ">
            <label class="col-sm-2 control-label" for="input-total"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
                <input type="text" name="wepay_sort_order" value="<?php echo $wepay_sort_order; ?>" placeholder="<?php //echo $entry_total; ?>" id="input-total" class="form-control" size="1" />
                
            </div>
        </div>

        
      </form>
 
    </div>
  </div>
</div>
<?php echo $footer; ?> 
