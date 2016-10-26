<?php if (isset($error)) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } else { ?>
<h2> <?php echo $text_instruction; ?> </h2>
<p><b><?php echo $text_instruction_2; ?></b></p>

<form action="<?php print $redirect_wepay; ?>" method="post">
 <div class="pull-right">
                <input type="submit" value="<?php echo $button_confirm; ?>"   id="button-confirm" class="btn btn-primary" data-loading-text="<?php echo $text_loading; ?>" />
            </div>
  
</form>
 <?php } ?>
