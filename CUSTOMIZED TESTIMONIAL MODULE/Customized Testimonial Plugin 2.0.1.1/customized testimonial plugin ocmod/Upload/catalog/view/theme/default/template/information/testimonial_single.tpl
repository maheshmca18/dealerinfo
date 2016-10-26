<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div class="container" id="content"><?php echo $content_top; ?>
 <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
<div><hr /></div>
 <br />
   <?php if (isset($testimonials)) { ?>
  <div class="testimonials-loop" ><span class="testimonials"><?php echo $testimonials['testimonial']; ?><br />
      <span class="name">- <?php echo $testimonials['name']; ?></span>
      <?php 
            $old_date = $testimonials['added_on'];
            $new_date = date('d-M-Y', strtotime($old_date));
      ?>
      <span class="time"><?php echo $new_date; ?></span></span></div>
      <?php } else { ?>
    <div ><span class="testimonials">
      <span class="testimonials"><?php echo $text_no_results; ?></span> </div>   
             <?php } ?>
      
 <div class="content" id="content-about">
      <div>
      <h3>Add Testimonial</h3>
      <?php if ($error_login) { ?>
            <div class="text-danger"><?php echo $error_login; ?></div>
            <?php } ?>  
      </div>
      
      <div class="testimonial-form">
        <form name="form_testimonial" action="<?php echo "index.php?route=information/testimonial/testimonial_submit"; ?>" method="post" 
		enctype="multipart/form-data">

		<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-testimonial"><?php echo $entry_name; ?></label>
			<div class="col-sm-9">
			  <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo "Enter Name"; ?>" class="textbox-testimonials form-control input-lg" />
			  <?php if ($error_name) { ?>
			  <div class="text-danger"><?php echo $error_name; ?></div>
			  <?php } ?>
			</div>
			</div>
		
			 <div class="form-group required">
			<label class="col-sm-2 control-label" for="input-testimonial"><?php echo $entry_testimonial; ?></label>
			<div class="col-sm-9">
			  <textarea name="testimonial" placeholder="<?php echo "Enter Testimonial Text"; ?>" cols="50" rows="7" class="textarea-testimonials form-control" rows="" ><?php  echo $testimonial; ?></textarea>
			  <?php if ($error_testimonial) { ?>
			  <div class="text-danger"><?php echo $error_testimonial; ?></div>
			  <?php } ?>
			</div>
			</div> 

	   
        <div class="buttonsubmit"><input class="testimonial-form-button button btn btn-primary" type="button" value="Submit" onclick="SubmitForm();" /></div>
        <div class="buttonreset"><input class="testimonial-form-button button btn btn-primary" type="button" value="Reset" onclick="ResetForm();" /></div>
      </div>
      </form>
      </div>
   </div>
  <?php echo $content_bottom; ?>
</div>
<?php echo $footer; ?>
<script lang="javascript">
function SubmitForm()
{
  document.forms['form_testimonial'].submit() ;
}
function ResetForm()
{
  document.forms['form_testimonial'].reset() ;
}
</script>