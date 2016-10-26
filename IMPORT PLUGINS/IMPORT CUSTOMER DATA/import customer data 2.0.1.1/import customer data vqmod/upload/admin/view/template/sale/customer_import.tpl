<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  
  <div class="page-header">
    <div class="container-fluid">
	<?php if(!isset($sampletabledata)){ ?>
      <div class="pull-right"><a href="<?php echo $sampleexport; ?>" data-toggle="tooltip" title="<?php echo $sample_import; ?>" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a> <button class="btn btn-primary" title="" data-toggle="tooltip" form="form" type="submit" name="submit" data-original-title="Save"><i class="fa fa-save"></i></button>
      </div>
	  <?php } ?>
	  
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
	
	
    <div class="container-fluid">
	
	<?php if(isset($sampletabledata)) { 
	
	$customer_table_data="";
	
	$customer_table_data .="<div class='table-responsive'><table class='table table-bordered table-hover'><thead><tr><td class='text-left'>First Name</td><td class='text-left'>Last Name</td><td class='text-left'>Customer Group</td><td class='text-left'>Email</td><td>Telephone</td></tr></thead><tbody>";						

	$customer_emails = array();
	
	$excel_fields_error = array();
	
	$excel_field_validate = 1;
	
	foreach($sampletabledata as $customerdata)
		{		
						$customer_table_data .="<tr><td class='text-left'>".$customerdata['firstname']."</td><td class='text-left'>".$customerdata['lastname']."</td><td class='text-left'>".$customerdata['customer_group']."</td><td class='text-left'>".$customerdata['email']."</td><td>".$customerdata['telephone']."</td></tr>";
						
						if($excel_field_validate)
						{
						
							if ($customerdata['firstname'] == '') { 
								$excel_fields_error['firstname']="Enter Customer First Name";
								$excel_field_validate=0;
								}
								
							if ($customerdata['lastname'] == '') { 
								$excel_fields_error['lastname']="Enter Customer Last Name";
								$excel_field_validate=0;
								}
								
							if(utf8_strlen($customerdata['email']) == 0)
								{
								$email_format_error = 1;
								$excel_fields_error['email']="Enter Email address";
								$excel_field_validate=0;							
								}
							elseif ((utf8_strlen($customerdata['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $customerdata['email'])) 
								{
								$email_format_error = 1;
								$excel_fields_error['email']="Enter Valid Email address only";
								$excel_field_validate=0;
								}							
							elseif(in_array($customerdata['email'],$customer_emails))
								{
										$excel_fields_error['email']="Dont Repeat same Email address";
										$excel_field_validate=0;
										continue;									
								}
								else
								{
									$customer_emails[] =	$customerdata['email'];							
								}
								
							if ($customerdata['password'] == '') { 
								$password_error=1;
								$excel_fields_error['password']="Enter Customer Password";
								$excel_field_validate=0;
								}
								
							if ($customerdata['telephone'] == '') { 
								$telephone_no_error=1;
								$excel_fields_error['telephone']="Enter Telephone No";
								$excel_field_validate=0;
								}								
							elseif (!preg_match('/^[\+0-9\-\ ]*$/', $customerdata['telephone'])) {
								$telephone_no_error=1;
								$excel_fields_error['telephone']="Enter valid Telephone No only";
								$excel_field_validate=0;
								}
								
							if ($customerdata['customer_group_id'] == 0) { 
								$excel_fields_error['customer_group']="Enter Valid Customer Group only";
								$excel_field_validate=0;
								}
								
							if ($customerdata['address'][0]['city'] == '') { 
								$excel_fields_error['city']="Enter Customer City";
								$excel_field_validate=0;
								}
								
							if ($customerdata['address'][0]['postcode'] == '') { 
								$excel_fields_error['postcode']="Enter Customer Postcode";
								$excel_field_validate=0;
								}
								
							if ($customerdata['address'][0]['country_id'] == 0) { 
								$excel_fields_error['country']="Enter valid Country name";
								$excel_field_validate=0;
								}
								
							if ($customerdata['address'][0]['zone_id'] == 0) { 
								$excel_fields_error['zone']="Enter valid Zone";
								$excel_field_validate=0;
								}
								
						}
						
		}		
				
	$customer_table_data .="</tbody></table></div>";
	?>
	



	<div class="buttons"> 	
	 <?php if($excel_field_validate) { ?>
	 <a href="<?php echo $importdataurl; ?>" class="button">Publish</a>&nbsp; 
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
	 <?php echo $customer_table_data; ?>	 
	 <?php } else { ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	  <div class="table-responsive">
	  <table class="table table-bordered table-hover">
	  <tr>
	  <td class="text-left"><?php echo $entry_import; ?></td>
	  <td class="text-left">
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
	  <td class="text-left"><?php echo $entry_insertonly; ?></td>
	  <td class="text-left"><input type='checkbox' name='insertonly' value="1" /></td>
	  </tr>
	  -->
	  <?php
	  /*
	  <tr>
	  <td colspan="2" class="text-left">
      <input type='submit' name='submit' value='Submit' class="button" >
	  </td>
	  </tr>
	  */
	  ?>
	  </table>
	  </div>
      </form>
	 <?php } ?>
    </div>
	
  </div>
  <?php echo $footer; ?>
</div>

<style type="text/css">
.button {
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
.error
{
color:red;
}
</style>