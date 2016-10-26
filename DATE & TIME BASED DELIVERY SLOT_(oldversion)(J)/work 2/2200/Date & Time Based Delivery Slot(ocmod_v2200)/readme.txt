==========================================
Date & Time Based Delivery Slot
==========================================

The Date & Time Based Delivery Slot module allows the Delivery Date and Delivery Time field has shows in Delivery Method Tab, On Cart checkout page.

When customer place order with pick his expected delivery date and Delivery Time in Delivery Method Tab, On Cart checkout page.

Main Feature :-
=> It allows the admin user can add Delivery Time Slot for the day.
=> It allows the admin user can add minimum and maximum days for order delivery.
=> It allows the admin user can add normal holidays for order delivery.
=> It allows the admin user can add recursive holidays for order delivery (for all years).
=> It allows the admin user can add week holidays for order delivery.
=> This extension adds delivery date and  Delivery Time field in the store front checkout Delivery Method Tab.
=> The customer can pick expected Delivery Date and Delivery Time.
=> Delivery date and Delivery Time is shown in Store front's Orderdetail.
=> Delivery date and Delivery Time is shown in Admin Dashboard's Order detail page.
=> Delivery date and Delivery Time is shown in Order Invoice bill and Order confirmation mail also.

It display on yourstore front using install/uninstall like others modules.

==========================================
Date & Time Based Delivery Slot
==========================================


1. Go to the Extensions -> Modules

		-> Install the DeliveryDateTime Module
              
                -> Edit DeliveryDateTime Module 
                       
		               i) Select Status [ Enabled/Disabled ].
		              
		              ii) Give Time Interval [Integer Value][show frontend Time interval duration].

      			     iii) Enter Minimum days. [delivery date enables from current date + minimum days]

     		              iv) Enter Maximum days. [delivery date enables to minimum date + maximum days]


2.Go to the System -> Users -> User Groups

Select Top Administrator -> Edit
		  
		  Enable the following checkbox,
		  
        		 Access Permission : Localisation/deliverytimeslot
					     localisation/holidaymaster
					     module/holidayweekday  
		
			 
			 Modify Permission : Localisation/deliverytimeslot 
					     localisation/holidaymaster
                                             module/holidayweekday 
			 
		  Then Click the Save button.


3. Go to the System -> Localisation -> Delivery Timeslot

                -> Click Insert Button add your  Delivery Timeslot 

			       i) Select From Time

		              ii) Select To Time		        
	 
	 		     iv)  Select Status [ Enabled/Disabled ].

                -> Now Click "Save" button.

4. Go to the Week Holidays page [System -> Localisation -> Weekdays Master]

	-> Pick your week holidays [These days delivery date field has disabled at store front]


5. Go to the Holiday Master page [System -> Localisation -> Holiday Master]

	[These dates are disabled in store front delivery date field]

	-> Click "Add New" button to Add new Holiday
		=> Enter Holiday name
		=> Enter Holiday Date
		=> Pick Is Recursive 
			[No  :- It considers holiday for active year only (like local holidays)]
			[Yes :- It considers holiday for all year (like New Year, Christmas)]

	-> Click "Edit" button to update existing Holiday


6. Go to store front

	-> See the 
                i) Please select the preferred Delivery / Pickup date [Delivery date],

	       ii) Pickup / Delivery Time Slot  field in Delivery Method Tab, On Cart checkout page.

	-> Customer can select his prefer delivery date and delivery time 
	

7. Go to store front Order detail page and see the Delivery Date and Delivery Time appears.

8. Go to Order List [ Admin -> Sales -> Orders ]

       -> Click the view button in Orders list and see the Delivery Date and Delivery Time in order detail.
       -> Click the Print Invoice button and see the Delivery Date and Delivery Time appears in Invoice bill.
       -> Click the Edit  button and see the Delivery Date and Delivery Time appears Shipping Details Tab.
       -> Order confirmation mail also appears the Delivery Date and Delivery Time field.


