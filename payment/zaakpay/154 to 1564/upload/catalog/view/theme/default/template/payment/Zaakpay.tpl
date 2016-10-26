
		<?php

		?>
	<form action="<?php echo $action; ?>" method="post" id="payment">

<input type="hidden" name="merchantIdentifier" value="<?php echo $merchantIdentifier; ?>" />
<input type="hidden" id="orderId" name="orderId" value="<?php echo $orderId; ?>"/>
<input type="hidden" name="returnUrl" id="returnUrl" value="<?php echo $returnUrl ; ?>"/>

	<input type="hidden" name="buyerEmail" id="buyerEmail" value="<?php echo $buyerEmail; ?>"  />
	<input type="hidden" name="buyerFirstName" id="buyerFirstName" value="<?php echo $buyerFirstName; ?>" />
<input type="hidden" name="buyerLastName" id="buyerLastName" value="<?php echo $buyerLastName; ?>" />
<input type="hidden" name="buyerAddress" id="buyerAddress" value="<?php echo $buyerAddress; ?>" /> 
<input type="hidden" name="buyerCity" id="buyerCity" value="<?php echo $buyerCity; ?>" />
<input type="hidden" name="buyerState" id="buyerState" value="<?php echo $buyerState; ?>" />
<input type="hidden" name="buyerCountry" id="buyerCountry" value="<?php echo $buyerCountry; ?>" />
	<input type="hidden" name="buyerPincode" id="buyerPincode" value="<?php echo $buyerPincode; ?>" />
	<input type="hidden" name="buyerPhoneNumber" id="buyerPhoneNumber" value="<?php echo $buyerPhoneNumber; ?>" />
	<input type="hidden" name="txnType" id="txnType" value="<?php echo $txnType ; ?>" />
	<input type="hidden" name="zpPayOption" id="zpPayOption" value="<?php echo $zpPayOption ; ?>" />
	<input type="hidden" name="mode" id="mode" value="<?php echo $mode ; ?>" /> 
	<input type="hidden" name="currency" value="<?php echo $currency ; ?>" />
	<input type="hidden" name="amount" id="amount" value="<?php echo $amount ; ?>" />
	<input type="hidden" name="merchantIpAddress" id="merchantIpAddress" value="<?php echo $merchantIpAddress ; ?>" />
<input type="hidden" name="purpose" id="purpose" value="<?php echo $purpose ; ?>" />
<input type="hidden" name="productDescription" id="productDescription" value="<?php echo $productDescription ; ?>" />
<!-- <input type="hidden" name="product1Description" id="product1Description" value=""/> -->

 <!-- <input type="hidden" name="product2Description" id="product2Description" value=""/> -->

 <!-- <input type="hidden" name="product3Description" id="product3Description" value=""/> -->

<!-- <input type="hidden" name="product4Description" id="product4Description" value=""/> -->
<!--
 <input type="hidden" name="shipToAddress" id="shipToAddress" value="" /> 
 <input type="hidden" name="shipToCity" id="shipToCity" value=""/>

 <input type="hidden" name="shipToState" id="shipToState" value=""/> 

 <input type="hidden" name="shipToCountry" id="shipToCountry" value=""/>

 <input type="hidden" name="shipToPincode" id="shipToPincode" value=""/>

 <input type="hidden" name="shipToPhoneNumber" id="shipToPhoneNumber" value=""/>

 <input type="hidden" name="shipToFirstname" id="shipToFirstname" value=""/>
	<input type="hidden" name="shipToLastname" id="shipToLastname" value=""/>
	
	-->
<input type="hidden" name="txnDate" id="txnDate" value="<?php echo $txnDate; ?>"/>
  	<input type="hidden" name="checksum" id="checksum" value="<?php echo $checksum; ?>"  />   
 <div class="buttons">
    <div class="right"><a onclick="$('#payment').submit();" class="button"><span><?php echo $button_confirm; ?></span></a></div>
  </div>			
</form>
