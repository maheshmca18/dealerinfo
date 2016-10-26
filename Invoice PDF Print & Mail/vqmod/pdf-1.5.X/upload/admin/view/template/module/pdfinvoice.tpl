<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

                <table class="form">

                    <tr>
                        <td> <?php echo $entry_status; ?></td>
                        <td class="left"><select name="pdfinvoice_status">
                                <?php if ($pdfinvoice_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>
                    <tr>
                        <td> <?php echo $entry_logo; ?></td>
                        <td class="left"><select name="pdfinvoice_logo_status">
                                <?php if ($pdfinvoice_logo_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>
                    <tr>
                        <td> <?php echo $entry_attach_email; ?></td>
                        <td class="left"><select name="pdfinvoice_attach_email_status">
                                <?php if ($pdfinvoice_attach_email_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>

                    <tr>
                        <td><?php echo $entry_authorized.' Image'; ?></td>
                        <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                                <input type="hidden" name="pdfinvoice_image" value="<?php echo $pdfinvoice_image; ?>" id="image" />
                                <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo 'nothing'; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                    </tr>
                    <tr>
                        <td> <?php echo $entry_authorized; ?></td>
                        <td class="left"><select name="pdfinvoice_authorized_status">
                                <?php if ($pdfinvoice_authorized_status) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>
                    <tr>
                        <td> <?php echo $entry_automailstatus; ?></td>
                        <td class="left"><select name="pdfinvoice_automailstatus" id="orderstatus">
                                <?php if ($pdfinvoice_automailstatus) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select></td></tr>

                    <?php if ($pdfinvoice_automailstatus) {
                     $style=''; } else { $style='style="display: none;"';
                    } ?>
                    <tr id="orderstatusenable" <?php echo $style; ?> >
                    <td> <?php echo $entry_orderstatus; ?></td>
                    <td class="left"><select name="pdfinvoice_orderstatus" >

                            <option value="*"></option>
                            <?php foreach ($order_statuses as $order_status) { ?>
                            <?php if ($order_status['order_status_id'] == $pdfinvoice_orderstatus) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                            <?php } ?>
                            <?php } ?>

                        </select></td></tr>

                    <tr>
                        <td>  <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_messagecontent; ?></label></td>
                        <td>

                            <textarea name="pdfinvoice_messagecontent" id="summernote" cols="30" rows="10" >
                    <?php if($pdfinvoice_messagecontent)
              {
              echo $pdfinvoice_messagecontent;
              } ?>

              </textarea>
                            <span style="color:#00b3ee;"><?php //echo $entry_msgafterorder; ?> </span></td>
                    </tr>


                </table>

            </form>



            <?php if(empty($taxdetails)){ ?>
            <table border='1' class='list update-table table table-striped table-bordered table-hover'  width='100%'>
                <thead><tr class="left"><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>
                <tr  class='left record '><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>
                </tbody><tfoot><tr class='left record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><a onclick="addpdftax(this );" class="hideonclick button">ADD TAX</a></td></tr></tfoot>
            </table>
            <?php } else {
                    echo "<table border='1' class='update-table table table-striped table-bordered table-hover' width='100%'> ";
            echo  " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
            foreach($taxdetails as $row) {

            echo "<tr  class='left record'>";
                echo "<td class='td' title='taxid' style='display: none;'>" . $row['pdf_invoice_id'] . "</td>";
                echo "<td class='td' title='taxname'>" . $row['pdf_invoice_taxname'] . "</td>";
                echo "<td class='td' title='taxnumber' width='30%'>" . $row['pdf_invoice_taxnumber'] . "</td>";
                echo " <td class='button' title='button' width='20%'><div class='buttons'><a class='edit button'>EDIT</a><a class='delete button'>" .$button_remove."</a></div></td>";
                echo "</tr>";

            }
            echo "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";
            echo "</table>";
            }
            ?>

            <div id="update" class="update">

            </div>
        </div>
    </div>
</div> </div>
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


    function addpdftax(obj) {


        html = " <tr> <td class='left'><center><input type='text' id='pdftax_tax_name' class='pdftax_tax_name form-control' style='width:35em'><br><span class='errormsg' style='font-size: 1em; color: #681818;'></span></center></td>";
        html += "  <td class='left'><center><input type='text' id='pdftax_tax_id' class='pdftax_tax_id form-control' style='width:20em'><br><span class='errormsg' style='font-size: 1em; color: #681818;'></span></center></td>";
        html += "  <td class='left' ><a  class='addinsert button'><?php echo $button_save; ?></a>  </td>";
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

                    url: "index.php?route=module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
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
                                passingtoHTML += "<td class='td' title='taxnumber' width='30%'>" + row["pdf_invoice_taxnumber"] + "</td>";
                                passingtoHTML += " <td class='button' title='button' width='20%'><a class='edit button'>EDIT</a><a class='delete button'><?php echo $button_remove; ?></a></td>";
                                passingtoHTML += "</tr>";
                                //show in table

                            });//for each
                            passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";
                            $('.update-table').html(passingtoHTML);

                        }
                        else {
                            var passingtoHTML = "";
                            passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
                            passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                            passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
                            passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";

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
                url: "index.php?route=module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
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
                            passingtoHTML += " <td class='button' title='button' width='20%'><a class='edit button'>EDIT</a><a class='delete button'><?php echo $button_remove; ?></a></td>";
                            passingtoHTML += "</tr>";
                            //show in table

                        });//for each
                        passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";
                        $('.update-table').html(passingtoHTML);

                    }

                    else {
                        var passingtoHTML = "";
                        passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
                        passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                        passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
                        passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";

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
            var submit = "<a  class='table-update button'><?php echo $button_save; ?></a>";
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
                    url: "index.php?route=module/pdfinvoice/pdftax&token=<?php echo $token; ?>",
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
                                passingtoHTML += "<td class='td' title='taxnumber' width='30%'>" + row["pdf_invoice_taxnumber"] + "</td>";
                                passingtoHTML += " <td class='button' title='button' width='20%'><a class='edit button'>EDIT</a><a class='delete button'><?php echo $button_remove; ?></a></td>";
                                passingtoHTML += "</tr>";
                                //show in table

                            });//for each
                            passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";
                            $('.update-table').html(passingtoHTML);

                        }
                        else {
                            var passingtoHTML = "";
                            passingtoHTML += "<table border='1' class='update-table table table-striped table-bordered table-hover' > ";
                            passingtoHTML += " <thead><tr><th style='display: none;'>NO</th><th>Tax Name</th><th>Tax Number</th><th>ACTION</th></tr></thead><tbody>";
                            passingtoHTML += "<tr  class='record'><td colspan='3'> <center><span style='color:red'>No record</span></center>  </td> </tr>";
                            passingtoHTML += "</tbody><tfoot><tr class='record'><td colspan='2'><span class='errormsyadd' style='color: #550000'></span></td><td width='20%'><a onclick='addpdftax(this );' class='hideonclick button'>ADD TAX</a></td></tr></tfoot>";

                            $('.update-table').html(passingtoHTML);
                        }
                    }
                });//end ajax function
            }
        });//end onclick function

    });//READY ENDS HERE
</script>

<script type="text/javascript"><!--
    function image_upload(field, thumb) {
        $('#dialog').remove();

        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

        $('#dialog').dialog({
            title: '<?php echo $text_image_manager; ?>',
            close: function (event, ui) {
                if ($('#' + field).attr('value')) {
                    $.ajax({
                        url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
                        dataType: 'text',
                        success: function(text) {
                            $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
                        }
                    });
                }
            },
            bgiframe: false,
            width: 800,
            height: 400,
            resizable: false,
            modal: false
        });
    };
    //--></script>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

    CKEDITOR.replace('summernote', {
        filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
        filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
        filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
        filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
        filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
        filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
    });



</script>


<?php echo $footer; ?>
