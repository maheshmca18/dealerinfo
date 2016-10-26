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
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
<a href="http://wepay.com/payments-api" class="button" target="_blank" style="text-decoration: none; font-weight: bold;">Get API Credentials</a>
<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
 
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          
          <tr>
            <td><span class="required">*</span> <?php echo $entry_staging; ?></td>
            <td><select name="wepay_staging">
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
              </select></td>
          </tr>
          
          <tr>
            <td><span class="required">*</span> <?php echo $entry_accountid; ?></td>
            <td><input type="text" name="wepay_accountid" value="<?php echo $wepay_accountid; ?>" />
              <?php if ($error_accountid) { ?>
              <span class="error"><?php echo $error_accountid; ?></span>
              <?php } ?></td>
          </tr>
          
          <tr>
            <td><span class="required">*</span> <?php echo $entry_clientid; ?></td>
            <td><input type="text" name="wepay_clientid" value="<?php echo $wepay_clientid; ?>" />
              <?php if ($error_clientid) { ?>
              <span class="error"><?php echo $error_clientid; ?></span>
              <?php } ?></td>
          </tr>
          
          <tr>
            <td><span class="required">*</span> <?php echo $entry_clientsecret; ?></td>
            <td><input type="text" name="wepay_clientsecret" value="<?php echo $wepay_clientsecret; ?>" />
              <?php if ($error_clientsecret) { ?>
              <span class="error"><?php echo $error_clientsecret; ?></span>
              <?php } ?></td>
          </tr>
          
           <tr>
            <td><span class="required">*</span> <?php echo $entry_accesstoken; ?></td>
            <td><input type="text" name="wepay_accesstoken" value="<?php echo $wepay_accesstoken; ?>" size="90" />
              <?php if ($error_accesstoken) { ?>
              <span class="error"><?php echo $error_accesstoken; ?></span>
              <?php } ?></td>
          </tr>
          
           <tr>
            <td><span class="required">*</span> <?php echo $entry_feepayer; ?></td>
            <td><select name="wepay_feepayer">
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
              </select></td>
          </tr>
          
          <tr>
            <td><span class="required">*</span><?php echo $entry_chargetax; ?></td>
            <td><?php if ($wepay_chargetax == '1') { ?>
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
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="wepay_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $wepay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="wepay_status">
                <?php if ($wepay_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_pending_status; ?></td>
            <td><select name="wepay_pending_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $wepay_pending_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_processed_status; ?></td>
            <td><select name="wepay_processed_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $wepay_processed_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="wepay_sort_order" value="<?php echo $wepay_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 
