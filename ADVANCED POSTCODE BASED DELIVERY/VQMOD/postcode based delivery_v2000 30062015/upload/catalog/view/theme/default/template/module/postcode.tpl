    <div class="postcode_search_div">
        <div class="box" >
                <!--<h1 class="postcode_search_header"><?php echo $heading_title; ?></h1>-->

            <h1 class="postcode_search_header"><span style="font-size:20px;" class="glyphicon glyphicon-map-marker"><?php echo $heading_title; ?></span></h1>

            <div class="postcode_input_div">
                <input type='text' name="postcode" id="postcodetest" placeholder="<?php echo 'Type Your Postcode'; ?>" class="form-control"/>
            </div>
            <div class="postcodesearch_input_div">
                <input type="button" value="search" id="postcodesearch" class="btn btn-primary"/>
                <b><span id="postcoderesult"></span></b>
            </div>
        </div>
    </div>

<script type="text/javascript"  language="javascript">
    $("#postcodesearch").click(function(){
        $("#postcoderesult").html('');
        $postcode=$("#postcodetest").val();

        if($postcode != '')
        {
            $.ajax({
                url: 'index.php?route=module/postcode/searchpostcode',
                type: "post",
                dataType:'json',
                data: {postcode:$postcode},
                success: function($data){
                    $("#postcoderesult").html($data);
                },
                error:function(){
                    //   $("#postcoderesult").html();
                }
            });
        }
        else
        {
            $("#postcoderesult").html('<div class="warning">Enter Your Postcode</div>');
            return false;
        }

    });
</script>
<style>
    h1.postcode_search_header{
        color : <?php echo $postcode_style['postcode_header_text_color']; ?> !important;
        font-size : <?php echo $postcode_style['postcode_header_font_size']; ?>px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        padding-left: 30px !important;
    }
    .postcode_search_div{
        background: <?php echo $postcode_style['postcode_theme_color']; ?> !important;
        padding-bottom: 10px !important;
        padding-right: 10px !important;
        margin-bottom: 30px;
        height : <?php echo $postcode_style['postcode_height']; ?>px !important;
    }
    .postcodesearch_input_div{
        text-align : center !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
    .postcode_input_div{
        padding-left: 30px !important;
        padding-right: 30px !important;
    }
    #postcoderesult .warning{
        color : <?php echo $postcode_style['postcode_error_text_color']; ?> !important;
        font-size: 15px !important;
    }
    #postcoderesult .success{
        color : <?php echo $postcode_style['postcode_success_text_color']; ?> !important;
        font-size: 15px !important;
    }
</style>