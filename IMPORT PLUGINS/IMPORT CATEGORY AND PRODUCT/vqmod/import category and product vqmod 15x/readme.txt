==========================================
Read Me : Import Category Data
==========================================

Admin Login :

1. Go to the Category list Page 

		:- Sales > Catalog > Categories

		:- See import button and click here.

2. View Category Import Screen.

		:- Click "Sample CSV file" to Categorylist sample excel/CSV file (downloaded).

                :- Upload your Excel/CSV file [Note: Like our Sample file].

                :- Click Submit button.
 
 		:- Preview Your uploaded file Category data.

                :- Now Click "Publish" button to import all Category data.

3. Done.

==========================================
Read Me : Import Product Data
==========================================

Admin Login :

1. Go to the Products list Page 

		:- Sales > Catalog > Products

		:- See import button and click here.

2. View Product Import Screen.

		:- Click "Sample CSV file" to Categorylist sample excel/CSV file (downloaded).

                :- Upload your Excel/CSV file [Note: Like our Sample file].

                :- Click Submit button.
 
 		:- Preview Your uploaded file Product data.

                :- Now Click "Publish" button to import all Product data.

3. Done.


Our CSV file columns are following:-
	
	
------------------------------------------------------------------------------------------------------------------------
				Category CSV File
------------------------------------------------------------------------------------------------------------------------
		1. Category Name (*)	[we use this field as Primary Key to import bulk Products.If Product Name has exists, can not insert again only update.]
		2. Category Description	
		3. Parent Category	[MUST as the same as Database]	
		4. Status  [Enabled/Disabled]

-----------------------------------------------------------------------------------------------------------------------
		
	
------------------------------------------------------------------------------------------------------------------------
				Product CSV File 
------------------------------------------------------------------------------------------------------------------------
		1. Product Name(*) [we use this field as Primary Key to import bulk Products.If Product Name has exists, can not insert again only update.]
		2. Model(*)	
		3. Product Description	
		4. Categories(*) [MUST as the same as Database, Multiple Categories as comma seperated LIKE Category1,Category2]	
		5. SKU	
		6. UPC	
		7. EAN	
		8. JAN	
		9. ISBN	
		10. MPN	
		11. Location	
		12. Quantity(*)	
		13. Minimum	
		14. Subtract [Yes/No]	
		15. Stock Status(*) [MUST as the same as Database,like Apple, Canon]			
		16. Date Available	[YYYY-MM-DD]
		17. Manufacturer(*)	[MUST as the same as Database,like Apple, Canon]		
		18. Shipping [Yes/No]		
		19. Price	
		20. Weight	
		21. Weight Class [MUST as the same as Database,like Gram, Kilogram]		
		22. Length	
		23. Width	
		24. Height	
		25. Length Class [MUST as the same as Database,like Centimeter, Inch]		
		26. Tax Class [MUST as the same as Database,like Downloadable Products, Taxable Goods]	
		27. Sort Order	
		28. Meta Key	
		29. Meta Description	
		30. Tag	
		31. Keyword	
		32. Image [Like data/demo/yourimage.jpg]	
		33. Additional Images [Like data/demo/yourimage1.jpg,data/demo/yourimage2.jpg]	
		34. Status [Enabled/Disabled]
-----------------------------------------------------------------------------------------------------------------------
		