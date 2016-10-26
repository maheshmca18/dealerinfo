<style>
    /* custom inclusion of right, left and below tabs */
    .tabs-left > .nav-tabs > li,
    .tabs-right > .nav-tabs > li {
        float: none;
    }

    .tabs-left > .nav-tabs > li > a,
    .tabs-right > .nav-tabs > li > a {
        min-width: 74px;
        margin-right: 0;
        margin-bottom: 3px;
    }

    .tabs-left > .nav-tabs {
        float: left;
        margin-right: 19px;
        border-right: 1px solid #ddd;
    }

    .tabs-left > .nav-tabs > li > a {
        margin-right: -1px;
        -webkit-border-radius: 4px 0 0 4px;
        -moz-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    .tabs-left > .nav-tabs > li > a:hover,
    .tabs-left > .nav-tabs > li > a:focus {
        border-color: #eeeeee #dddddd #eeeeee #eeeeee;
    }

    .tabs-left > .nav-tabs .active > a,
    .tabs-left > .nav-tabs .active > a:hover,
    .tabs-left > .nav-tabs .active > a:focus {
        border-color: #ddd transparent #ddd #ddd;
        *border-right-color: #ffffff;
    }


</style>

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

                                <div id="rootwizard" class="tabbable tabs-left">
                                    <ul>
                                        <li><a href="#tab-sunday" data-toggle="tab" class="one"><h4><?php echo "Sunday"; ?></h4></a></li>
                                        <li><a href="#tab-monday" data-toggle="tab"><h4><?php echo "Monday"; ?></h4></a></li>
                                        <li><a href="#tab-tuesday" data-toggle="tab"><h4><?php echo "Tuesday"; ?></h4></a></li>
                                        <li><a href="#tab-wednesday" data-toggle="tab"><h4><?php echo "Wednesday"; ?></h4></a></li>
                                        <li><a href="#tab-thursday" data-toggle="tab"><h4><?php echo "Thursday"; ?></h4></a></li>
                                        <li><a href="#tab-friday" data-toggle="tab"><h4><?php echo "Friday"; ?></h4></li></a></li>
                                        <li><a href="#tab-saturday" data-toggle="tab"><h4><?php echo "Saturday"; ?></h4></li></a>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab-sunday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id1" value="<?php echo 1; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today1"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id1" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php  foreach ($product_relateds1 as $product_related) { ?>
                                                        <div id="product_id1<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id1[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-monday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id2" value="<?php echo 2; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today2"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id2" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds2 as $product_related) { ?>
                                                        <div id="product_id2<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id2[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-tuesday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id3" value="<?php echo 3; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today3"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id3" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds3 as $product_related) { ?>
                                                        <div id="product_id3<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id3[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-wednesday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id4" value="<?php echo 4; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today4"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id4" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds4 as $product_related) { ?>
                                                        <div id="product_id4<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id4[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-thursday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id5" value="<?php echo 5; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today5"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id5" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds5 as $product_related) { ?>
                                                        <div id="product_id5<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id5[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-friday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id6" value="<?php echo 6; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today6"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id6" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds6 as $product_related) { ?>
                                                        <div id="product_id6<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id6[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-saturday">
                                            <div class="form-group">
                                                <label class="col-sm-2" for="input-related"><span data-toggle="tooltip" style="font-size: 15px"><?php echo "Product Name"; ?></span></label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                                    <input type="hidden" name="day_id7" value="<?php echo 7; ?>" placeholder=""  class="form-control" />
                                                    <!-- <input type="hidden" name="day1" value="<?php echo 'sunday'; ?>" placeholder=""  class="form-control" />-->
                                                    <input type="text" name="product_today7"  placeholder="<?php echo 'Product of The Day';?>" id="input-related" class="form-control"/>
                                                    <div id="product_id7" class="well well-sm" style="height: 150px; overflow: auto;">
                                                        <?php foreach ($product_relateds7 as $product_related) { ?>
                                                        <div id="product_id7<?php echo $product_related['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product_related['name']; ?>
                                                            <input type="hidden" name="product_id7[]" value="<?php echo $product_related['product_id']; ?>" />
                                                        </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
               </div>
           </div>
       </div>


<script src="view/javascript/bootstrap/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-tabs'});
            window.prettyPrint && prettyPrint()
        });
    </script>

<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today1\']').autocomplete({
    'source': function(request, response, token) {
    $.ajax({
    url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
    dataType: 'json',
    success: function(json) {
    response($.map(json, function(item) {
    return {
    label: item['name'],
    value: item['product_id']
    }
    }));
    }
    });
    },
    'select': function(item) {
    $('input[name=\'product_today1\']').val('');

    $('#product_id1' + item['value']).remove();


    $('#product_id1').prepend('<div id="product_id1' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id1[]" value="' + item['value'] + '" /></div>');
    }
    });

    $('#product_id1').delegate('.fa-minus-circle', 'click', function() {
    $(this).parent().remove();
    });
</script>


<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today2\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today2\']').val('');

            $('#product_id2' + item['value']).remove();

            $('#product_id2').prepend('<div id="product_id2' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id2[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id2').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today3\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today3\']').val('');

            $('#product_id3' + item['value']).remove();

            $('#product_id3').prepend('<div id="product_id3' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id3[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id3').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today4\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today4\']').val('');

            $('#product_id4' + item['value']).remove();

            $('#product_id4').prepend('<div id="product_id4' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id4[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id4').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today5\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today5\']').val('');

            $('#product_id5' + item['value']).remove();

            $('#product_id5').prepend('<div id="product_id5' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id5[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id5').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today6\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today6\']').val('');

            $('#product_id6' + item['value']).remove();

            $('#product_id6').prepend('<div id="product_id6' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id6[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id6').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<script>
    var token=$('#token_get').val();
    $('input[name=\'product_today7\']').autocomplete({
        'source': function(request, response, token) {
            $.ajax({
                url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'product_today7\']').val('');

            $('#product_id7' + item['value']).remove();

            $('#product_id7').prepend('<div id="product_id7' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_id7[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#product_id7').delegate('.fa-minus-circle', 'click', function() {
        $(this).parent().remove();
    });
</script>
<?php echo $footer; ?>
