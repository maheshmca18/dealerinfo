===============================================================================================
				Read Me : Add Landmark Field
===============================================================================================


	After you completed installation process, you will be able to see these changes

===============================================================================================
Admin Login
===============================================================================================

1. Go to Extensions->Modules. Landmark will be presented

2. Go to Sales->Orders->View( click view of any order You added)->Payment_details. Landmark field will be presented

3. Go to Sales->Orders->View( click view of any order You added)->Shipping_details. Landmark field will be presented   


===============================================================================================
Catalog
===============================================================================================

1. Click Create an account. Landmark field will be presented in that form

2. Order any product without login. Click Continue in Register Account. Landmark field will be presented.

3. Billing Details->I want to use an existing address section select box, before city Landmark will be added (User must login already)

4. Billing Details->I want to use a new address, In that form landmark field will be presented

5. Delivery Details->I want to use an existing address section select box, before city Landmark will be added

6. Delivery Details->I want to use a new address, In that form landmark field will be presented

7. Click My Account->Modify your address book entries->Edit (click edit of your address). Landmark field will be presented in that form (User must login already)


===============================================================================================
Database
===============================================================================================

1. In address table after address_2, landmark field will be presented with default NULL

2. In  order table after payment_address_2, payment_landmark field will be presented with default NULL

3. In  order table after shipping_address_2, shipping_landmark field will be presented with default NULL 