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
<div class="container-fluid">
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

  <div class="panel panel-default">

<div class="panel-body">

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                    <select name="pdfinvoice_status" id="input-status" class="form-control">
                        <?php if ($pdfinvoice_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_logo; ?></label>
                <div class="col-sm-10">
                    <select name="pdfinvoice_logo_status" id="input-status" class="form-control">
                        <?php if ($pdfinvoice_logo_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_attach_email; ?></label>
                <div class="col-sm-10">
                    <select name="pdfinvoice_attach_email_status" id="input-status" class="form-control">
                        <?php if ($pdfinvoice_attach_email_status) { ?>
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
                <label class="col-sm-2 control-label"><?php echo $entry_authorized.' Image'; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                    <input type="hidden" name="pdfinvoice_image" value="<?php echo $pdfinvoice_image; ?>" id="input-image" />
                </div>
            </div>
                 <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_authorized; ?></label>
                <div class="col-sm-10">
                    <select name="pdfinvoice_authorized_status" id="input-status" class="form-control">
                        <?php if ($pdfinvoice_authorized_status) { ?>
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
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_automailstatus; ?></label>
                <div class="col-sm-10">
                <select name="pdfinvoice_automailstatus" id="orderstatus">
                        <?php if ($pdfinvoice_automailstatus) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <?php if ($pdfinvoice_automailstatus) {
                     $style=''; } else { $style='style="display: none;"';
                    } ?>

                    <div class="form-group" id="orderstatusenable" <?php echo $style; ?>>
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_orderstatus; ?></label>
                        <div class="col-sm-10">

                        <select name="pdfinvoice_orderstatus" >

                    <option value="*"></option>
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $pdfinvoice_orderstatus) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>

                </select></div>
                    </div>

      <div class="form-group">
          <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_messagecontent; ?></label>
          <div class="col-sm-10">
              <textarea name="pdfinvoice_messagecontent" class="summernote" cols="30" rows="10" ><?php if($pdfinvoice_messagecontent)
              {
              echo $pdfinvoice_messagecontent;
              } ?>
              </textarea>

          </div>
      </div>


            <div class="tab-pane" >
                <ul class="nav nav-tabs" >

                    <?php if(empty($taxdetails)){ ?>
                    <table border='1' class='update-table table table-striped table-bordered table-hover' >
                        <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>
                        <tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>
                        </tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>
                    </table>
                    <?php } else {
                    echo "<table border='1' class='update-table table table-striped table-bordered table-hover'> ";
                    echo  " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                    foreach($taxdetails as $row) {

                    echo "<tr  class='record'>";
                        echo "<td class='td' title='taxid' style='display: none;'>" . $row['pdf_invoice_id'] . "</td>";
                        echo "<td class='td' title='taxname'>" . $row['pdf_invoice_taxname'] . "</td>";
                        echo "<td class='td' title='taxnumber' width='20%'>" . $row['pdf_invoice_taxnumber'] . "</td>";
                        echo" <td class='button' title='button' width='20%'><button title='Edit' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button><button title='Remove' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                        echo "</tr>";

                    }
                    echo "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";
                    echo "</table>";
                    }
                    ?>
                </ul>
                <div id="update" class="update">

                </div>
            </div>

        </form>
</div>

 
</div>
 </div> </div>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />

<script type="text/javascript">

    $(document).ready(function() { //READY STARTS HERE
//-----------------------------------------------------//
        $(document).on('change','#orderstatus',function ()
        {

            $name= $('#orderstatus').val();

            if($name==1){
                $("#orderstatusenable").removeAttr("style");
            }else{
                $("#orderstatusenable").attr("style","display: none");
            }

        });//end onclick function

    });//READY ENDS HERE
</script>
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


function addpdftax(obj) {

    html = " <tr> <td class='text-left'><center><input type='text' id='pdftax_tax_name' class='pdftax_tax_name form-control' style='width:35em'><span class='errormsg' style='font-size: 1em; color: #681818;'></span></center></td>";
    html += "  <td class='text-left'><center><input type='text' id='pdftax_tax_id' class='pdftax_tax_id form-control' style='width:10em'><span class='errormsg' style='font-size: 1em; color: #681818;'></span></center></td>";
    html += "  <td class='text-left' > <button title='Save' class='addinsert btn btn-primary'><i class='fa fa-plus-circle'></i></button></td>";
    html += "</tr>";
$('.update-table tbody').append(html);

$('.hideonclick').hide();
    $('.hideerrormsg').hide();

return false;
}
$(document).ready(function() { //READY STARTS HERE
//-----------------------------------------------------//
$(document).on('click','.addinsert',function ()
{

$name= $('.pdftax_tax_name').val();
$number= $('.pdftax_tax_id').val();
$action='insert';
if($name=="" && $number=="") {
var chars="Enter the missing details";
$(".errormsg").html(chars);
}
else{
$.ajax({

url: "index.php?route=extension/module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
type: "POST",
dataType: "json",
async:true,
data: {tax_name: $name, tax_number: $number, action: $action},
success: function (data) {
$('.pdftax_tax_id').val("");
$('.pdftax_tax_name').val("");
if (data != "") {
var passingtoHTML = "";
passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
    passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
    $.each(data, function (id, row) {

    passingtoHTML += "<tr  class='record'>";
        passingtoHTML += "<td class='td' title='taxid' style='display: none;'>" + row["pdf_invoice_id"] + "</td>";
        passingtoHTML += "<td class='td' title='taxname'>" + row['pdf_invoice_taxname'] + "</td>";
        passingtoHTML += "<td class='td' title='taxnumber' width='20%'>" + row["pdf_invoice_taxnumber"] + "</td>";
        passingtoHTML += " <td class='button' title='button' width='20%'><button title='Edit' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button><button title='Remove' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
        passingtoHTML += "</tr>";
    //show in table

    });//for each
    passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";
    $('.update-table').html(passingtoHTML);

    }
    else {
    var passingtoHTML = "";
    passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
        passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
        passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
        passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";

        $('.update-table').html(passingtoHTML);
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
        $(document).on('click','.delete',function(){
        //Save the link in a variable called element
        $info = $(this).parent('td').parent('tr').children('td').eq(0).html();

        $action='delete';
        $.ajax({
        type: "POST",
        url: "index.php?route=extension/module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
        data: {info: $info ,  action: $action },
        dataType: "json",
        success: function(data){
        if (data != "") {
        var passingtoHTML = "";
        //parse data using foreach
        passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' width='100%'  > ";
            passingtoHTML += "<thead> <tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
            $.each(data, function (id, row) {

                passingtoHTML += "<tr  class='record'>";
                passingtoHTML += "<td class='td' title='taxid' style='display: none;'>" + row["pdf_invoice_id"] + "</td>";
                passingtoHTML += "<td class='td' title='taxname'>" + row['pdf_invoice_taxname'] + "</td>";
                passingtoHTML += "<td class='td' title='taxnumber' width='20%'>" + row["pdf_invoice_taxnumber"] + "</td>";
                passingtoHTML += " <td class='button' title='button' width='20%'><button title='Edit' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button><button title='Remove' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                passingtoHTML += "</tr>";
                //show in table

            });//for each
            passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";
            $('.update-table').html(passingtoHTML);

        }

            else {
            var passingtoHTML = "";
            passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
                passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
                passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";

                $('.update-table').html(passingtoHTML);
                }
                }
                });//ajax end

                return false;
                });


                //-----------------------------------------------------//
                //EDIT
                $(document).on('click','.edit',function(){
                var tr = $(this).closest("tr");
                tr.find(".td").each(function(){
                var name = $(this).attr("title");
                var value = $(this).html();
                var input = "<input type='text' name='"+name+"' value='"+value+"' id='"+name+"' class='form-control'/><span class='"+name+"' style='font-size: 1em; color: #681818;'></span>";
                $(this).html(input);
                });//end of each function
                var submit = "<button type='button' class='table-update btn btn-primary' name='ss' title='Update'><i class='fa fa-pencil-square'></i></button>";
                tr.find(".button").html(submit);
                });//end of onclick function

                $(document).on('click','.table-update',function(){
                var id=$('#taxid').val();


                ////var row = $(this).parent('td').parent('tr').children('td').children('input').val();
                var taxname = $(this).parent('td').parent('tr').children('td').eq(1).children('input').val();
                var taxnumber = $(this).parent('td').parent('tr').children('td').eq(2).children('input').val();
                var action='update';
                $taxname=taxname;
                $taxnumber=taxnumber;

                // alert(features)
                if($taxnumber=="" && $taxname=="")
                {
                    var chars="Enter the tax number && tax name";
                    $(".taxnumber").html(chars);
                    $(".taxname").html(chars);
                }


                else {


                $.ajax({
                type: "POST",
                url: "index.php?route=extension/module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
                data:{tax_id:id,tax_name:taxname,tax_number:taxnumber,action: action},
                dataType: "json",
                success: function (data) {

                if (data != "") {
                var passingtoHTML = "";

                //parse data using foreach
                passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' width='100%'  > ";
                    passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                    $.each(data, function (id, row) {

                        passingtoHTML += "<tr  class='record'>";
                        passingtoHTML += "<td class='td' title='taxid' style='display: none;'>" + row["pdf_invoice_id"] + "</td>";
                        passingtoHTML += "<td class='td' title='taxname'>" + row['pdf_invoice_taxname'] + "</td>";
                        passingtoHTML += "<td class='td' title='taxnumber' width='20%'>" + row["pdf_invoice_taxnumber"] + "</td>";
                        passingtoHTML += " <td class='button' title='button' width='20%'><button title='Edit' class='edit btn btn-primary' ><i class='fa fa-pencil'></i></button><button title='Remove' class='delete btn btn-danger' ><i class='fa fa-minus-circle'></i></button></td>";
                        passingtoHTML += "</tr>";
                        //show in table

                    });//for each
                    passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";
                    $('.update-table').html(passingtoHTML);

                }
                    else {
                    var passingtoHTML = "";
                    passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
                        passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                        passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
                        passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><button type='button' title='Add' onclick='addpdftax(this );' class='hideonclick  btn btn-primary'><i class='fa fa-plus-circle'></i></button></td></tr></tfoot>";

                        $('.update-table').html(passingtoHTML);
                        }
                        }
                        });//end ajax function
                        }
                        });//end onclick function

                        });//READY ENDS HERE
                        </script>
<?php echo $footer; ?>
