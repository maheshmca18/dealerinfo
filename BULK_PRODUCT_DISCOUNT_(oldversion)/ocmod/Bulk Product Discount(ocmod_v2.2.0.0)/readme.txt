==========================================
Bulk Product Discount
==========================================

Admin Login :
Main Feature :-
=> The admin user can give Category discount and Globaldiscount.

This Extension has works in following pages:- 
Product Detail Page,
Category page,
Search page,
Feature Product Widget,
Related product Widget.

==========================================
Bulk Product Discount
==========================================

1. Go to admin page and ,
             Extensions -> extension installer ->upload your (filename.ocmod.xml) ocmod file.


2. View upload file your Modification,and click refresh button.

3. Go to the Extensions -> Modules

		-> Install the GlobalCategoryDiscount Module
              
                -> Edit GlobalCategoryDiscount Module [Incase Product discount or category discount is Exist,The GlobalCategoryDiscount is not applicable]
                       
		               i) Select Status [ Enabled/Disabled ].
		              
		              ii) Give Global Discount percentage [Integer Value].


4.Go to the System -> Users -> User Groups

Select Top Administrator -> Edit
		  
		  Enable the following checkbox,
		  
        		 Access Permission : Localisation/categorydiscount  
			 
			 Modify Permission : Localisation/categorydiscount  
			 
		  Then Click the Save button.


5. Go to the System -> Localisation -> Category Discount

                -> Click Insert Button add your discount category 

			       i) Give category name[Auto Increment]

		              ii) Select Customer Group 

		             iii) Give Percentage [Integer Value]
	 
	 		     iv)  Select Status [ Enabled/Disabled ].

                -> Now Click "Save" button.



