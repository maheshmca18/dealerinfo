<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-postcode" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo "Edit Postcode Module"; ?></h3>
            </div>


            <div class="panel-body">

                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-postcode" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                            <?php if ($error_name) { ?>
                            <div class="text-danger"><?php echo $error_name; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-height"><?php echo $entry_height; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="height" value="<?php echo $height; ?>" placeholder="<?php echo $entry_height; ?>" id="input-height" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-theme_color"><?php echo $entry_theme_color; ?></label>
                        <div class="col-sm-10">
                            <input type="color" name="theme_color" value="<?php echo $postcode_theme_color; ?>" placeholder="<?php echo $entry_theme_color; ?>" id="input-theme_color" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-header_text_color"><?php echo $entry_header_text_color; ?></label>
                        <div class="col-sm-10">
                            <input type="color" name="header_text_color" value="<?php echo $postcode_header_text_color; ?>" placeholder="<?php echo $entry_header_text_color; ?>" id="input-header_text_color" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-header_font_size"><?php echo $entry_header_font_size; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="header_font_size" value="<?php echo $postcode_header_font_size; ?>" placeholder="<?php echo $entry_header_font_size; ?>" id="input-header_font_size" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-error_text_color"><?php echo $entry_error_text_color; ?></label>
                        <div class="col-sm-10">
                            <input type="color" name="error_text_color" value="<?php echo $postcode_error_text_color; ?>" placeholder="<?php echo $entry_error_text_color; ?>" id="input-error_text_color" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-success_text_color"><?php echo $entry_success_text_color; ?></label>
                        <div class="col-sm-10">
                            <input type="color" name="success_text_color" value="<?php echo $postcode_success_text_color; ?>" placeholder="<?php echo $entry_success_text_color; ?>" id="input-success_text_color" class="form-control" />
                        </div>
                    </div>

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

                   <!-- <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-postcode" class="form-horizontal">
                        <div class="tab-pane" id="tab-module">
                            <div class="table-responsive">
                                <table id="module" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-left"><?php echo $entry_layout; ?></td>
                                        <td class="text-right"><?php echo $entry_position; ?></td>
                                        <td class="text-right"><?php echo $entry_status; ?></td>
                                        <td class="text-right"><?php echo $entry_sort_order; ?></td>
                                        <td></td>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $module_row = 0; ?>
                                    <?php foreach ($modules as $module) { ?>
                                    <tr id="module-row<?php echo $module_row; ?>">
                                        <td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][layout_id]" class="form-control">
                                                <?php foreach ($layouts as $layout) { ?>
                                                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                                <?php } else { ?>
                                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                                <?php } ?>
                                                <?php } ?>
                                            </select></td>

                                        <td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][position]" class="form-control">
                                                <?php if ($module['position'] == 'content_top') { ?>
                                                <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                                                <?php } else { ?>
                                                <option value="content_top"><?php echo $text_content_top; ?></option>
                                                <?php } ?>
                                                <?php if ($module['position'] == 'content_bottom') { ?>
                                                <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                                                <?php } else { ?>
                                                <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                                                <?php } ?>
                                                <?php if ($module['position'] == 'column_left') { ?>
                                                <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                                                <?php } else { ?>
                                                <option value="column_left"><?php echo $text_column_left; ?></option>
                                                <?php } ?>
                                                <?php if ($module['position'] == 'column_right') { ?>
                                                <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                                                <?php } else { ?>
                                                <option value="column_right"><?php echo $text_column_right; ?></option>
                                                <?php } ?>
                                            </select></td>


                                        <td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][status]" class="form-control">
                                                <?php if ($module['status']) { ?>
                                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                <option value="0"><?php echo $text_disabled; ?></option>
                                                <?php } else { ?>
                                                <option value="1"><?php echo $text_enabled; ?></option>
                                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                <?php } ?>
                                            </select></td>
                                        <td class="text-right"><input type="text" name="postcode_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" class="form-control"/></td>

                                        <td class="text-left"><button type="button" onclick="$('#module-row<?php echo $module_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                    </tr>
                                    <?php $module_row++; ?>
                                    <?php } ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td class="text-left"><button type="button" onclick="addModule();" data-toggle="tooltip" title="<?php echo "Add Module" ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
            </form> -->

            </div>
        </div>
    </div>
</div>



<!-- <script type="text/javascript" src="view/javascript/jscolor/jscolor.js"></script> -->
<script type="text/javascript"><!--
    var module_row = <?php echo $module_row; ?>;

    function addModule() {

        html  = '<tr id="module-row' + module_row + '">';

        html += '<td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][layout_id]" class="form-control">';
            <?php foreach ($layouts as $layout) { ?>
        html += '<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
            <?php } ?>
        html += '</select></td>';

        html += '<td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][position]" class="form-control">';
        html += '<option value="content_top"><?php echo $text_content_top; ?></option>;'
        html += '<option value="content_bottom"><?php echo $text_content_bottom; ?></option>;'
        html += '<option value="column_left"><?php echo $text_column_left; ?></option>;'
        html += '<option value="column_right"><?php echo $text_column_right; ?></option>;'
        html += '</select></td>';

        html += '<td class="text-left"><select name="postcode_module[<?php echo $module_row; ?>][status]" class="form-control">';
        html += '<option value="0"><?php echo $text_disabled; ?></option>';
        html += '<option value="1"><?php echo $text_enabled; ?></option>';
        html += '</select></td>';

        html += '<td class="text-right"><input type="text" name="postcode_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" class="form-control"/></td>';

        html += '<td class="text-left"><button type="button" onclick="$(\'#module-row' + module_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

        $('#module tbody').append(html);

        module_row++;
    }
</script>


<?php echo $footer; ?>