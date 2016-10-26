<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
<div class="pull-right">
        <div class="buttons"><a onclick="$('#form').submit();" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><span><i class="fa fa-save"></i></span></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
</div>
</div>
    <h1><?php echo $heading_title; ?></h1>    
<ul class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php //echo $breadcrumb['separator']; ?><li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
  <?php } ?>
 </ul>
</div>
  </div>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
<div class="container-fluid">
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

  <div class="panel panel-default">

  <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $action_heading__title; ?></h3>
      </div>
  
<div class="panel-body">
    <div class="well">
        <div class="row">
            <h6>Following are the available shortcodes you can use in Return</h6>
            </div>
        <?php
        $string = "{return_id},{store_name},{store_url},{date_added},{return_reason},{return_status},{comment},{order_id},{date_ordered},{product},{quantity},{opened},{firstname},{lastname},{email},{telephone}";
        $string1 = explode(",",$string);
         $shortcodes = array();
         $shortcodes = $string1;
        ?>
        <div class="row">
            <?php
            foreach($shortcodes as $shortcode_name){
            ?>
            <div class="col-sm-3">
                <p><?php echo $shortcode_name; ?></p>
            </div>
            <?php
        }
        ?>
        </div>
    </div>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
		<ul class="nav nav-tabs">
            <li class="active"><a href="#tab-setting" data-toggle="tab"><?php echo $entry_tab_setting;?></a></li>
            <li><a href="#tab-attribute" data-toggle="tab"><?php echo $entry_tab_reason; ?></a></li>
			<li><a href="#tab-return" data-toggle="tab"><?php echo $entry_tab_return; ?></a></li>
          </ul>
		  
		  <!-- by karthi for setting -->
            <div class="tab-content">
		  
				<div class="tab-pane active" id="tab-setting">
				 <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                    <select name="ordercancel_status" id="input-status" class="form-control">
                        <?php if ($ordercancel_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_returndate; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="ordercancel_returndate" value="<?php echo $ordercancel_returndate; ?>" placeholder="<?php echo $entry_returndate; ?>" id="input-name" class="form-control" />
                </div>
				<span style="margin-left: 170px;color: #0b559b">[NOTE : Specify Days for Customer can Return the ordered Products, when order has Completed or Shipped]</span>
            </div>

                <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_cancel; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="ordercancel_cancel" value="<?php echo $ordercancel_cancel; ?>" placeholder="<?php echo $entry_cancel; ?>" id="input-name" class="form-control" />
                </div>
				<span style="margin-left: 170px;color: #0b559b">[NOTE : Specify Hours for Customer can Cancelling the order from order placed time.]</span>
            </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entrycancel_adminsubject; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="ordercancel_adminsubject" value="<?php echo $ordercancel_adminsubject; ?>" placeholder="<?php //echo $entry_cancel; ?>" id="input-name" class="form-control" />
                        </div>
                    </div>

      <div class="form-group">
          <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_adminmessagecontent; ?></label>
          <div class="col-sm-10">
              <textarea name="ordercancel_adminmessagecontent" class="summernote" cols="30" rows="10" ><?php if($ordercancel_adminmessagecontent)
              {
              echo $ordercancel_adminmessagecontent;
              } ?>
              </textarea>

          </div>
      </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entrycancel_customersubject; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="ordercancel_customersubject" value="<?php echo $ordercancel_customersubject; ?>" placeholder="<?php //echo $entry_cancel; ?>" id="input-name" class="form-control" />
                        </div>
                    </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_usermessagecontent; ?></label>
                <div class="col-sm-10">
              <textarea name="ordercancel_usermessagecontent" class="summernote" cols="30" rows="10" ><?php if($ordercancel_usermessagecontent)
              {
              echo $ordercancel_usermessagecontent;
              } ?>
              </textarea>

                </div>
            </div>
                
                </div>
				
				<!-- for adding reason -->           
			  <div class="tab-pane" id="tab-attribute">
               <div class="table-responsive">
                <table id="reason" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"><?php echo $entry_reason; ?></td>
                      <td><?php echo $entry_sort; ?></td>
					  <td><?php echo $entry_action; ?></td>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  //loop through foreach
				  if($cancel_reason){
				  foreach($cancel_reason as $reason){
				  ?>
                    <tr>
                      <td class="text-left" style="width: 40%;"><input class="form-control" placeholder="<?php echo $entry_reason; ?>" type="text" value="<?php echo $reason['cance_description']; ?>"/></td>
                      <td class="text-left" style="width: 40%;"><input class="form-control" placeholder="<?php echo $entry_sort; ?>" type="text" value="<?php echo $reason['sort']; ?>"/></td>
                      <td class="text-left"><button type="button" cancel-id="<?php echo $reason['cancel_description_id']; ?>" data-toggle="tooltip" title="<?php echo $entry_btn_remove?>" class="cancel_delete btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
				  <?php } }?>
					
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addordcancel(this)" data-toggle="tooltip" title="<?php echo $entry_btn_add;?>" class="hideonclick btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
			

              <!-- for adding return -->

			  <div class="tab-pane" id="tab-return">

                  <!-- admin subject -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-status"><?php echo $entryreturn_customersubject; ?></label>
                      <div class="col-sm-10">
                          <input type="text" name="ordercancel_returnadminsubject" value="<?php echo $orderreturn_adminsubject; ?>" placeholder="<?php //echo $entry_cancel; ?>" id="input-name" class="form-control" />
                      </div>
                  </div>

                  <div class="form-group">
          <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_returnadminmessagecontent; ?></label>
          <div class="col-sm-10">
              <textarea name="ordercancel_returnadminmessagecontent" class="summernote" cols="30" rows="10" ><?php if($ordercancel_returnadminmessagecontent)
              {
              echo $ordercancel_returnadminmessagecontent;
              } ?>
              </textarea>

          </div>
      </div>
                  <!-- customer subject -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label" for="input-status"><?php echo $entryreturn_customersubject; ?></label>
                      <div class="col-sm-10">
                          <input type="text" name="ordercancel_returncustomersubject" value="<?php echo $orderreturn_customersubject; ?>" placeholder="<?php //echo $entry_cancel; ?>" id="input-name" class="form-control" />
                      </div>
                  </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_returnusermessagecontent; ?></label>
                <div class="col-sm-10">
              <textarea name="ordercancel_returnusermessagecontent" class="summernote" cols="30" rows="10" ><?php if($ordercancel_returnusermessagecontent)
              {
              echo $ordercancel_returnusermessagecontent;
              } ?>
              </textarea>

                </div>
            </div>
            </div>
			
			 </div> 
		</form>	  
        
</div>
</div>
 </div> </div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [

                ['style', ['style']],
                ['fontfamily', ['fontfamily']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['help', ['help']]
            ]
        });

    });
