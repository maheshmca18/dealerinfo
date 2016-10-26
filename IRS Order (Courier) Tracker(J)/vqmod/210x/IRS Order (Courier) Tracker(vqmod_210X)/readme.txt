==========================================
IRS Order (Courier) Tracker
==========================================
This Plugin requires "vQmod".

The IRS Order (Courier) Tracker Modules allows The admin can add courier / shipment details to the order. The admin can also assign separate courier details in a particular order. The details provide from admin will be reflected in customer's order history page.

The admin can import bulk  courier / shipment details to the order.

It display on yourstore front using Enable/Disable Modules.

==========================================
IRS Order (Courier) Tracker
==========================================

1. Go to the Extensions -> Modules

		-> Install the Order Tracker Module
              
                -> Edit Order Tracker Module 
                       
		          i) Select Status [ Enabled/Disabled ].          
		              
2.Go to the System -> Users -> User Groups

Select Top Administrator -> Edit
		  
		  Enable the following checkbox,
		  
        		 Access Permission : Localisation/ordertracking    
			 
			 Modify Permission : Localisation/ordertracking    
			 
		  Then Click the Save button.


3. Go to the System -> Localisation -> Order Tracking

		-> First admin  add the number of courier companies you are tied up in Admin

                -> Click Insert Button add your  Order Tracking Company Details  

			  i) Insert Courier Company Name

		          ii) Insert Tracking Url[ Note :- Give your courier tracking deafault url with tracking id. Make sure tracking id parameter as last. Sample tracking url is 'http://www.tpcindia.com/Tracking2014.aspx?type=0&service=0&id=' ]	        
	 
	 		 iii) Select Status [ Enabled/Disabled ].

                -> Now Click "Save" button.


4. Go to the Sales -> Orders

	      -> See the 
                        i) Tracking Code On the Orders List 

	      	       ii) First Select the Courier Company Name from the dropdown list

             	      iii) Enter The tracking code

	     	       iv) Finally click Add Tracker button and tracking details added to the order.Also sent in the order confirmation email when you update order history.

                        v) Click the particular order tracking code button from the order list page, Now that forwards to the courier tracking page on popup window 

           (or)
             
                      i) Edit the Order
        
                     ii) go to the 4.shipping Details tab and see the Courier Company,Tracking Code on the list

	            iii) First Select the Courier Company Name from the dropdown list

                     iv) Enter The tracking code

	             iv) Finally click save button and tracking details added to the order.Also sent in the order confirmation email when you update order history.

        (or)
            
                     i) Click the order view button

                    ii) See the Add Order Tracker Detail from history Tab

                   iii) First Select the Courier Company Name from the dropdown list
 
                    iv) Enter The tracking code

	            iv) Finally click save button and tracking details added to the order.Also sent in the order confirmation email when you update order history.     
	
5. The admin can import bulk  courier / shipment details to the order.

          Go to the Sales -> Orders ->orders list page
               
                -> See Import Button on Top Right corner and Click to Import Button.

              	-> Click "Sample CSV file" on the Top Right corner to ordertracker_list sample excel/CSV file (downloaded).
               
                -> Upload your Excel/CSV file [Note: Like our Sample file].

                -> Click Save button on Top Right corner.
 
 		-> Preview Your uploaded file ordertracker_list data.

                -> Now Click "Publish" button to import all ordertracker details data.

------------------------------------------------------------------------------------------------------------------------
				ordertracker CSV File 
------------------------------------------------------------------------------------------------------------------------
		1. Order_id [valid order_id]
		2. Courier Company [admin configure Courier Company only]
		3. Tracking Code		

------------------------------------------------------------------------------------------------------------------------

6. Go to store front Order History page and see the Tracking code appears from each order.

7. Click the particular order tracking code button from the order History page, Now that forwards to the courier tracking page on popup window


