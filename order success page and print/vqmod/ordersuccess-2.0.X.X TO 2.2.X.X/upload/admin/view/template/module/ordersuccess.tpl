<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
<div class="pull-right">
        <div class="buttons"><a onclick="$('#form').submit();" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><span><i class="fa fa-save"></i></span></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
</div>
</div>
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
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
  <div class="panel panel-default">
<div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_displayordersuccess; ?></label>
                <div class="col-sm-10">
                    <select name="ordersuccess_status" id="input-status" class="form-control">
                        <?php if ($ordersuccess_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_beforeorder; ?></label>
                <div class="col-sm-10">

                            <textarea name="ordersuccess_beforemessage" class="summernote" cols="30" rows="10" ><?php if($ordersuccess_aftermessage)
              {
              echo $ordersuccess_beforemessage;
              } ?>              </textarea>
                    <div class="col-sm-10" style="color:#00b3ee;"><?php echo $entry_msgbeforeorder; ?> </div>
                </div>
            </div>
      <div class="form-group">
          <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_afterorder; ?></label>
          <div class="col-sm-10">
              <textarea name="ordersuccess_aftermessage" class="summernote" cols="30" rows="10" ><?php if($ordersuccess_aftermessage)
              {
              echo $ordersuccess_aftermessage;
              } ?>
              </textarea>
              <div class="col-sm-10" style="color:#00b3ee;"><?php echo $entry_msgafterorder; ?> </div>
          </div>
      </div>
  </div>
        </form>
</div>
</div>
 </div> </div>

<?php echo $footer; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [

                ['style', ['style']],
                ['fontfamily', ['fontfamily']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['help', ['help']]
            ]
        });
    });
</script>