</script>

<script type="text/javascript">
    function addordcancel(obj,langid,proid) {
                    html =' <tr> <td class="text-left" style="width: 40%;"><center><input class="reason_text form-control" placeholder="" type="text" value=""/></center><span class="errormsg" style="font-size: 1em; color: #681818;"> </span></td>';
                    //html +='<td class="text-left" style="width: 40%;"><center><input class="reason_sort form-control" placeholder="<?php echo $entry_sort; ?>" type="text" value="<?php echo $reason['sort']; ?>"/></center></td>';
        html +='<td class="text-left" style="width: 40%;"><center><input class="reason_sort form-control" placeholder="<?php echo $entry_sort; ?>" type="text" value=""/></center></td>';
        html += '<td class="text-left"><button title="Save" class="addinsert btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
                    html += '</tr>';
                    $('.hideonclick').hide();
                    $('#reason tbody').append(html);
                    return false;
    }
    $(document).ready(function() { //READY STARTS HERE
        //-----------------------------------------------------//
        $(document).on('click','.addinsert',function () {

            $('.errormsg').hide();
            $reason_name = $(this).parent().parent().find('.reason_text').val();
            $reason_sort =$(this).parent().parent().find('.reason_sort').val();
            $action = "insert";
            //for accesing the this inside ajax request
            $ref_this = this;
            //reason name
            if($reason_name == '') {
                    var chars="resonname shoudnot be empty";
                $(this).parent().parent().find('.errormsg').html(chars);
                $(this).parent().parent().find('.errormsg').show();
                    }else{
                //for insert
                $.ajax({
                    url: "index.php?route=extension/module/order_cancel/order_cancel_action&token=<?php echo $token; ?>",
                    type: "POST",
                    dataType: "json",
                    data: {reason_name: $reason_name, sort: $reason_sort, action: $action},
                    success: function (data) {
                        if (data != "") {
                            //cancel-id="'+data.cancel_order_id+'"
                            console.log();
                            $cancel_id = data.cancel_order_id;
                            $html ='<td class="text-left"><button type="button" cancel-id="'+$cancel_id+'"  data-toggle="tooltip" title="remove" class="cancel_delete btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i></button></td>';
                            $($ref_this).parent().replaceWith($html);
                            $('.hideonclick').show();
                        }
                    },// eo success
                    error: function (data) {
                        console.log("Error"+data);
                    }
                });//ajax
            }
            return false;
        });//ADD onclick function end
        //DELETE
        $(document).on('click','.cancel_delete',function(){
            //Save the link in a variable called element
            $reason_id = $(this).attr('cancel-id');
            $action = "delete";
            $(this).parent().parent().remove();
                //for insert
                $.ajax({
                    url: "index.php?route=extension/module/order_cancel/order_cancel_action&token=<?php echo $token; ?>",
                    type: "POST",
                    dataType: "json",
                    data: {reason_id: $reason_id,action: $action},
                    success: function (data) {
                        if (data != "") {
                            $('.hideonclick').show();
                        }
                    },// eo success
                    error: function (data) {
                        console.log("Error"+data);
                    }
                });//ajax
            return false;
        });
    });//READY ENDS HERE
</script>
<?php echo $footer; ?>
