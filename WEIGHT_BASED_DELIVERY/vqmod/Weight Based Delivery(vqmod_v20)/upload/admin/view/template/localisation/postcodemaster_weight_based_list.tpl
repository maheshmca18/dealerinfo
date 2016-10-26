<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-language').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-language">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                <!--000000000000000000000000000000000000000000000-->

                    <td class="text-left">
                        <a href="" class=""><?php echo $text_postcode; ?></a>
                    </td>

                    <td class="text-left">
                        <a href="" class=""><?php echo $text_conditiontype_weight; ?></a>
                    </td>


                    <td class="text-left">
                        <a href="" class=""><?php echo $text_shipping_charge; ?></a>
                    </td>

                    <td class="text-left">
                        <a href="" class=""><?php echo $entry_status; ?></a>
                    </td>

                    <td class="text-right"><?php echo $column_action; ?></td>

                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                </tr>
              </thead>
              <tbody>


                <?php if ($postcodemaster) { ?>

                <?php $temp=0; ?>

                <?php foreach ($postcodemaster as $postcode) { ?>

                <?php foreach ($postcode as $postcodecount) { ?>

                <?php $result = count($postcode);?>

                  <tr>
                      <?php
                      if($temp!=$postcodecount['postcode']) { ?>

                      <td class="text-left" rowspan="<?php echo $result; ?>"><?php echo $postcodecount['postcode']; ?></td> <?php } ?>

                     <?php  $temp=$postcodecount['postcode']; ?>

                    <td class="text-left"><?php if($postcodecount['condition_type']==1) { echo  $text_conditiontype_min . $postcodecount['min_weight'].'kg'; } elseif($postcodecount['condition_type']==2) { echo $text_conditiontype_between . $postcodecount['min_weight'].'kg  to  '.$postcodecount['max_weight'].'kg'; } if($postcodecount['condition_type']==3) { echo $text_conditiontype_max . $postcodecount['max_weight'].'kg'; }  ?></td>

                    <td class="text-left"><?php echo $postcodecount['shipping_charge']; ?></td>

                    <td class="text-left"><?php if($postcodecount['status'] == 1) { echo $text_status_enabled; } elseif($postcodecount['status'] == 0) { echo  $text_status_disabled; } ?></td>

                    <td class="text-right"><a href="<?php echo $postcodecount ['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>

                    <td class="text-center"><?php if (in_array($postcodecount['postcode_id'], $selected)) { ?>

                        <input type="checkbox" name="selected[]" value="<?php echo $postcodecount['postcode_id']; ?>" checked="checked" />
                        <?php } else { ?>
                        <input type="checkbox" name="selected[]" value="<?php echo $postcodecount['postcode_id']; ?>" />
                        <?php } ?>
                    </td>
                    <?php  } }  ?>
                </tr>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <!--000000000000000000000000000000000000000000000-->
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>

