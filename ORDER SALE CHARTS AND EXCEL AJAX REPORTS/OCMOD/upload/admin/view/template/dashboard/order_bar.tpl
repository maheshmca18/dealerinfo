<link rel="stylesheet" type="text/css" href="view/javascript/c3js/css/c3.css" />
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right"><a href="<?php echo $product_sale_report; ?>"><i class="fa fa-list-alt"></i>View Report</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
            <ul id="orderstatus1" class="dropdown-menu dropdown-menu-right">
                <li><a href="all"><?php echo "all"; ?></a></li>
                <li><a href="day"><?php echo $text_day; ?></a></li>
                <li><a href="week"><?php echo $text_week; ?></a></li>
                <li class="active"><a href="month"><?php echo $text_month; ?></a></li>
                <li><a href="year"><?php echo $text_year; ?></a></li>
            </ul>
        </div>
        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> <?php echo $heading_title; ?></h3>
    </div>
    <div class="panel-body">
        <div id="chart_status" style="width: 100%; height: 260px;"></div>
    </div>
</div>
<script src="view/javascript/c3js/js/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="view/javascript/c3js/js/c3.min.js"></script>
<script type="text/javascript">
    $("#orderstatus1 a").on('click', function(e) {
        e.preventDefault();
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $.ajax({
            type: 'get',
            url: 'index.php?route=dashboard/order_bar/orderChart&token=<?php echo $token; ?>&range=' + $(this).attr('href'),
            dataType: 'json',
            success: function(json) {
                //console.log(json);
                if (typeof json['order_count'] == 'undefined') { return false; }
                var chart2 = c3.generate({
                    bindto: '#chart_status',
                    data: {
                        columns: [
                            json['order_count']['data'],
                            json['total']['data']
                        ],
                        type: 'bar'
                    },
                    bar: {
                        width: {
                            ratio: 0.5 // this makes bar width 50% of length between ticks
                        }
                    },
                    axis:{
                        x:{
                            type: 'category',
                            categories:json['xaxis'],
                            tick: {
                                count: json['disp_count']
                            } // eo tick
                        } // eo x
                    } // eo axis
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    $('#orderstatus1 .active a').trigger('click');
</script>