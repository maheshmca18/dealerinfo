<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <?php if(!isset($sampletabledata)){ ?>
            <div class="pull-right"><a href="<?php echo $sampleexport; ?>" data-toggle="tooltip" title="<?php echo $sample_export; ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i></a> <button class="btn btn-primary" title="" data-toggle="tooltip" form="form" type="submit" name="submit" data-original-title="Save"><i class="fa fa-save"></i></button>
            </div>
            <?php } ?>

            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
 <?php if($errorfilesize!=""){ ?> <div class="text-danger"><?php echo "Sorry, your file is too large."; ?></div> <?php } ?>

    <div class="content">
        <?php if(isset($sampletabledata)) { //valid empty start                                                

			$ordertracker_table_data="";

			$ordertracker_table_data .="<div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td class='text-left'>Order Id</td><td class='text-left'>Courier Company</td><td class='text-left'>Tracking Code</td></tr></thead><tbody>";

            $excel_fields_error = array();

            $product_names = array();

            $excel_field_validate = 1;
//print_r($tracker_idvalid);
         
            foreach($sampletabledata as $trackertdata)  { 

            $ordertracker_table_data .="<tr><td class='left'>".$trackertdata['order_id']."</td><td class='left'>".$trackertdata['courier_company_name']."</td><td class='left'>".$trackertdata['tracking_code']."</td></tr>";

//print_r($trackertdata);
			if($excel_field_validate) {
				if ($trackertdata['courier_company_name'] == '') { 
					$excel_fields_error['courier_company_name']="Enter CourierCompany";
					$excel_field_validate=0;
				}

				if ($trackertdata['tracking_code'] == '') { 
					$excel_fields_error['tracking_code']="Enter Tracking code";
					$excel_field_validate=0;
				}

				if ($trackertdata['order_id'] == '') { 
					$excel_fields_error['order_id']="Enter orderid";
					$excel_field_validate=0;
				}

				 if (!in_array($trackertdata['courier_company_name'],$tracker_arrays)) { 
					$excel_fields_error['courier_company_invalid']=$trackertdata['courier_company_name']. " Not Valid Courier Company";
					$excel_field_validate=0;
				 }

				 if (!in_array($trackertdata['order_id'],$getOrderid)) { 
					$excel_fields_error['order_invalid']="Order ID : " . $trackertdata['order_id']. "    Not Valid  ";
					$excel_field_validate=0;
				 }

				foreach($tracker_idvalid as $tracker_idvalid1) { 
				    if($trackertdata['order_id']==$tracker_idvalid1['orderid']){
				         if ($tracker_idvalid1['tracking_code']!=="") { 
						$excel_fields_error['tracking_code']="Order ID  ".$tracker_idvalid1['orderid']."  is already update the Trackerlink";
						$excel_field_validate=0;
					}
				    }
				} 
				




                

	 }

      }  //valid empty end

            $ordertracker_table_data .="</tbody></table></div>";
    ?>

    <div class="buttons">
        <?php if($excel_field_validate) { ?>
         <a href="<?php echo $importdataurl; ?>" class="button" id="button-save">Publish</a>
           <!--<a href="javascript:void(0)" class="button" id="button-save">Publish</a>-->
        <?php } ?>
        <a href="<?php echo $action; ?>" class="button">Go Back</a>
    </div>

    <?php if(!$excel_field_validate) { ?>
    <div>
        </br>
        <h4>Warning :
            <?php
			 if(count($excel_fields_error)>0)
            {
            foreach($excel_fields_error as $current_error)
            {
            echo "<span class='error'>".$current_error."</span><br>";
            }
            }
            ?>
        </h4>
        <h5>Kindly goback then upload valid Excel file only</h5>
    </div>
    <?php }  ?>
    <h4></h4>
    <?php echo $ordertracker_table_data; ?>
    <?php } else { ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="table table-bordered table-hover">

 			
            <tr>
                <td class="text-left"><?php echo $entry_import; ?></td>
                <td class="text-left">
                    <input type='file' name='file' />
                    <?php if ($error_file) { ?>
                    <span class="error"><?php echo $error_file; ?></span>
                    <?php } ?>
                    <?php if ($error_fields) { ?>
                    <span class="error"><?php echo $error_fields; ?></span>
                    <?php } ?>
                </td>
            </tr>
        
        </table>
    </form>
    <?php } ?>
</div>
</div>
<?php echo $footer; ?>
</div>

<style type="text/css">
    .button {
        text-decoration: none;
        color: #FFF;
        display: inline-block;
        padding: 3px 5px;
        background: #003A88;
        -webkit-border-radius: 10px 10px 10px 10px;
        -moz-border-radius: 10px 10px 10px 10px;
        -khtml-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        cursor:pointer;
    }

    .error
    {
        color:red;
    }
</style>

<script type="text/javascript"><!--
    $('#button-save').on('click', function() {      

        $.ajax({
            url:'index.php?route=sale/order/passingvalues',
            type: 'POST',
            dataType: 'json',
            async:false,
            // data:data,

            success: function(data) {
                console.log(data);
            }
        });
    });
    //--></script>
