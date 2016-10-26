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
	
	$category_table_data="";
	
	$category_table_data .="<table class='list'><thead><tr><td class='left'>Category</td><td class='left'>Description</td><td class='left'>Parent Category</td></tr></thead><tbody>";						
	
	$excel_fields_error = array();
	$category_names = array();
	
	$excel_field_validate = 1;
	
	foreach($sampletabledata as $categorydata)
		{				foreach($categorydata['category_description'] as $langkey => $langval) {

$category_table_data .="<tr><td class='text-left'>".$langval['name']."</td><td class='text-left'>".$langval['description']."</td><td class='text-left'>".$categorydata['parent']."</td></tr>";
							if($excel_field_validate)
							{
								if ($langval['name'] == '') { 
									$excel_fields_error['name']="Enter Category Name";
									$excel_field_validate=0;
									}
							}
							

						  if(in_array($langval['name'],$category_names) && in_array($categorydata['parent'],$category_names))
							    {
							    $excel_fields_error['category_name_exist']="Don't Repeat same Category and parent";
							    $excel_field_validate=0;
							    continue;
							    }
							    else
							    {
							    $category_names[] =	$langval['name'];
							    $category_names[] =	$categorydata['parent'];
							    }		
							}
						}
				
	$category_table_data .="</tbody></table>";
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
	 <?php echo $category_table_data; ?>	 
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
