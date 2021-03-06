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
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>			
			<div class="panel-body">
			  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-testimonial" class="form-horizontal">

					<div class="form-group required">
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
					
					<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-testimonial"><?php echo $entry_testimonial; ?></label>
					<div class="col-sm-10">
					  <?php if(isset($updateform)){echo $testimonial;} else { ?>
					  <textarea type="text" name="testimonial" placeholder="<?php echo $entry_testimonial; ?>" rows="5" id="input-testimonial" class="form-control"><?php echo $testimonial; ?></textarea>
					  <?php } ?>
					  <?php if ($error_testimonial) { ?>
					  <div class="text-danger"><?php echo $error_testimonial; ?></div>
					  <?php } ?>
					</div>
				    </div>
					
					<?php if(isset($updateform)){ ?>
					   <tr>
						<td> <?php echo $entry_added_on; ?></td>
						<td>
						<?php echo $added_on; ?>
						  </td>
					  </tr>
					<?php } ?>
					
					<div class="form-group required">
					<label class="col-sm-2 control-label" for="input-address"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="status" id="input-status" class="form-control">
							<?php if ($status == "0") { ?>
							<option value="0" selected="selected"><?php echo $text_deactive; ?></option>
							<option value="1"><?php echo $text_approved; ?></option>
							<option value="2"><?php echo $text_disapproved; ?></option>
							 <?php } else if($status == "1") {  ?>
							
							<option value="0"><?php echo $text_deactive; ?></option>
							<option value="1" selected="selected"><?php echo $text_approved; ?></option>
							<option value="2"><?php echo $text_disapproved; ?></option>
							<?php } 
							else {  ?>
							<option value="0"><?php echo $text_deactive; ?></option>
							<option value="1"><?php echo $text_approved; ?></option>
							<option value="2" selected="selected"><?php echo $text_disapproved; ?></option>
							<?php }  ?>
						  </select>
					</div>
					</div>
			  </form>
		    </div>
	    </div>
    </div>	
</div>

<?php echo $footer; ?>