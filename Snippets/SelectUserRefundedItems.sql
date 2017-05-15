-- Here is the combination query.
-- Below it is the breakdown.
SELECT i.id AS invoice_id, 
msi.name AS item_name, 
ii.price_per_item, ii.quantity AS bought_quantity, 
u.user_name AS buyer_user_name, 
a.street1 AS seller_address, 
iisr.invoice_item_status_id, 
iis.name AS status_name 
FROM RefundItem ri 
INNER JOIN InvoiceItem ii ON ri.invoice_item_id = ii.id 
INNER JOIN Invoice i ON ii.invoice_id = i.id 
INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id 
INNER JOIN Users u ON i.buyer_user_id = u.user_id 
INNER JOIN Address a ON i.ship_from_address_id = a.id 

INNER JOIN 
(
    SELECT * FROM InvoiceItemStatusRecord 
	WHERE (invoice_item_id, status_start_date) IN 
	(
        SELECT invoice_item_id, MAX(status_start_date)
        FROM InvoiceItemStatusRecord 
        GROUP BY invoice_item_id    
    )
) iisr ON ii.id = iisr.invoice_item_id 

INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id 
WHERE u.user_id = 10 





SELECT i.id AS invoice_id, 
msi.name AS item_name, 
ii.price_per_item, ii.quantity AS bought_quantity, 
u.user_name AS buyer_user_name, 
a.street1 AS seller_address, 
iisr.invoice_item_status_id, 
iis.name AS status_name 
FROM RefundItem ri 
INNER JOIN InvoiceItem ii ON ri.invoice_item_id = ii.id 
INNER JOIN Invoice i ON ii.invoice_id = i.id 
INNER JOIN MyStoreItems msi ON ii.store_item_id = msi.id 
INNER JOIN Users u ON i.buyer_user_id = u.user_id 
INNER JOIN Address a ON i.ship_from_address_id = a.id 

INNER JOIN InvoiceItemStatusRecord iisr ON ii.id = iisr.invoice_item_id 

-- INNER JOIN InvoiceItemStatusRecord iisr ON ii.id = iisr.invoice_item_id 

INNER JOIN InvoiceItemStatus iis ON iisr.invoice_item_status_id = iis.id 
WHERE u.user_id = 10 

SELECT MAX(status_start_date), invoice_item_id 
FROM InvoiceItemStatusRecord 
GROUP BY invoice_item_id




-- Awesome! I can do this???  Woow!
SELECT * FROM InvoiceItemStatusRecord 
WHERE (invoice_item_id, invoice_item_status_id) IN ((40, 5), (45, 3))



(SELECT * FROM InvoiceItemStatusRecord 
WHERE (invoice_item_id, status_start_date) IN 
	(
        SELECT invoice_item_id, MAX(status_start_date)
        FROM InvoiceItemStatusRecord 
        GROUP BY invoice_item_id    
    ))