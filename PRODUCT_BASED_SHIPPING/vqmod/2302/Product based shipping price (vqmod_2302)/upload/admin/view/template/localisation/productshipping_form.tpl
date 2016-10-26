<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
      <?php if($product_basedshipping_id) {  ?><a href="<?php echo $import; ?>" data-toggle="tooltip" title="<?php echo $button_import; ?>" class="btn btn-success"><i class="fa fa-arrow-down"></i></a><?php } ?>
                <button type="submit" form="form-language" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
<?php if($product_basedshipping_id) { ?>
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
<?php } else { ?>
 <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_add; ?></h3>
<?php } ?>

            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">

                    <div class="form-group">
                        <label style="margin-left: -35px;" class="col-sm-2 control-label" for="input-code"><?php echo "Zone Name"; ?></label>
                        <div class="col-sm-10">
<?php if($product_basedshipping_id) { ?> 
                            <input disabled style="margin-left: 35px;" type="text"   name="zone_name" value="<?php echo $zone_name; ?>" > <input hidden style="margin-left: 35px;" type="text"   name="zone_name" value="<?php echo $zone_name; ?>" ></td>
 <?php } else { ?>  <input  style="margin-left: 35px;" type="text"   name="zone_name" value="<?php echo $zone_name; ?>" ><?php }?>
   <?php if($error_zonename!=""){ ?> <div clsss="error1" class="text-danger"><?php echo $error_zonename; ?></div> <?php } ?>
   <?php if($error_zonenameexist!=""){ ?> <div clsss="error1" class="text-danger"><?php echo $error_zonenameexist; ?></div> <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="margin-left: -66px;" for="input-code"><?php echo $text_timeslot_status; ?></label>
                        <div class="col-sm-10">
                            <select name="status" style="margin-left: 65px;">
                                <?php if ($status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td>
                        </div>
                    </div>



                </form>


                <?php if($product_basedshipping_id) { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-code"><?php echo "Zone Location"; ?></label>
                    <div class="col-sm-10">
                        <input  type="text" name="location" id="location" style="margin-left: -10px;margin-bottom: 12px;" value="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-code"><?php echo "Postcode"; ?></label>
                    <div class="col-sm-10">
                        <input  type="hidden"  name="product_basedshipping_id" value="<?php echo $product_basedshipping_id ?>" id="product_basedshipping_id" >
                        <input  type="text" name="postcode" style="margin-left: -10px;margin-bottom: 12px;" id="postcode" value=""> <button style="margin-left: 35px;" id="btnupdate"  >Add</button>
                    </div>
                </div>
                <div id="postcode_empty" style="margin-top: -45px;" class="alert-danger"></div>
                <div class="table">
                    <table  class="table table-bordered table-hover">
                        <thead>
                        <tr>

                            <td class="text-left">
                                <a href="" class=""><?php echo "Zone Location"; ?></a>
                            </td>
                            <td class="text-left">
                                <a href="" class=""><?php echo "Postcodes"; ?></a>
                            </td>
                            <td class="text-left">
                                <a href="" class=""><?php echo "Action"; ?></a>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($zonelocation_arrays) {  ?>
                        <?php foreach ($zonelocation_arrays as $zonelocation_array) { ?>
                        <tr>
                            <td class="text-left"><?php echo $zonelocation_array['zone_location']; ?></td>
                            <td class="text-left"><?php echo $zonelocation_array['postcode']; ?></td>
                            <td class="text-left"><button  value="<?php echo $zonelocation_array['zone_id']; ?>" id="delete"  >Delete</button></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php } ?>


            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $("#btnupdate").click(function(){

	var location=$("#location").val();
	var postcode=$("#postcode").val();
	var product_basedshipping_id=$("#product_basedshipping_id").val();

	if(postcode && location){

		$.ajax({
                type:'POST',
                datatype:'json',
                async:false,
                data: {location: location,postcode: postcode,product_basedshipping_id: product_basedshipping_id},
                url:"index.php?route=localisation/productshipping/ajaxupdateurl&token=<?php echo $token; ?>",
                success:function(data) {
			if(data){
				var passingtoHTML = "";
		                passingtoHTML += data;
		                $('#postcode_empty').html(passingtoHTML);
		                }
			else{
		                window.location.href=window.location.href;
			}

			    }
      });
      }
      else{
                   var passingtoHTML = "";
                   passingtoHTML += "Please Enter Postcode and zone location ";
                $('#postcode_empty').html(passingtoHTML);

          }
   });


//delete function
    $(document).on("click","#delete",function(){
	var locationid=$(this).val();
$.ajax({
                type:'POST',
                datatype:'json',
                async:false,
                data: {locationid: locationid},
                url:"index.php?route=localisation/productshipping/ajaxdelete&token=<?php echo $token; ?>",
                success:function(data) {
		            window.location.href=window.location.href;
			    }
      });
   });
});
</script>
<?php echo $footer; ?>


