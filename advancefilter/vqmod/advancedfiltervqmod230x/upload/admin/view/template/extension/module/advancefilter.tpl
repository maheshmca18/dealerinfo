<style type="text/css">
    ul
    {
        list-style-type: none;
        padding-left: 0px;
    }
    .panel-group {
        margin-bottom: 0px !important;
    }
    .panel {
        margin-bottom: -5px !important;
    }
    .appentdetails{
        height: 300px;
    }
    table{
        font-size: 13px;
    }
</style>
<?php  echo $header; ?><?php echo $column_left; ?>
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
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#global-setting" data-toggle="tab"><?php echo "Global Setting"; ?></a></li>
                    <li ><a href="#category-setting" data-toggle="tab"><?php echo "Category Setting"; ?></a></li>
                </ul>
                <div class="tab-content">
                    <!---global setting--->
                    <div class="tab-pane active" id="global-setting">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_theme; ?></label>
                            <div class="col-sm-10">
                                <input class="form-control color {hash:true}" value="<?php echo $colorpic; ?>" name="advance_colorpic">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_status" id="input-status" class="form-control">
                                    <?php if ($advance_status) { ?>
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
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_brandstatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_brand_status" id="input-status" class="form-control">
                                    <?php if ($advance_brand_status) { ?>
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
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_pricestatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_price_status" id="input-status" class="form-control">
                                    <?php if ($advance_price_status) { ?>
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
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_optionstatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_option_status" id="optionstatus" class="form-control">
                                    <?php if ($advance_option_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if ($advance_option_status) {
                     $style=''; } else { $style='style="display: none;"';   } ?>

                            <div class="col-sm-10" id="ad_option_status" <?php echo $style; ?> ><div style="padding-left: 157px;">
                                <b><p><br>Option Details</p></b><div style='height: 180px; overflow-y: auto;'>
                                    <?php foreach($optiondetails as $option){
                                   if(!empty($advance_filteroptionvalue)){
                                      $selectattrib1 = in_array($option['option_id'],$advance_filteroptionvalue) ?  'checked="checked"' : '' ;
                                    } else{
                                     $selectattrib1 = '';
                                    }
                                     ?>  <div style='width: 150px;'> <a class='list-group-item '  >
                                            <input type='checkbox' class='advancefilteroptionvalue' <?php echo $selectattrib1; ?> name='advance_filteroptionvalue[]'  value='<?php echo $option['option_id']; ?>' >&nbsp;&nbsp;<?php echo $option['name']; ?>
                                        </a></div><?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div>
                            </div></div>
                        <span style="margin-left: 170px;color: #0b559b">[NOTE :This section is for global configuration of Option]</span>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_attributestatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_attribute_status" id="attribstatus" class="form-control">
                                    <?php if ($advance_attribute_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if ($advance_attribute_status) {
                     $style1=''; } else { $style1='style="display: none;"';
                    } ?>
                            <div class="col-sm-10" id="ad_attribute_status" <?php echo $style1; ?> ><div style="padding-left: 157px;">
                                    <b><p><br>Attribute Details</p></b><div style='height: 180px; overflow-y: auto;'>
                                    <?php  foreach($attribute as $attributedetails){
                                     if(!empty($advance_filterattributevalue)){
                                     $selectattrib = in_array($attributedetails['attribute_group_id'],$advance_filterattributevalue) ?  'checked="checked"' : '' ;
                                     } else{
                                      $selectattrib ='';
                                     }
                                     ?>  <div style='width: 150px;'> <a class='list-group-item '  >
                                    <input type='checkbox' id="attr" class='advancefilteroptionvalue' name='advance_filterattributevalue[]' <?php echo $selectattrib; ?>  value='<?php echo $attributedetails['attribute_group_id']; ?>' >&nbsp;&nbsp;<?php echo $attributedetails['name']; ?>
                                     </a></div><?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div>
                                </div></div>
                    <span style="margin-left: 170px;color: #0b559b">[NOTE :This section is for global configuration of Attribute]</span>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_customerstatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_crating_status" id="input-status" class="form-control">
                                    <?php if ($advance_crating_status) { ?>
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
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_discountstatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_discount_status" id="input-status" class="form-control">
                                    <?php if ($advance_discount_status) { ?>
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
                            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_avilablitystatus; ?></label>
                            <div class="col-sm-10">
                                <select name="advance_availabile_status" id="input-status" class="form-control">
                                    <?php if ($advance_availabile_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!---global setting--->
                    <!---category setting--->
                    <div class="tab-pane " id="category-setting">
                       <?php  if($categorysetting){ ?>
                         <div class="row" style=" border: 2px solid #BFBFBF;">
                                <div class="advanceappendarea">
                                 <div class="bs-example">
                                     <div class="panel-group" id="accordion">
                                 <?php foreach($categorysetting as $settingdetails){ ?>
                                         <div class="panel panel-default">
                                             <div class="panel-heading">
                                                 <a  data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $settingdetails['af_id']; ?>">
                                                     <h4 class="panel-title">
                                                         <i class="indicator glyphicon glyphicon-plus"></i>&nbsp;<?php echo $settingdetails['af_category']; ?>
                                                     </h4></a>
                                             </div>
                                             <div id="collapseOne<?php echo $settingdetails['af_id']; ?>" class="panel-collapse collapse">
                                                 <div class="panel-body">
                                                         <table border='3' class='update-table<?php echo $settingdetails['af_id']; ?> table table-striped table-bordered table-hover' >
                                                     <thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>
                                                     <tr>
                                                         <td style='display: none;' ><?php echo $settingdetails['af_id']; ?></td>
                                                         <td ><ul ><li><?php echo $settingdetails['af_category']; ?></li></ul></td>
                                                         <td><ul ><?php foreach($settingdetails['af_option'] as $af_option){ ?> <li> <i class='fa fa-star'></i> <?php echo $af_option['name']; ?></li> <?php } ?>
                                                                        </ul>    </td>
                                                         <td><ul >
                                                             <?php foreach($settingdetails['af_attribute'] as $af_attribute){ ?> <li><i class='fa fa-star'></i> <?php echo $af_attribute['name']; ?> </li> <?php } ?>
                                                             </ul> </td>
                                                         <td id="filterchange<?php echo $settingdetails['af_id']; ?>" class='button' title='button' width='20%'><button title='Edit' adf_id='<?php echo $settingdetails['af_id']; ?>' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button>&nbsp;<button title='Remove' adf_id='<?php echo $settingdetails['af_id']; ?>' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>
                                                         </tr></table>
                                                 </div>
                                             </div>
                                         </div>
                                 <?php } ?>
                                         <div class="newcategoryadd" style="border-top: 3px solid #BFBFBF; ">
                                             <div class="col-sm-9" style="margin-top: 16px;"> <span style="float: right;margin-right: -160px;color: #0b559b">[NOTE : Click here to add advance filter new category]</span> </div><div class="col-sm-3 text-right" style="padding-bottom: 9px;margin-top: 13px;">
                                                 <button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <?php } else { ?>
                        <div class="row" style=" border: 2px solid #BFBFBF;">
                            <div class="advanceappendarea">
                            <div class="newcategoryadd" >
                            <div><span style="color: Red;  margin-left: 250px;">No Data Add Category Settings</span></div>
                            <div>
                                <div class="col-sm-9" style="margin-top: 16px;"> <span style="float: right;margin-right: -160px;color: #0b559b">[NOTE : Click here to add advance filter new category ]</span> </div><div class="col-sm-3 text-right" style="padding-bottom: 9px;margin-top: 13px;">
                                    <button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!---category setting--->
                </div>
            </form>
            </div>

        </div>
     </div>
</div>
<script type="text/javascript" src="view/jscolor/jscolor.js"></script>
<?php echo $footer; ?>
<script>
    function toggleChevron(e) {
        $(e.target)
                .prev('.panel-heading')
                .find('i.indicator')
                .toggleClass('glyphicon-minus glyphicon-plus');
        $('#accordion','.panel-heading').css('background-color', 'green');
    }
    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
</script>
<script type="text/javascript">
    function addcategorysetting() {
        html  = "<div class='appentdetails' style='margin-top: 15px;' >";
        html +=" <table border='3' class='table table-striped table-bordered table-hover' >";
        html +=" <thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
        html +=" <tr>";
        //category start here
        html += "  <td><p>category Details</p><select name='filtercategory' id='input_advance' class='form-control filtercategory'>";
        html += "  <option value=''><?php echo 'select category'; ?></option><?php  foreach($category as $category1){  ?>";
        html += "  <option value='<?php echo $category1['category_id']; ?>'><?php echo $category1['name']; ?></option>";
        html += "  <?php } ?></select><span class='errormsg' style='font-size: 1em; color: #681818;'></span></center></td>";
        //category end here
        //option start here
        html += "  <td><p>Option Details</p><div style='height: 250px; overflow-y: auto;'>";
        html += "  <?php  foreach($optiondetails as $option){  ?>  <div > <a class='list-group-item '  >";
        html += " <input type='checkbox' class='advancefilteroptionvalue' name='filteroptionvalue'  value='<?php echo $option['option_id']; ?>' >&nbsp;&nbsp;<?php echo $option['name']; ?>";
        html += " </a></div><?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div></td>";
        //option end here
        //attribute start here
        html += " <td> <p>Attribute Details</p><div style='height: 250px; overflow-y: auto;'>";
        html += "  <?php  foreach($attribute as $attributedetails){  ?>  <div > <a class='list-group-item '  >";
        html += " <input type='checkbox' class='advancefilteroptionvalue' name='filterattributevalue'  value='<?php echo $attributedetails['attribute_group_id']; ?>' >&nbsp;&nbsp;<?php echo $attributedetails['name']; ?>";
        html += " </a></div><?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div></td>";
        //attribute end here
        html += " <td> <button title='Save' style='margin-top: 100px;' class='addinsert btn btn-primary'><i class='fa fa-plus-circle'></i></button></td>";
        html += "</tr></table>";
        html += "</div>";
        $('.newcategoryadd').html(html);
        $('.hideonclick').hide();
        return false;
    }
    $(document).ready(function() { //READY STARTS HERE
        $(document).on('change','#optionstatus',function ()
        {
            $name= $('#optionstatus').val();
            if($name==1){
                $("#ad_option_status").removeAttr("style");
            }else{
                $("#ad_option_status").attr("style","display: none");
                $($("input[name='advance_filteroptionvalue[]']:checked")).removeAttr('checked');
            }
        });//end onclick function
        $(document).on('change','#attribstatus',function ()
        {
            $name= $('#attribstatus').val();
            if($name==1){
                $("#ad_attribute_status").removeAttr("style");
            }else{
                $("#ad_attribute_status").attr("style","display: none");
                $($("input[name='advance_filterattributevalue[]']:checked")).removeAttr('checked');
            }
        });//end onclick function
        //--------------------ADD onclick function Start---------------------------------//
                  $(document).on('click', '.addinsert', function () {
                $category = $(".filtercategory").val();
                var option = [];
                $.each($("input[name='filteroptionvalue']:checked"), function () {
                    option.push($(this).val());
                });
                $optiondetails = option.join(",");
                var attribute = [];
                $.each($("input[name='filterattributevalue']:checked"), function () {
                    attribute.push($(this).val());
                });
                $attri = attribute.join(",");
                if ($category == "") {
                    var chars = "Select the Category";
                    $(".errormsg").html(chars);
                } else if ($optiondetails == "" && $attri == "") {
                    $(".errormsg").hide();
                    var chars = "select the option or attribute";
                    $(".errormsgoption").html(chars);
                }
                else {
                    $.ajax({
                        url: "index.php?route=extension/module/advancefilter/autosearch&token=<?php echo $token; ?>",
                        type: "POST",
                        dataType: "json",
                        data: {category: $category},
                        success: function (json) {
                            if (json != "") {
                                var chars = "Select anyother Category";
                                $(".errormsg").html(chars);
                            } else{
                    $.ajax({
                        url: "index.php?route=extension/module/advancefilter/add&token=<?php echo $token; ?>",
                        type: "POST",
                        dataType: "json",
                        data: {category: $category, optiondetails: $optiondetails, attri: $attri},
                        success: function (data) {
                            if (data != "") {
                                var passingtoHTML = "";
                                passingtoHTML += "<div class='bs-example'><div class='panel-group' id='accordion'>";
                                $.each(data, function (id, row) {
                                    passingtoHTML += "<div class='panel panel-default'><div class='panel-heading'>";
                                    passingtoHTML += "<a  data-toggle='collapse' data-parent='#accordion' href='#collapseOne" + row['af_id'] + "'>";
                                    passingtoHTML += "<h4 class='panel-title'><i class='indicator glyphicon glyphicon-plus'></i>&nbsp;" + row['af_category'];
                                    passingtoHTML += "</h4></a></div><div id='collapseOne" + row['af_id'] + "' class='panel-collapse collapse'>";
                                    passingtoHTML += "<div class='panel-body'>";
                                    passingtoHTML += "<table border='3' class='update-table" + row['af_id'] + " table table-striped table-bordered table-hover' >";
                                    passingtoHTML += "<thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
                                    passingtoHTML += "<tr><td style='display: none;' >" + row['af_id'] + "</td>";
                                    passingtoHTML += "<td >" + row['af_category'] + "</td><td><ul>";
                                    $.each(row['af_option'], function (id1, af_option) {
                                        passingtoHTML += "<li> <i class='fa fa-star'></i>  " + af_option['name'] + "</li> ";
                                    });//for each
                                    passingtoHTML += "</ul>    </td>  <td><ul>";
                                    $.each(row['af_attribute'], function (id2, af_attribute) {
                                        passingtoHTML += " <li> <i class='fa fa-star'></i> " + af_attribute['name'] + "  </li>";
                                    });//for each
                                    passingtoHTML += "</ul> </td> <td id='filterchange" + row['af_id'] + "' class='button' title='button' width='20%'><button title='Edit' adf_id='" + row['af_id'] + "' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button>&nbsp;<button title='Remove' adf_id='" + row['af_id'] + "' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                                    passingtoHTML += " </tr></table></div> </div> </div>";
                                });//for each
                                passingtoHTML += "<div class='newcategoryadd' style='border-top: 3px solid #BFBFBF; '>";
                                passingtoHTML += "<div class='col-sm-9' > </div><div class='col-sm-3 text-right' style='margin-top: 13px;'>";
                                passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button>";
                                passingtoHTML += "</div> </div> </div>  </div>";
                                $('.advanceappendarea').html(passingtoHTML);
                            }
                            else {
                                var passingtoHTML = "";
                                passingtoHTML += "<div class='newcategoryadd' ><div><span style='color: Red;  margin-left: 250px;'>No Data Add Category Settings</span></div>"
                                passingtoHTML += "<div><div class='col-sm-9' style='margin-top: 16px;'> <span style='float: right;margin-right: -160px;color: #0b559b'>[NOTE : Click here to add advance filter new category ]</span> </div><div class='col-sm-3 text-right' style='padding-bottom: 9px;margin-top: 13px;'>";
                                passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></div></div> </div>";
                                $('.advanceappendarea').html(passingtoHTML);
                            }
                        }//success end
                    });//ajax end
                            }
                        }
                    });
                }
                return false;
            });//ADD onclick function end
        //DELETE
        $(document).on('click','.delete',function(){
            $id =  $(this).attr('adf_id');
            $.ajax({
                type: "POST",
                url: "index.php?route=extension/module/advancefilter/delete&token=<?php echo $token; ?>",
                data: {id: $id},
                dataType: "json",
                success: function (data) {
                    if (data != "") {
                        var passingtoHTML = "";

                        passingtoHTML += "<div class='bs-example'><div class='panel-group' id='accordion'>";
                        $.each(data, function (id, row) {

                            passingtoHTML += "<div class='panel panel-default'><div class='panel-heading'>";
                            passingtoHTML += "<a  data-toggle='collapse' data-parent='#accordion' href='#collapseOne"+row['af_id']+"'>";
                            passingtoHTML += "<h4 class='panel-title'><i class='indicator glyphicon glyphicon-plus'></i>&nbsp;" + row['af_category'];
                            passingtoHTML += "</h4></a></div><div id='collapseOne"+row['af_id']+"' class='panel-collapse collapse'>";
                            passingtoHTML += "<div class='panel-body'>";
                            passingtoHTML += "<table border='3' class='update-table"+row['af_id']+" table table-striped table-bordered table-hover' >";
                            passingtoHTML += "<thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
                            passingtoHTML += "<tr><td style='display: none;' >"+row['af_id']+"</td>";
                            passingtoHTML += "<td >"+row['af_category']+"</td><td><ul>";
                            $.each(row['af_option'], function (id1, af_option){
                                passingtoHTML += "<li> <i class='fa fa-star'></i>  " + af_option['name'] + "</li> ";
                            });//for each
                            passingtoHTML += "</ul>    </td>  <td><ul>";
                            $.each(row['af_attribute'] , function (id2, af_attribute) {

                                passingtoHTML += " <li> <i class='fa fa-star'></i>"+ af_attribute['name'] + "  </li>";
                            });//for each
                            passingtoHTML += "</ul> </td> <td id='filterchange"+row['af_id']+"' class='button' title='button' width='20%'><button title='Edit' adf_id='"+row['af_id']+"' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button>&nbsp;<button title='Remove' adf_id='"+row['af_id']+"' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                            passingtoHTML += " </tr></table></div> </div> </div>";
                        });//for each
                        passingtoHTML += "<div class='newcategoryadd' style='border-top: 3px solid #BFBFBF; '>";
                        passingtoHTML += "<div class='col-sm-9' > </div><div class='col-sm-3 text-right' style='margin-top: 13px;'>";
                        passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button>";
                        passingtoHTML += "</div> </div> </div>  </div>";
                        $('.advanceappendarea').html(passingtoHTML);
                    }
                    else {
                        var passingtoHTML = "";
                        passingtoHTML += "<div class='newcategoryadd' ><div><span style='color: Red;  margin-left: 250px;'>No Data Add Category Settings</span></div>"
                        passingtoHTML += "<div><div class='col-sm-9' style='margin-top: 16px;'> <span style='float: right;margin-right: -160px;color: #0b559b'>[NOTE : Click here to add advance filter new category ]</span> </div><div class='col-sm-3 text-right' style='padding-bottom: 9px;margin-top: 13px;'>";
                        passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></div></div> </div>";
                        $('.advanceappendarea').html(passingtoHTML);
                    }
                }//success end
            }); //ajax end
            return false;
        }); //DELETE onclick function end
        //EDIT
        $(document).on('click','.edit',function(){
           $id =  $(this).attr('adf_id');
            $.ajax({
                type: "POST",
                url: "index.php?route=extension/module/advancefilter/edit&token=<?php echo $token; ?>",
                data: {id: $id},
                dataType: "json",
                success: function (data) {
                    if (data != "") {
                        html  = "<div class='appentdetails' style='margin-top: 15px;' >";
                        html +=" <table border='3' class='update-table"+$id+" table table-striped table-bordered table-hover' >";
                        html +=" <thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
                        html +=" <tr>";
                          $.each(data, function (id, row) {
                              //category start here
                              html += "  <td><b>"+ row['af_category'] +"</b></td>";
                            //category end here
                                $editid=row['af_id'];
                            // option start here
                              html += " <td> <div style='height: 250px; overflow-y: auto;'>";
                              html += "  <?php  foreach($optiondetails as $option){  ?>";
                               if(jQuery.inArray("<?php echo $option['option_id']; ?>", row['af_option']) != -1) { $optioncheck='checked="checked"'; } else { $optioncheck=''; }
                                     html += "<div > <a class='list-group-item '  >";
                                     html += " <input type='checkbox' "+$optioncheck+"class='advancefilteroptionvalue' name='filteroptionvalue'  value='<?php echo $option['option_id']; ?>' >&nbsp;&nbsp;<?php echo $option['name']; ?>";
                                     html += " </a></div>";

                                   //  });//for each
                               html += "<?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div></div></td>";
                                  //option end here
                              //attribute start here
                                html += " <td> <div style='height: 250px; overflow-y: auto;'>";
                                html += "  <?php  foreach($attribute as $attributedetails){  ?>";
                              if(jQuery.inArray("<?php echo $attributedetails['attribute_group_id']; ?>", row['af_attribute']) != -1) { $attributecheck='checked="checked"'; } else { $attributecheck=''; }
                              html += " <div > <a class='list-group-item '  >";
                                html += " <input type='checkbox'"+$attributecheck+" class='advancefilteroptionvalue' name='filterattributevalue'  value='<?php echo $attributedetails['attribute_group_id']; ?>' >&nbsp;&nbsp;<?php echo $attributedetails['name']; ?>";
                                html += " </a></div>";
                              html += " <?php } ?><span class='errormsgoption' style='font-size: 1em; color: #681818;'></span></div></div></td>";
                                //attribute end here
                              html += " <td><div > <button title='Save' style='margin-left: 19px;margin-top: 75px;' edit_id='"+row['af_id']+"' class='addupdate btn btn-primary'><i class='fa fa-save'></i></button><button title='Remove' adf_id='" + row['af_id'] + "' class='editdelete btn btn-danger' style='margin-left: 10px; margin-top: 73px;'><i class='fa fa-reply'></i></button></div></td>";
                              html += "</div>";
                            //show in table
                        });//for each
                        html += "</tr></table></div>";
                    }
                  $changevariable='.update-table'+$editid;
                    $($changevariable).replaceWith(html);
                }//success end
            }); //ajax end
            return false;
        }); //EDIT onclick function end
        //edit cancel
        $(document).on('click','.editdelete',function(){
            $id =  $(this).attr('adf_id');
            $.ajax({
                type: "POST",
                url: "index.php?route=extension/module/advancefilter/editcancel&token=<?php echo $token; ?>",
                data: {id: $id},
                dataType: "json",
                success: function (data) {
                    if (data != "") {
                        var passingtoHTML = "";

                        $.each(data, function (id, row) {

                           passingtoHTML += "<table border='3' class='update-table"+row['af_id']+" table table-striped table-bordered table-hover' >";
                            passingtoHTML += "<thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
                            passingtoHTML += "<tr><td style='display: none;' >"+row['af_id']+"</td>";
                            passingtoHTML += "<td >"+row['af_category']+"</td><td><ul>";
                            $editid=row['af_id'];
                            $.each(row['af_option'], function (id1, af_option){
                                passingtoHTML += "<li> <i class='fa fa-star'></i>  " + af_option['name'] + "</li> ";
                            });//for each
                            passingtoHTML += "</ul>    </td>  <td><ul>";
                            $.each(row['af_attribute'] , function (id2, af_attribute) {

                                passingtoHTML += " <li> <i class='fa fa-star'></i>"+ af_attribute['name'] + "  </li>";
                            });//for each
                            passingtoHTML += "</ul> </td> <td id='filterchange"+row['af_id']+"' class='button' title='button' width='20%'><button title='Edit' adf_id='"+row['af_id']+"' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button>&nbsp;<button title='Remove' adf_id='"+row['af_id']+"' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                            passingtoHTML += " </tr></table></div> </div> </div>";
                        });//for each

                        $changevariable='.update-table'+$editid;
                       // $($changevariable).replaceWith(passingtoHTML);
                       $(".appentdetails").replaceWith(passingtoHTML);
                    }
                }//success end
            }); //ajax end

            return false;
        }); //EDIT cancel onclick function end

        //UPDATE
        $(document).on('click','.addupdate',function(){
            $id =  $(this).attr('edit_id');
            var option = [];
            $.each($("input[name='filteroptionvalue']:checked"), function(){
                option.push($(this).val());
            });
            $optiondetails=option.join(",");
            var attribute = [];
            $.each($("input[name='filterattributevalue']:checked"), function(){
                attribute.push($(this).val());
            });
            $attri=attribute.join(",");
             if($optiondetails=="" && $attri=="" ) {
                $(".errormsg").hide();
                var chars="select the option or attribute";
                $(".errormsgoption").html(chars);
            }
            else {
                $.ajax({
                    url: "index.php?route=extension/module/advancefilter/update&token=<?php echo $token; ?>",
                    type: "POST",
                    dataType: "json",
                    data: {category: $id, optiondetails: $optiondetails, attri: $attri},
                    success: function (data) {
                        if (data != "") {
                            var passingtoHTML = "";

                            passingtoHTML += "<div class='bs-example'><div class='panel-group' id='accordion'>";
                            $.each(data, function (id, row) {

                                passingtoHTML += "<div class='panel panel-default'><div class='panel-heading'>";
                                passingtoHTML += "<a  data-toggle='collapse' data-parent='#accordion' href='#collapseOne"+row['af_id']+"'>";
                                passingtoHTML += "<h4 class='panel-title'><i class='indicator glyphicon glyphicon-plus'></i>&nbsp;" + row['af_category'];
                                passingtoHTML += "</h4></a></div><div id='collapseOne"+row['af_id']+"' class='panel-collapse collapse'>";
                                passingtoHTML += "<div class='panel-body'>";
                                passingtoHTML += "<table border='3' class='update-table"+row['af_id']+" table table-striped table-bordered table-hover' >";
                                passingtoHTML += "<thead><tr><th style='display: none;' >ID</th><th >Category</th><th>Option</th><th>Attribute</th><th>ACTION</th></tr></thead>";
                                passingtoHTML += "<tr><td style='display: none;' >"+row['af_id']+"</td>";
                                passingtoHTML += "<td >"+row['af_category']+"</td><td><ul>";
                                $.each(row['af_option'], function (id1, af_option){
                                    passingtoHTML += "<li> <i class='fa fa-star'></i>  " + af_option['name'] + "</li> ";
                                });//for each
                                passingtoHTML += "</ul>    </td>  <td><ul>";
                                $.each(row['af_attribute'] , function (id2, af_attribute) {

                                    passingtoHTML += " <li> <i class='fa fa-star'></i> "+ af_attribute['name'] + "  </li>";
                                });//for each
                                passingtoHTML += "</ul> </td> <td id='filterchange"+row['af_id']+"' class='button' title='button' width='20%'><button title='Edit' adf_id='"+row['af_id']+"' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button>&nbsp;<button title='Remove' adf_id='"+row['af_id']+"' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                                passingtoHTML += " </tr></table></div> </div> </div>";
                            });//for each
                            passingtoHTML += "<div class='newcategoryadd' style='border-top: 3px solid #BFBFBF; '>";
                            passingtoHTML += "<div class='col-sm-9' > </div><div class='col-sm-3 text-right' style='margin-top: 13px;'>";
                            passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button>";
                            passingtoHTML += "</div> </div> </div>  </div>";

                            $('.advanceappendarea').html(passingtoHTML);
                        }
                        else {
                            var passingtoHTML = "";
                            passingtoHTML += "<div class='newcategoryadd' ><div><span style='color: Red;  margin-left: 250px;'>No Data Add Category Settings</span></div>"
                            passingtoHTML += "<div><div class='col-sm-9' style='margin-top: 16px;'> <span style='float: right;margin-right: -160px;color: #0b559b'>[NOTE : Click here to add advance filter new category ]</span> </div><div class='col-sm-3 text-right' style='padding-bottom: 9px;margin-top: 13px;'>";
                            passingtoHTML += "<button type='button' title='Add' onclick='addcategorysetting();' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></div></div> </div>";
                            $('.advanceappendarea').html(passingtoHTML);
                        }
                    }//success end
                });//ajax end
            }
            return false;
        }); //UPDATE onclick function end
    });//READY END HERE
</script>
