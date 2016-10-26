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
  <?php //echo $breadcrumb['separator']; ?><li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
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
        	 <label class="col-sm-2 control-label" for="input-status">
			<?php echo $entry_public_key; ?>
		</label>
		<div class="col-sm-10">
         	 	<input name="recaptcha_public_key" value="<?php echo $public_key; ?>" class="form-control"> 
		</div>
          	  <?php if ($error_public_key) { ?>
			<div class="text-danger"><?php echo $error_public_key; ?></div>
           	 
           	 <?php } ?>
	 </div><br>
	<div class="form-group">
        	<label class="col-sm-2 control-label" for="input-status">
			<?php echo $entry_private_key; ?>
		</label>
	<div class="col-sm-10">
         	 <input name="recaptcha_private_key" value="<?php echo $private_key; ?>" class="form-control">
	 </div>
            <?php if ($error_private_key) { ?>
           	 <div class="text-danger"><?php echo $error_private_key; ?></div>
            <?php } ?>
        
	</div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_theme; ?></label>
            <div class="col-sm-10">
                 <input class="form-control color {hash:true}" value="<?php echo $colorpic; ?>" name="recaptcha_colorpic">

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
                <select name="recaptcha_status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
 
    </form>
</div>
	<div class="panel-heading">
   		<?php echo $text_help; ?>
  	
 	 </div>

 
</div>
 </div> </div>
<script type="text/javascript" src="view/jscolor/jscolor.js"></script>


<?php echo $footer; ?>
