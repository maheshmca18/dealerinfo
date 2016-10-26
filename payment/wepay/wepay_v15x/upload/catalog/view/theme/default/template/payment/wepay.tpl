<?php if (isset($error)) { ?>
    <div class="warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      
    </div>
    <?php } else { ?>
<h2> <?php echo $text_instruction; ?> </h2>
<p><b><?php echo $text_instruction_2; ?></b></p>
<form action="<?php print $redirect_wepay; ?>" method="post">
  <div class="buttons">
    <div class="right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="button" />
    </div>
  </div>
</form>
<?php } ?>
