DELIMITER $$
CREATE or replace PROCEDURE rpt_sumary_visit_sale_report(`startdate` VARCHAR(20), `enddate` VARCHAR(20))
BEGIN

create TEMPORARY table tmp_count_visit

SELECT count(vc_id) as count_visit,customer_type
FROM tbl_visited_customer a
left join tbl_visit_dairy b on a.cus_code = b.vd_id
where date_check  between startdate and  enddate
group by customer_type;
 

create TEMPORARY table tmp_count_buy

SELECT   count(sbo_id) as count_buy,customer_type
FROM  tbl_shell_bill_order a
left join tbl_visit_dairy b on a.cus_code = b.vd_id
where register_date  between startdate and  enddate
group by customer_type;


create TEMPORARY table tmp_count_new

SELECT  count(vd_id) as new_count ,customer_type
FROM  tbl_visit_dairy
WHERE MONTH(register_date) = MONTH(CURRENT_DATE())  
group by customer_type;
    
 


create TEMPORARY table tmp_join

select a.customer_type ,count_visit,
(case when count_buy is null then 0 else count_buy end) as count_buy,
(case when new_count is null then 0 else new_count end) as new_count
from tmp_count_visit a
left join tmp_count_buy b on a.customer_type = b.customer_type
left join tmp_count_new c on a.customer_type = c.customer_type ;
 

select  *  from tmp_join  ;


END$$
DELIMITER ;