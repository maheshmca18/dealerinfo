==========================================
Product Based Shipping Price
==========================================
This Plugin requires "vQmod".

The Product Based Shipping Price Modules allows The admin can Create shipping price based on the Product.

The admin can create Zone and the Zone include csv bulk upload zone locations and postcodes.

Products available to Customer based on Zone Postcode.

==========================================
Product Based Shipping Price
==========================================

1. Go to the Extensions -> Modules

		-> Install the Product Based Shipping Module
              
                -> Edit Product Based Shipping Module 
                       
		          i) Give the shipping price showing text.          
		              
2.Go to the System -> Users -> User Groups

Select Top Administrator -> Edit
		  
		  Enable the following checkbox,
		  
        		 Access Permission : Localisation/productshipping     
			 
			 Modify Permission : Localisation/productshipping     
			 
		  Then Click the Save button.


3. Go to the System -> Localisation -> Product Based Shipping

		-> First admin add Zone name and status [Enable/Disable].

                -> Second admin edit the Zone and add zone location and zone postcode

                -> If you want to upload bulk zone locations and zone postcodes for each Zones, Simply used bulk import feature.

		    * The admin can import bulk zone locations and zone postcodes to the Zones.

			  Go to the System -> Localisation -> Product Based Shipping -> Edit Zone name
			       
				-> See Import Button on Top Right corner and Click to Import Button.

			      	-> Click "Sample CSV file" on the Top Right corner to zoneslocations_list sample excel/CSV file (downloaded).
			       
				-> Upload your Excel/CSV file [Note: Like our Sample file].

				-> Click Save button on Top Right corner.
		 
		 		-> Preview Your uploaded file zoneslocations_list data.

				-> Now Click "Publish" button to import all zoneslocations_list details data.

		------------------------------------------------------------------------------------------------------------------------
						zoneslocations_list CSV File 
		------------------------------------------------------------------------------------------------------------------------
				1. Zone location 

				2. Zone Postcode				

		------------------------------------------------------------------------------------------------------------------------

			  

4. Go to the Catalog -> Products 

	     -> Select Zone from the list [ Shipping Price applied only for the selected Zones from the Product ]
              
             -> Give Shipping Price

5. Go the store fornt and check shipping price to the zone postcode from Product detail page .
          
6. Go to store fornt and the Shipping Price appears the following tabs,

    i) Delivery Methode Tab,

   ii) Confirm order page 

  iii) Front end Order history

   iv) Admin end Sales Order 


