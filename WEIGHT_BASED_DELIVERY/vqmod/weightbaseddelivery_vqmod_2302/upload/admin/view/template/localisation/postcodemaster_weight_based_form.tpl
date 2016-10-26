<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo "Add Postcode Master"; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-language" class="form-horizontal">

<!--0000000000000000000000000000000-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-code"><?php echo $text_postcode; ?></label>
            <div class="col-sm-10">
              <input type="text" name="postcode" value="<?php echo $postcode; ?>" placeholder="<?php echo $text_postcode; ?>" id="input-code" class="form-control" />
                <?php if ($error_postcode) { ?>
                <div class="text-danger"><?php echo $error_postcode; ?></div>
                <?php } ?>
            </div>
          </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $text_conditiontype; ?></label>
                <div class="col-sm-10">
                    <select name="condition_type" id="input-status" class="form-control">
                        <option value="1" <?php echo ($condition_type=='1'? 'selected=selected':'');?> ><?php echo $text_conditiontype_min; ?></option>
                        <option value="2" <?php echo ($condition_type=='2'? 'selected=selected':'');?> ><?php echo $text_conditiontype_max; ?></option>
                        <option value="3" <?php echo ($condition_type=='3'? 'selected=selected':'');?> ><?php echo $text_conditiontype_between; ?></option>

                    </select>
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-code"><?php echo $text_conditiontype_weight; ?></label>
                <div class="col-sm-10">
                    <div>
                    <input type="text" name="min_weight" id="betweenminvalue" value="<?php echo $min_weight; ?>" placeholder="<?php echo $text_conditiontype_min; ?>"  />
                    <?php if ($error_condition_typemin) { ?>
                    <div class="text-danger"><?php echo $error_condition_typemin; ?></div>
                    <?php } ?>
                </div>
                    <div>
                    <input type="text" name="max_weight" id="betweenmaxvalue" value="<?php echo $max_weight; ?>" placeholder="<?php echo $text_conditiontype_max; ?>"   />
                    <?php if ($error_condition_typemax) { ?>
                    <div class="text-danger"><?php echo $error_condition_typemax; ?></div>
                    <?php } ?>
                </div>
                </div>

            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-code"><?php echo $text_shipping_charge; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="shipping_charge" value="<?php echo $shipping_charge; ?>" placeholder="<?php echo $text_shipping_charge; ?>" id="input-code" class="form-control" />
                    <?php if ($error_shipping_charge) { ?>
                    <div class="text-danger"><?php echo $error_shipping_charge; ?></div>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                    <select name="status" id="input-status" class="form-control">
                        <?php if ($status) { ?>
                        <option value="1" selected="selected"><?php echo $text_status_enabled; ?></option>
                        <option value="0" ><?php echo $text_status_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_status_enabled; ?></option>
                        <option value="0"selected="selected"><?php echo $text_status_disabled; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!--0000000000000000000000000000000-->
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){

        var type =  $("#input-status").val();

            if (type == 1)
          { // min max

              $("#betweenmaxvalue" ).css({ "display" : "none" });

          }

            else if (type == 3)
            { // min max

                $( '#betweenminvalue' ).css({ "display" : "inline" });
                $( '#betweenmaxvalue' ).css({ "display" : "inline" });

            }
            else if (type == 2)
            { // min max

                $("#betweenminvalue" ).css({ "display" : "none" });            

            }

        $("#input-status").on("change",function() {
            $("#betweenminvalue").hide().val("");
            $("#betweenmaxvalue").hide().val("");
            // 1is min 2=> is max 3 is beteen
            //console.log($(this).val());
            if ($(this).val() == 2){ // above
                //$('#betweenminvalue').show();
                $('#betweenmaxvalue').show();
            }
            if ($(this).val() == 3){ //between only
                $('#betweenminvalue').show();
                $('#betweenmaxvalue').show();
            }
            if ($(this).val() == 1){ // min only
                $('#betweenminvalue').show();
            }
        });
    });
</script>
<?php echo $footer; ?>
