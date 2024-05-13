DELIMITER $$
CREATE PROCEDURE stp_dash_board_sale()
BEGIN

SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

create TEMPORARY table tmp_collect_all_shop
SELECT distinct item_code,order_by
FROM tbl_customer_order_detail;

create TEMPORARY table tmp_count_shop
select item_code,count(order_by) as count_shop
from tmp_collect_all_shop
group by item_code;
 
create TEMPORARY table tmp_received_order
select item_code,sum(order_values) as ordered_values
from tbl_customer_order_detail
group by item_code;

create TEMPORARY table tmp_customer_order
select item_code,sum(order_values) as customer_order_values,sum(total_price_order) as total_price_order
from tbl_customer_order_detail a
left join tbl_customer_order b on a.customer_order_id = b.customer_order_id
where order_status = '2'
group by item_code;

select a.item_code,item_name,ordered_values,count_shop,
(case when customer_order_values is null then 0 else customer_order_values end) as customer_order_values,
(case when total_price_order is null then 0 else total_price_order end) as total_price_order
from tmp_received_order a
left join tmp_count_shop b on a.item_code = b.item_code
left join tmp_customer_order c on a.item_code = c.item_code
left join tbl_item_code_list d on a.item_code = d.full_code;


END$$
DELIMITER ;