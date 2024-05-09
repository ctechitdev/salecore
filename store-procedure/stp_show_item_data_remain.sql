DELIMITER $$
CREATE  PROCEDURE stp_show_item_data_remain()
BEGIN

SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

create TEMPORARY table tmp_stock_in
select item_code,warehouse_id, sum(credit_value) as base_in_values,pack_type_name
from tbl_stock_bill_detail a
left join tbl_stock_bill b on a.stock_bill_id = b.stock_bill_id
where credit_value > 0 and status_bill_id = '2'
group by item_code,warehouse_id;


create TEMPORARY table tmp_stock_out
select item_code,warehouse_id, sum(debit_value) as base_out_values,pack_type_name
from tbl_stock_bill_detail
where debit_value > 0
group by item_code,warehouse_id;

create TEMPORARY table tmp_stock_remain
select a.item_code,a.warehouse_id,
( base_in_values - (case when base_out_values is null then 0 else base_out_values end)) as remain,a.pack_type_name
from tmp_stock_in a
left join tmp_stock_out b on a.item_code = b.item_code and a.warehouse_id = b.warehouse_id and a.pack_type_name = b.pack_type_name;
 

select   a.item_code,item_name,a.pack_type_name,(case when sale_price is null then 0 else sale_price end) as sale_price,weight,remain
from tmp_stock_remain a
left join tbl_item_code_list b on a.item_code = b.full_code 
left join tbl_item_price_sale c on a.item_code = c.item_code and a.pack_type_name = c.pack_type_name
where remain > 0 and sale_price > 0
group by a.item_code,item_name
order by item_name asc;

 


END$$
DELIMITER ;