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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/country.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_category; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_category; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'iso_code_2') { ?>
                <a href="<?php echo $sort_iso_code_2; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer_group; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_iso_code_2; ?>"><?php echo $column_customer_group; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'iso_code_3') { ?>
                <a href="<?php echo $sort_iso_code_3; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_percentage; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_iso_code_3; ?>"><?php echo $column_percentage; ?></a>
                <?php } ?></td>
              <?php /*<td class="left"><?php if ($sort == 'iso_code_3') { ?>
                <a href="<?php echo $sort_iso_code_3; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_start; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_iso_code_3; ?>"><?php echo $column_date_start; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'iso_code_3') { ?>
                <a href="<?php echo $sort_iso_code_3; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_end; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_iso_code_3; ?>"><?php echo $column_date_end; ?></a>
                <?php } ?></td>
                */ ?>
              <td class="left"><?php if ($sort == 'iso_code_3') { ?>
                <a href="<?php echo $sort_iso_code_3; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_iso_code_3; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($categorydiscounts) { ?>
            <?php foreach ($categorydiscounts as $categorydiscount) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($categorydiscount['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $categorydiscount['category_discount_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $categorydiscount['category_discount_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $categorydiscount['category_id']; ?></td>
              <td class="left"><?php echo $categorydiscount['customer_group_id']; ?></td>
              <td class="left"><?php echo $categorydiscount['percentage']; ?></td>
              <?php /*
              <td class="left"><?php echo $categorydiscount['date_start']; ?></td>
              <td class="left"><?php echo $categorydiscount['date_end']; ?></td>
              */ ?>
              <td class="left"><?php echo $categorydiscount['status']; ?></td>
              <td class="right"><?php foreach ($categorydiscount['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
