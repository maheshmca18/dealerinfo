<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-discountprice" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-store" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_admin; ?></label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <?php if ($discountprice_option=="percent") { ?>
                                <input type="radio" name="discountprice_option" value="percent" checked="checked" />
                                <?php echo $text_percent; ?>
                                <?php } else { ?>
                                <input type="radio" name="discountprice_option" value="percent" />
                                <?php echo $text_percent; ?>
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($discountprice_option=="price") { ?>
                                <input type="radio" name="discountprice_option" value="price" checked="checked" />
                                <?php echo $text_price; ?>
                                <?php } else { ?>
                                <input type="radio" name="discountprice_option" value="price" />
                                <?php echo $text_price; ?>
                                <?php } ?>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status" ><?php echo $text_label_color; ?></label>
                        <div class="col-sm-10">
                           <input class="form-control color" type="text" value="<?php echo $discountprice_label_color;?>" name="discountprice_label_color" placeholder="<?php echo "Choose Color"; ?>" autocomplete="off" style="background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"/> (click the textbox to pick your own label color)
                            <?php if($error_label_color!=""){ ?> <div class="text-danger"><?php echo $error_label_color; ?></div> <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status" ><?php echo $text_label_text_color; ?></label>
                        <div class="col-sm-10">
                           <input class="form-control color" type="text" value="<?php echo $discountprice_label_text_color;?>" name="discountprice_label_text_color" placeholder="<?php echo "Choose Color"; ?>" autocomplete="off" style="background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);"/> (click the textbox to pick your own label text color)
                            <?php if($error_label_text_color!=""){ ?> <div class="text-danger"><?php echo $error_label_text_color; ?></div> <?php } ?>
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="discountprice_status" id="input-status" class="form-control">
                                <?php if ($discountprice_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0" ><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0"selected="selected"><?php echo $text_disabled; ?></option>
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