<?php echo $header; ?>
<style>

</style>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>

    <div class="box">
        <div class="heading">
            <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
           <!-- <div id="tabs" class="htabs">
                <a href="#tab-sunday"><?php echo "Sunday"; ?></a>
                <a href="#tab-monday"><?php echo "Monday"; ?></a>
                <a href="#tab-tuesday"><?php echo "Tuesday"; ?></a>
                <a href="#tab-wednesday"><?php echo "Wednesday"; ?></a>
                <a href="#tab-thursday"><?php echo "Thursday"; ?></a>
                <a href="#tab-friday"><?php echo "Friday"; ?></a>
                <a href="#tab-saturday"><?php echo "Saturday"; ?></a>
            </div>-->
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

               <!-- <div id="tab-sunday">-->
                    <table class="form">
                        <tr>
                            <td><?php echo "Sunday"; ?><br>
                                <span class="help">(Autocomplete)</span></td>
                            <td><input type="text" name="product_today1"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                            <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                            <input type="hidden" name="day_id1" value="<?php echo 1; ?>" placeholder="" />
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td><div id="product_id1" class="scrollbox">
                                    <?php foreach ($product_relateds1 as $product_related) { ?>
                                    <div id="product_id1<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                        <input type="hidden" name="product_id1[]" value="<?php echo $product_related['product_id']; ?>" />
                                    </div>  <?php } ?>

                            </td>

                        </tr>
                    </table>

                <!--  </div>-->


                <!-- <div id="tab-monday">-->
                     <table class="form">
                         <tr>
                             <td><?php echo "Monday"; ?><br>
                                 <span class="help">(Autocomplete)</span></td>
                             <td><input type="text" name="product_today2"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                             <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                             <input type="hidden" name="day_id2" value="<?php echo 2; ?>" placeholder=""  />
                         </tr>
                         <tr>
                             <td>&nbsp;</td>
                         <td><div id="product_id2" class="scrollbox">
                                     <?php foreach ($product_relateds2 as $product_related) { ?>
                                     <div id="product_id2<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                         <input type="hidden" name="product_id2[]" value="<?php echo $product_related['product_id']; ?>" />
                                     </div> <?php } ?>
                                     </td>

                         </tr>
                     </table>
                <!--</div>-->


                <!-- <div  id="tab-tuesday">-->
                     <table class="form">
                         <tr>
                             <td><?php echo "Tuesday"; ?><br>
                                 <span class="help">(Autocomplete)</span></td>
                             <td><input type="text" name="product_today3"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                             <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                             <input type="hidden" name="day_id3" value="<?php echo 3; ?>" placeholder="" />
                        </tr>

                         <tr>
                             <td>&nbsp;</td>
                             <td><div id="product_id3" class="scrollbox">
                                 <?php foreach ($product_relateds3 as $product_related) { ?>
                                     <div id="product_id3<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                     <input type="hidden" name="product_id3[]" value="<?php echo $product_related['product_id']; ?>" />
                                     </div> <?php } ?>
                             </td>

                         </tr>
                     </table>

                <!-- </div>-->


                <!-- <div id="tab-wednesday">-->
                     <table class="form">
                         <tr>
                                 <td><?php echo "Wednesday"; ?><br>
                                     <span class="help">(Autocomplete)</span></td>
                                 <td><input type="text" name="product_today4"  placeholder="<?php echo 'Product of The Day';?>"  /></td>
                                 <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                 <input type="hidden" name="day_id4" value="<?php echo 4; ?>" placeholder=""   />
                         </tr>

                         <tr>
                             <td>&nbsp;</td>
                             <td><div id="product_id4" class="scrollbox" >
                                 <?php foreach ($product_relateds4 as $product_related) { ?>
                                     <div id="product_id4<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                     <input type="hidden" name="product_id4[]" value="<?php echo $product_related['product_id']; ?>" />
                                     </div> <?php } ?>
                             </td>

                         </tr>
                     </table>

                <!--</div>-->


                <!-- <div id="tab-thursday">-->
                     <table class="form">
                         <tr>
                              <td><?php echo "Thursday"; ?><br>
                                  <span class="help">(Autocomplete)</span></td>
                              <td><input type="text" name="product_today5"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                                 <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                                 <input type="hidden" name="day_id5" value="<?php echo 5; ?>" placeholder=""   />
                         </tr>

                     <tr>
                         <td>&nbsp;</td>
                         <td><div id="product_id5" class="scrollbox">
                                 <?php foreach ($product_relateds5 as $product_related) { ?>
                                     <div id="product_id5<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                     <input type="hidden" name="product_id5[]" value="<?php echo $product_related['product_id']; ?>" />
                                     </div> <?php } ?>
                                 </td>

                                 </tr>
                                 </table>
                <!--</div>-->


                <!--<div id="tab-friday">-->
                    <table class="form">
                        <tr>
                        <td><?php echo "Friday"; ?><br>
                            <span class="help">(Autocomplete)</span></td>
                        <td><input type="text" name="product_today6"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                        <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                        <input type="hidden" name="day_id6" value="<?php echo 6; ?>" placeholder=""  />
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><div id="product_id6" class="scrollbox" >
                                <?php foreach ($product_relateds6 as $product_related) { ?>
                                    <div id="product_id6<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                    <input type="hidden" name="product_id6[]" value="<?php echo $product_related['product_id']; ?>" />
                                    </div> <?php } ?>
                            </td>

                        </tr>
                    </table>

                <!-- </div>-->


                <!--<div id="tab-saturday">-->
                    <table class="form">
                        <tr>
                   <td><?php echo "Saturday"; ?><br>
                       <span class="help">(Autocomplete)</span></td>
                        <td> <input type="text" name="product_today7"  placeholder="<?php echo 'Product of The Day';?>" /></td>
                        <input type="hidden" name="" value="" placeholder="" id="token_get" class="" />
                        <input type="hidden" name="day_id7" value="<?php echo 7; ?>" placeholder="" />

                        </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><div id="product_id7" class="scrollbox" >
                                <?php foreach ($product_relateds7 as $product_related) { ?>
                                    <div id="product_id7<?php echo $product_related['product_id']; ?>" > <?php echo $product_related['name']; ?>    <img src="view/image/delete.png"  >
                                    <input type="hidden" name="product_id7[]" value="<?php echo $product_related['product_id']; ?>" />
                                    </div> <?php } ?>
                                </td>

                                </tr>
                                </table>
                    </div>
        <!--</div>-->


   </form>
   </div>
   </div>



   <script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today1\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id1' + ui.item.value).remove();

               $('#product_id1').prepend('<div id="product_id1' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id1[]" value="' + ui.item.value + '" /></div>');

               $('#product_id1 div:odd').attr('class', 'odd');
               $('#product_id1 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id1 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id1 div:odd').attr('class', 'odd');
           $('#product_id1 div:even').attr('class', 'even');
       });
   </script>


   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today2\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id2' + ui.item.value).remove();

               $('#product_id2').prepend('<div id="product_id2' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id2[]" value="' + ui.item.value + '" /></div>');

               $('#product_id2 div:odd').attr('class', 'odd');
               $('#product_id2 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id2 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id2 div:odd').attr('class', 'odd');
           $('#product_id2 div:even').attr('class', 'even');
       });
   </script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today3\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id3' + ui.item.value).remove();

               $('#product_id3').prepend('<div id="product_id3' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id3[]" value="' + ui.item.value + '" /></div>');

               $('#product_id3 div:odd').attr('class', 'odd');
               $('#product_id3 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id3 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id3 div:odd').attr('class', 'odd');
           $('#product_id3 div:even').attr('class', 'even');
       });
   </script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today4\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id4' + ui.item.value).remove();

               $('#product_id4').prepend('<div id="product_id4' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id4[]" value="' + ui.item.value + '" /></div>');

               $('#product_id4 div:odd').attr('class', 'odd');
               $('#product_id4 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id4 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id4 div:odd').attr('class', 'odd');
           $('#product_id4 div:even').attr('class', 'even');
       });
   </script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today5\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id5' + ui.item.value).remove();

               $('#product_id5').prepend('<div id="product_id2' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id5[]" value="' + ui.item.value + '" /></div>');

               $('#product_id5 div:odd').attr('class', 'odd');
               $('#product_id5 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id5 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id5 div:odd').attr('class', 'odd');
           $('#product_id5 div:even').attr('class', 'even');
       });
   </script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today6\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id6' + ui.item.value).remove();

               $('#product_id6').prepend('<div id="product_id2' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id6[]" value="' + ui.item.value + '" /></div>');

               $('#product_id6 div:odd').attr('class', 'odd');
               $('#product_id6 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id6 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id6 div:odd').attr('class', 'odd');
           $('#product_id6 div:even').attr('class', 'even');
       });
   </script>
   <script>
       var token=$('#token_get').val();
       $('input[name=\'product_today7\']').autocomplete({
           delay: 500,
           source: function(request, response, token) {
               $.ajax({
                   url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                   dataType: 'json',
                   success: function(json) {
                       response($.map(json, function(item) {
                           return {
                               label: item.name,
                               value: item.product_id
                           }
                       }));
                   }
               });
           },
           select: function(event, ui) {
               $('#product_id7' + ui.item.value).remove();

               $('#product_id7').prepend('<div id="product_id2' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_id7[]" value="' + ui.item.value + '" /></div>');

               $('#product_id7 div:odd').attr('class', 'odd');
               $('#product_id7 div:even').attr('class', 'even');

               return false;
           },
           focus: function(event, ui) {
               return false;
           }
       });

       $('#product_id7 div img').live('click', function() {
           $(this).parent().remove();

           $('#product_id7 div:odd').attr('class', 'odd');
           $('#product_id7 div:even').attr('class', 'even');
       });
   </script>

   <?php echo $footer; ?>
