<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">

    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-list').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo "Edit Postcode Module"; ?></h3>
            </div>

    <div class="panel-body">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-list" class="form-horizontal">
          <table id="list" class="list table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" style="text-align: center;" ><input type="checkbox" class="form-control" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-left"><?php if ($sort == 'p.postcode') { ?>
                <a href="<?php echo $sort_postcode; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_country; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_postcode; ?>"><?php echo $column_postcode; ?></a>
                <?php } ?></td>
                <td class="text-center"><?php echo $column_min_shipping; ?></td>
              <td class="center"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($postcodes) { ?>
            <?php foreach ($postcodes as $postcode) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($postcode['selected']) { ?>
                <input type="checkbox" class="form-control" name="selected[]" value="<?php echo $postcode['postcode_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" class="form-control" name="selected[]" value="<?php echo $postcode['postcode_id']; ?>" />
                <?php } ?></td>
              <td class="text-left"><?php echo $postcode['postcode']; ?></td>
              <td class="text-center"><?php echo $postcode['min_shipping']; ?></td>
              <td class="text-center"><?php echo $postcode['status']; ?></td>
              <td class="text-center"><?php foreach ($postcode['action'] as $action) { ?>
                  <a href="<?php print_r($action['href']); ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" class="form-control" colspan="5"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
        <div class="row">
            <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
            <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>