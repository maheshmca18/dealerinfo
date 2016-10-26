<?php echo $header; ?>
<style type="text/css">
input.button {
text-decoration: none;
color: #FFF;
display: inline-block;
padding: 5px 15px 5px 15px;
background: #003A88;
-webkit-border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-khtml-border-radius: 10px 10px 10px 10px;
border-radius: 10px 10px 10px 10px;
cursor:pointer;
}
</style>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/country.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a href="<?php echo $sampleexport; ?>" class="button">Sample CSV File</a></div>
    </div>
    <div class="content">
	
	<?php if(isset($sampletabledata)) { 
	
	$product_table_data="";
	
	$product_table_data .="<table class='list'><thead><tr><td class='center'>Image</td><td class='left'>Product</td><td class='left'>Model</td><td class='left'>Description</td><td class='left'>Category</td><td class='left'>Qunatity</td><td class='left'>Price</td></tr></thead><tbody>";						
	
	$excel_fields_error = array();
	$product_names = array();
	
	$excel_field_validate = 1;
	
	foreach($sampletabledata as $productdata)
		{		
						
foreach($productdata['product_description'] as $langkey => $langval) {

								$product_table_data .="<tr><td class='center'><img src='".$productdata['thumbimage']."' alt='".$langval['name']."' style='padding: 1px; border: 1px solid #DDDDDD;' >  </td><td class='left'>".$langval['name']."</td><td class='left'>".$productdata['model']."</td><td class='left'>".$langval['description']."</td><td class='left'>".$productdata['categorynames']."</td><td class='left'>".$productdata['quantity']."</td><td class='left'>".$productdata['price']."</td></tr>";
								
								if($excel_field_validate)
								{
									if ($langval['name'] == '') { 
										$excel_fields_error['name']="Enter Product Name";
										$excel_field_validate=0;
										}
										
if(in_array($langval['name'],$product_names) && in_array($productdata['product_category'],$product_names))
										{

												$excel_fields_error['product_name_exist']="Don't Repeat same Product and category name";
												$excel_field_validate=0;
												continue;									
										}
										else
										{
											$product_names[] =	$langval['name'];
                                            $product_names[] =	$productdata['product_category'];
										}
}
								
							if ($productdata['model'] == '') { 
								$excel_fields_error['model']="Enter Model Name";
								$excel_field_validate=0;
								}
								
							if ($productdata['categorynames'] == '') { 
								$excel_fields_error['categorynames']="Enter Product Category";
								$excel_field_validate=0;
								}
								
							if (in_array(0,$productdata['product_category'])) { 
								$excel_fields_error['product_category']="Enter Valid Product Category only";
								$excel_field_validate=0;
								}
								
							if ($productdata['quantity'] == '') { 
								$excel_fields_error['quantity']="Enter Product quantity";
								$excel_field_validate=0;
								}
								if ($productdata['price'] == '') { 
								echo "1".$productdata['price']."1";
								}
							if ($productdata['price'] == '') { 
								$excel_fields_error['price']="Enter Product Price";
								$excel_field_validate=0;
								}
								
								
							if ($productdata['stock_status_id'] == 0) { 
								$excel_fields_error['stock_status_id']="Enter Valid Stock Status";
								$excel_field_validate=0;
								}
								
							if ($productdata['manufacturer_id'] == 0) { 
								$excel_fields_error['manufacturer_id']="Enter Valid Manufacturer";
								$excel_field_validate=0;
								}
								
						}
						
		}		
				
	$product_table_data .="</tbody></table>";
	?>
	 <div class="buttons"> 	
	 <?php if($excel_field_validate) { ?>
	 <a href="<?php echo $importdataurl; ?>" class="button">Publish</a>	
	 <?php } ?>
	 <a href="<?php echo $action; ?>" class="button">Go Back</a>	 
	 </div>
	 
	 <?php if(!$excel_field_validate) { ?>	 
	 <div>
	 <h4>Warning :
	 <?php
	 if(count($excel_fields_error)>0)
	 {
		 foreach($excel_fields_error as $current_error)
		 {
			echo "<span class='error'>".$current_error."</span>";
		 }	 
	 }
	 ?>	 
	 </h4>	
	 <h5>Kindly goback then upload valid Excel file only</h5>
	 </div>
	 <?php }  ?>
	 <h4></h4>
	 <?php echo $product_table_data; ?>	 
	 <?php } else { ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	  <table class="form">
	  <tr>
	  <td><?php echo $entry_import; ?></td>
	  <td>
	  <input type='file' name='file' />
	   <?php if ($error_file) { ?>
       <span class="error"><?php echo $error_file; ?></span>
       <?php } ?>
	   <?php if ($error_fields) { ?>
       <span class="error"><?php echo $error_fields; ?></span>
       <?php } ?>
	  </td>
	  </tr>
	  <!--
	  <tr>
	  <td><?php echo $entry_insertonly; ?></td>
	  <td><input type='checkbox' name='insertonly' value="1" /></td>
	  </tr>
	  -->
	  <tr>
	  <td colspan="2">
      <input type='submit' name='submit' value='Submit' class="button" >
	  </td>
	  </tr>
	  </table>
      </form>
	 <?php } ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>
