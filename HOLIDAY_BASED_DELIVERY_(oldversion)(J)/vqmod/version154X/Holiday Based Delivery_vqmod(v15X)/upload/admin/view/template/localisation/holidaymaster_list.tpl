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
            <h1><img src="view/image/language.png" alt="" /> <?php echo $text_list; ?></h1>
            <div class="buttons"><a href="<?php echo $add; ?>" class="button"><?php echo $button_add; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
        </div>

          <div class="content">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
          <div class="table-responsive">
            <table class="list">
              <thead>
                <tr>

                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>

                    <td class="text-left">
                        <a href="" class=""><?php echo $text_holidayname; ?></a>
                    </td>

                    <td class="text-left" >
                        <a href="" class="" ><?php echo $text_holidaydate; ?></a>
                    </td>

                    <td class="text-left">
                        <a href="" class=""><?php echo $text_isrecursive; ?></a>
                    </td>

                    <td class="text-right"><?php echo $column_action; ?></td>


                </tr>
              </thead>
              <tbody>
                <?php if ($holidaymaster) { ?>
                <?php foreach ($holidaymaster as $holiday) { ?>

                <tr>
                  <td class="text-center"><?php if (in_array($holiday['holiday_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $holiday['holiday_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $holiday['holiday_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $holiday['holiday_name']; ?></td>
                  <td class="text-left"><?php echo $holiday['holiday_date']; ?></td>
                  <td class="text-right"><?php if($holiday['is_recursive'] == 1) { echo "Yes"; } elseif($holiday['is_recursive'] == 0) { echo "No"; }  ?></td>
                  <td class="text-right"><div class="buttons"><a href="<?php echo $holiday ['edit']; ?>"class="button"><?php echo $button_edit; ?></a></div></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
            <div class="row">
              <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
            </div>
      </div>
    </div>
</div>
<?php echo $footer; ?>
