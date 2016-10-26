<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
		<div class="page-header">
			<div class="container-fluid">
			  <div class="pull-right">
				<button type="submit" form="form-testimonial" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-testimonial" class="form-horizontal">
				
				<?php if(isset($updateform)){ ?>
					   <tr>
						<td> <?php echo $entry_added_on; ?></td>
						<td>
						<?php echo $added_on; ?>
						  </td>
					  </tr>
					<?php } ?>
				
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo "Widget Settings"; ?></label>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
					<div class="col-sm-10">
					<?php if(isset($updateform)){echo $name;} else { ?>
					  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
					  <?php } ?>
					  <?php if ($error_name) { ?>
					  <div class="text-danger"><?php echo $error_name; ?></div>
					  <?php } ?>
					</div>
					</div>
				
				<?php foreach ($custom_settings as $custom_setting) { ?>
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-width"><?php echo $custom_setting['testimonial_label']; ?></label>
				<div class="col-sm-10">
				  <?php if (strpos($custom_setting['testimonial_key'], 'color') !== false) { ?>
				  
				  <input class="form-control colors" type="text" value="<?php echo $custom_setting['testimonial_value']; ?>" name="<?php echo $custom_setting['testimonial_key']; ?>" placeholder="<?php echo "Choose Color"; ?>" autocomplete="off" style="background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"/> (click the textbox to pick your own color)
				  <?php } else { ?>
				  
				  <input type="text" class="form-control" value="<?php echo $custom_setting['testimonial_value']; ?>" name="<?php echo $custom_setting['testimonial_key']; ?>" autocomplete="off" style="background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"/>
				  <?php } ?>
				</div>
				</div>
				
				<?php } ?>
						  
				<div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="status" id="input-status" class="form-control">
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
		</div>	
	</div>
</div>
<?php echo $footer; ?>
<script type="text/javascript" src="view/javascript/jscolor/jscolor.js"></script>
		 

