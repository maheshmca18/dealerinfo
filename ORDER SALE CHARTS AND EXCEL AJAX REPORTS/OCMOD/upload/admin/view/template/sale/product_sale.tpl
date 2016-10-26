<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $button_export_link; ?>" data-toggle="tooltip" title="<?php echo $button_export; ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i></a>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                     <form action="" method="post" enctype="multipart/form-data" id="form-product-sale">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-product-category"><?php echo $entry_product_category; ?></label>
                                    <select name="product-category" id="product-category" class="form-control">
                                        <option value="All">All</option>
                                        <?php foreach($category_details as $category_values){ ?>
                                        <option value="<?php echo $category_values['categoryid']; ?>"><?php echo $category_values['name']; ?></option>
                                        <?php } ?> <!-- eo foreach -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                                    <div class="input-group date">
                                        <input type='text' name="start_date" value="<?php echo $def_selected_start_date; ?>" class="date form-control" id='datetimepicker1' />
                                          <span class="input-group-btn">
                                          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                          </span></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-date-modified"><?php echo $entry_date_modified; ?></label>
                                    <div class="input-group date">
                                        <input type='text' name="end_date" value="<?php echo $def_selected_end_date; ?>" class="date form-control" id='datetimepicker2' />
                                          <span class="input-group-btn">
                                          <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                          </span></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                                    <select name="product_sale_status" id="input-product_sale-status" class="form-control">
                                        <option value="All">All</option>
                                        <?php foreach($order_status as $order_values){ ?>
                                        <option value="<?php echo $order_values['orderstatusid']; ?>"><?php echo $order_values['ordername']; ?></option>
                                        <?php } ?> <!-- eo foreach -->
                                    </select>
                                </div>
                            </div>

                        </div> <!-- eo row -->
                </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td class="text-left">
                                    <a class="sort-header" append_url="&sort=name&order=ASC"><?php echo $entry_product_name; ?>
                                </td>
                                <td class="text-left">
                                    <a class="sort-header" append_url="&sort=cat_name&order=ASC"><?php echo $entry_category_name; ?>
                                </td>
                                <td class="text-left">
                                    <a class="sort-header" append_url="&sort=tot_quantity&order=ASC"><?php echo $entry_total_quantity; ?>
                                </td>
                                <td class="text-left">
                                    <a class="sort-header" append_url="&sort=total_orders&order=ASC"><?php echo $entry_orders; ?>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="append-records">
                            <?php if ($product_sales) { ?>
                            <?php $i = 0; ?>
                            <?php foreach ($product_sales as $product_sales_info) { ?>
                            <?php $table_color = ( $i % 2 == 0)? 'even' : 'odd'; ?>
                            <tr class="custom-color-<?php echo $table_color; ?>">
                                <td class="text-left"><?php echo $product_sales_info['product_name']; ?></td>
                                <td class="text-left"><?php echo $product_sales_info['categoryname']; ?></td>
                                <td class="text-left"><?php echo $product_sales_info['totquantity']; ?></td>
                                 <td class="text-left"><?php echo $product_sales_info['total_orders']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                            <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <p class="text-content"> </p>
                <p align="center" class="custom-pagination"></p>
                <input type="hidden" class="final_record_class" name="final_record" value = "<?php echo $final_record; ?>" >
                <input type="hidden" class="current_record_class" name="current_record" value="1" >
                <input type="hidden" class="current_limit_class" name="current_limit" value="<?php echo $limit_record; ?>" >
                <!-- for sorting -->
                <input type="hidden" class="current_sorting_class" name="current_sorting" value="" >
                </form>
            </div>
        </div>
    </div>
    <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
    <script type="text/javascript" src="view/javascript/productsale.js"></script>
    <script src="view/javascript/jquery/jquery.bootpag.min.js"></script>
    <script type="text/javascript">
        $('.date').datetimepicker({
            pickTime: false,
            format : "DD-MM-YYYY"
        });
    </script>
    <style>
        tr.custom-color-odd{
            background-color: #f5f5f5;
        }
        a.sort-header{
            cursor: pointer;
        }
    </style>
</div>