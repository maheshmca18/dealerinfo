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
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

                <table class="form">
                    <tr>
                        <td> <?php echo $entry_displayordersuccess; ?></td>
                        <td class="left"><select name="ordersuccess_status">
                                <?php if ($ordersuccess_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>


            <tr>
               <td> <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_beforeorder; ?></label></td>
                <td>

                            <textarea name="ordersuccess_beforemessage" id="summernote" cols="30" rows="10" ><?php if($ordersuccess_aftermessage)
              {
              echo $ordersuccess_beforemessage;
              } ?>              </textarea>
                    <span style="color:#00b3ee;"><?php echo $entry_msgbeforeorder; ?> </span></td>
            </tr>
                    <tr>
                        <td>  <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_afterorder; ?></label></td>
                        <td>

                            <textarea name="ordersuccess_aftermessage" id="summernoteafter" cols="30" rows="10" ><?php if($ordersuccess_aftermessage)
              {
              echo $ordersuccess_aftermessage;
              } ?>
              </textarea>
                            <span style="color:#00b3ee;"><?php echo $entry_msgafterorder; ?> </span></td>
                    </tr>
</table>

        </form>
    </div>
</div>
</div>
 </div> </div>



<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

        CKEDITOR.replace('summernote', {
            filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
        });

        CKEDITOR.replace('summernoteafter', {
            filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
            filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
        });

</script>




<?php echo $footer; ?>
