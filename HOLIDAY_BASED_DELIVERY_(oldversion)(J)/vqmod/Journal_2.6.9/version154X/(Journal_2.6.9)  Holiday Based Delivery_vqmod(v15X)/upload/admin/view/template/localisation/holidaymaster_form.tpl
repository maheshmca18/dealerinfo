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

                            <!--<tr><td colspan="2" align="center"><b><h3><?php echo $text_addholidaymaster; ?></h3></b></td></tr>-->
                            <tr>
                                <td><span class="required">*</span> <label class="col-sm-2 control-label" for="input-code"><?php echo $text_holidayname; ?></label></td>
                                <td><input type="text" name="holiday_name" value="<?php echo $holiday_name; ?>" placeholder="Holiday Name" id="input-code" size="56" class="form-control" /><br />
                                    <?php if ($error_name) { ?>
                                    <div class="text-danger"><?php echo $error_name; ?></div>
                                    <?php } ?></td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span> <label class="col-sm-2 control-label" for=""><?php echo $text_holidaydate; ?></label></td>
                                <td> <input type="text" name="holiday_date" value="<?php echo $holiday_date; ?>" placeholder="Holiday Date" id="datepick" class="form-control"  size="56" /><br />
                                    <?php if ($error_date) { ?>
                                    <div class="text-danger"><?php echo $error_date; ?></div>
                                    <?php } ?></td>
                            </tr>
                            <tr>
                                <td><label class="col-sm-2 control-label" for=""><?php echo $text_isrecursive; ?></label></td>
                                <td>
                                    <input type="radio" name="is_recursive"  value="1" <?php echo ($is_recursive == 1 ) ? 'checked':'';?> />Yes
                                    <input type="radio" name="is_recursive"  value="0" <?php echo ($is_recursive == 0 ) ? 'checked':'';?> />No
                                <td>
                            </div>

                        </table>

                    </form>
              </div>
          </div>
</div>
<?php echo $footer; ?>

<script type="text/javascript">
            $('#datepick').datepicker({
                dateFormat: 'dd-m-yy'
                   // format:'DD-MM-YYYY'
                //pickTime: false
            });
</script>
