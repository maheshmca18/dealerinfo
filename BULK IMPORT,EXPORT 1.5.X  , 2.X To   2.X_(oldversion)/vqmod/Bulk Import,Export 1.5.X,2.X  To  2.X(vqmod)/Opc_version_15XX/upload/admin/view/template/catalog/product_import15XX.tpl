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
	
	$product_table_data .="<table class='list'><thead><tr><td class='left'>Product Name</td><td class='left'>Model</td><td class='left'>Price</td><td class='left'>Quantity</td><td class='left'>Manufacture Name</td><td class='left'>Status</td></tr></thead><tbody>";						
	
	$excel_fields_error = array();
	$product_names = array();
	
	$excel_field_validate = 1;
	
	foreach($sampletabledata as $productdata)
		{	
foreach($productdata['product_description'] as $langkey => $langval) {
if($productdata['status']==1){$status="Enable";}else{$status="Disable";}


								$product_table_data .="<tr><td class='left'>".$langval['name']."</td><td class='left'>".$productdata['model']."</td><td class='left'>".$productdata['price']."</td><td class='left'>".$productdata['quantity']."</td><td class='left'>".$productdata['manufacturer']."</td><td class='left'>".$status."</td></tr>";}
								
								
						
		}			
				
	$product_table_data .="</tbody></table>";
	?>
	 <div class="buttons"> 	
	 <?php if($excel_field_validate) { ?>
	 <a href="<?php echo $importdataurl; ?>" class="button" id="button-save1">Publish</a><?php } ?>
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

