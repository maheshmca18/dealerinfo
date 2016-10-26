<link rel="stylesheet" type="text/css" href="view/javascript/c3js/css/c3.css" />
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right"><a href="<?php echo $product_sale_report; ?>"><i class="fa fa-list-alt"></i>View Report</a>
        </div>
        <h3 class="panel-title"><i class="fa fa-pie-chart"></i> <?php echo $heading_title; ?></h3>
    </div>
    <div class="panel-body">
        <div id="donut_order" style="width: 100%; height: 280px;"></div>
    </div>
</div>
<script src="view/javascript/c3js/js/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="view/javascript/c3js/js/c3.min.js"></script>
<script type="text/javascript">
    $(document).on("ready",function(){
        $.ajax({
            type: 'get',
            url: 'index.php?route=dashboard/order_donut/orderChart&token=<?php echo $token; ?>',
            dataType: 'json',
            success: function(json) {
                if (typeof json['order_count'] == 'undefined') { return false; }
                var chart = c3.generate({
                    bindto: '#donut_order',
                    data: {
                        columns: json['order_count']['data'],
                        type: 'donut',
                        onclick: function (d, i) {
                            var category_name = d.id;
                             $.ajax({
                             type: 'POST',
                             url: 'index.php?route=dashboard/order_donut/orderChart&token=<?php echo $token; ?>',
                             data : {cat_name:category_name},
                             dataType: 'json',
                             success: function(json) {
                                 if (typeof json['order_count'] == 'undefined') {
                                     return false;
                                 }
                                 // empty validation on click
                                 if (jQuery.isEmptyObject(json['order_count']['data'])) {
                                     return false;
                                 } else {
                                 var chart = c3.generate({
                                     bindto: '#donut_order',
                                     data: {
                                         columns: json['order_count']['data'],
                                         type: 'donut'
                                     },
                                     tooltip: {
                                         format: {
                                             title: function (d) { return 'Orders Count';},
                                             value: function (value, ratio, id) {
                                                 //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                                 return value;
                                             }
                                         }
                                     },
                                     donut: {
                                         title: json['order_count']['title']
                                     }
                                 }); // eo chart
                             }// eo validation else
                             } // eo success
                             }); // ajax
                        }  // eo click
                    }, // eo data
                    donut: {
                        title: json['order_count']['title']
                    },
                    tooltip: {
                        format: {
                            title: function (d) { return 'Orders Count';},
                            value: function (value, ratio, id) {
                                //var format = id === 'data1' ? d3.format(',') : d3.format('$');
                                return value;
                            }
                        }
                    }
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });// eo ready
</script>
