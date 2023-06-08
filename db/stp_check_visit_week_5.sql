DELIMITER $$
CREATE or replace PROCEDURE stp_check_visit_week_5(day_name VARCHAR(20),month_buy VARCHAR(20),year_buy VARCHAR(20), id_user VARCHAR(20))
BEGIN

create TEMPORARY table tmp_all_visit

SELECT vd_id,cus_code,c_shop_name,pv_name,distict_name,village_name,phone_number
from tbl_visit_dairy a
left join tbl_provinces b on a.provinces = b.pv_id
left join tbl_districts c on a.district = c.dis_id 
where day_visit = day_name   and user_id = id_user;



create TEMPORARY table tmp_check_buy_item_customer 
SELECT   cus_code as vd_id, sum(sbo_price) as buy_price,
MONTH(date_register) as month_buy,
YEAR(date_register) as year_buy
FROM tbl_shell_bill_order
where MONTH(date_register) = month_buy and YEAR(date_register) = year_buy
group by vd_id  ;


create TEMPORARY table tmp_check_buy

select a.vd_id,cus_code,c_shop_name,pv_name,distict_name,village_name,phone_number,
(case when buy_price is null then 0 else buy_price end) as buy_price
from tmp_all_visit a
left join tmp_check_buy_item_customer b on a.vd_id = b.vd_id ;
 

select  * from tmp_check_buy where buy_price  = 0 ;


END$$
DELIMITER ;