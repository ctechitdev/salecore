DELIMITER $$
CREATE or replace PROCEDURE stp_check_stock_add_cart(code_item varchar(50), name_pack varchar(50))
BEGIN


create TEMPORARY table tmp_stock_in
select item_code,warehouse_id, sum(credit_value) as base_in_values,pack_type_name
from tbl_stock_bill_detail
where credit_value > 0
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
 

select * from tmp_stock_remain
where item_code = code_item and pack_type_name = name_pack;


END$$
DELIMITER ;