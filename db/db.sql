
--- sale core database ----

create table tbl_user_staff (
    usid int not null PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(300),
    user_name varchar(30),
    company_name varchar(20),
    comcode_type varchar(20),
    user_password varchar(30),
    role_id int,
    depart_id int,
    user_status int,
    date_register date
);
alter table tbl_user_staff add column role_id int;
alter table tbl_user_staff add column depart_id int;

create table tbl_depart (
    dp_id int not null PRIMARY KEY AUTO_INCREMENT,
    dp_name varchar(150),
    group_id int
);

create table tbl_group_company (
    gc_id int not null PRIMARY KEY AUTO_INCREMENT,
    gc_name varchar(300)
);

create table tbl_provinces (
    pv_id int not null PRIMARY KEY AUTO_INCREMENT,
    pv_name varchar(300)
);

create table tbl_districts (
    dis_id int not null PRIMARY KEY AUTO_INCREMENT,
    pv_id int,
    distict_name varchar(300)
);

create table tbl_account_company (
    ac_ic int not null PRIMARY KEY AUTO_INCREMENT,
    acc_number varchar(30),
    acc_name varchar(150),
    acc_code varchar(50),
    company_code varchar(10),
    code_type varchar(50),
    code_lenght varchar(30)
);

alter table tbl_account_company add column code_type varchar(50);

alter table tbl_account_company add column code_lenght varchar(50);

alter table tbl_account_company add column vendor_code varchar(50);


create table tbl_staff_sale (
    ss_id int not null PRIMARY KEY AUTO_INCREMENT,
    staff_code varchar(10),
    staff_cp varchar(10),
    staff_name varchar(300),
    user_ids int
);

create table tbl_roles (
    r_id int not null PRIMARY KEY AUTO_INCREMENT,
    role_name varchar(150)
);

create table tbl_price_list (
    pl_id int not null PRIMARY KEY AUTO_INCREMENT,
    pricelist_name varchar(100),
    b1_code varchar(10)
);

create table tbl_customer (
    c_id int not null PRIMARY KEY AUTO_INCREMENT,
    c_code varchar(30),
    c_zone varchar(30),
    c_class varchar(30),
    cus_type varchar(3),
    acc_code varchar(5),
    pv_team_code varchar(5),
    last_number int,
    c_shop_name varchar(300),
    gender varchar(1),
    c_name varchar(300),
    c_eng_name varchar(100),
    provinces varchar(150),
    district varchar(150),
    village varchar(300),
    street varchar(300),
    h_unit varchar(4),
    h_number varchar(4),
    identfy_number varchar(30),
    location_des text,
    phone1 varchar(20),
    phone2 varchar(20),
    fax varchar(20),
    pl_id int,
    payment_type varchar(10),
    credit_values int,
    payment_term int,
    contact_by varchar(300),
    contact_phone varchar(30),
    staff_contact varchar(10),
    shop_type varchar(20),
    service_type varchar(20),
    visit_days varchar(20),
    date_register date,
    add_by int
);

create table tbl_payment_term (
    pt_id int not null PRIMARY KEY AUTO_INCREMENT,
    pt_name varchar(5),
    b1_number varchar(5)
);

create table tbl_staff_company (
    sc_id int not null PRIMARY KEY AUTO_INCREMENT,
    company_id int,
    depart_id int,
    date_register date
);

create table tbl_category_type (
    cat_id int not null PRIMARY KEY AUTO_INCREMENT,
    cat_name varchar(100)
);

create table tbl_item_company_code (
    icc_id int not null PRIMARY KEY AUTO_INCREMENT,
    name_company varchar(150),
    item_company_code varchar(2),
    item_group_code_b1 varchar(5),
    customer_item_code varchar(5),
    purchase_tax_code varchar(5),
    sale_tax_code varchar(5),
    company_code varchar(10)
);

create table tbl_item_code (
    it_id int not null PRIMARY KEY AUTO_INCREMENT,
    icc_id int,
    pl_id int,
    date_use date,
    ccy varchar(5),
    add_by int,
    date_register date
);

create table tbl_item_code_list (
    icl_id int not null PRIMARY KEY AUTO_INCREMENT,
    full_code varchar(100),
    it_id int,
    last_code int,
    item_header_code varchar(10),
    item_code varchar(30),
    item_name varchar(300),
    item_price float,
    buy_unit varchar(10),
    sale_unit varchar(10),
    pack varchar(5),
    weight varchar(30),
    com_code varchar(30),
    date_register date
);

create table tbl_price_update (
    pu_id int not null PRIMARY KEY AUTO_INCREMENT,
    pl_id int,
    date_use date,
    ccy varchar(5),
    com_code varchar(10),
    add_by int,
    date_register date
);

create table tbl_price_update_list (
    pul_id int not null PRIMARY KEY AUTO_INCREMENT,
    pu_id int,
    item_id int,
    price_update float,
    date_register date
);

create table tbl_item_edit (
    ie_id int not null PRIMARY KEY AUTO_INCREMENT, 
    add_by int,
    date_register date
);

create table tbl_item_edit_detail_list (
    iedl_id int not null PRIMARY KEY AUTO_INCREMENT,
    ie_id int,
    item_id int,    
    item_name varchar(300), 
    buy_unit varchar(10),
    sale_unit varchar(10),
    pack varchar(5),
    weight varchar(30), 
    brand_name varchar(300), 
    date_register date
);

create table tbl_staff_item_code (
    sic_id int not null PRIMARY KEY AUTO_INCREMENT,
    icc_id int,
    use_by int,
    date_register date
);

create table tbl_header_title (
    ht_id int not null PRIMARY KEY AUTO_INCREMENT,
    ht_name varchar(300)
);

create table tbl_sub_title (
    st_id int not null PRIMARY KEY AUTO_INCREMENT,
    st_name varchar(300),
    icon_code varchar(100),
    ht_id int
);

create table tbl_page_title (
    pt_id int not null PRIMARY KEY AUTO_INCREMENT,
    pt_name varchar(300),
    ptf_name varchar(100),
    st_id int
);

create table tbl_role_page (
    rp_id int not null PRIMARY KEY AUTO_INCREMENT,
    role_id int,
    ht_id int,
    st_id int,
    pt_id int
);

create table tbl_kptl_tcode (
    kt_id int not null PRIMARY KEY AUTO_INCREMENT,
    kt_name varchar(10)
);

create table tbl_day_visit (
    dv_id int not null PRIMARY KEY AUTO_INCREMENT,
    dv_name varchar(90),
    dv_code varchar(20)
);

create
or replace view view_customer_pdf as (
    SELECT
        c_id,
        c_code,
        acc_name,
        c_shop_name,
        c_name,
        c_eng_name,
        village,
        street,
        h_unit,
        h_number, 
        SUBSTRING(identfy_number, 1, 20) as identfy_number,
         SUBSTRING(location_des, 1, 50) as location_des,
        phone1,
        phone2,
        fax, 
        credit_values,
        payment_term,
        pt_name,
        contact_by,
        contact_phone,
        shop_type,
        service_type,
        visit_days,
        (
            case
                when gender = 'M' then 'ຊາຍ'
                else 'ຍິງ '
            end
        ) as gender,
        (
            case
                when staff_contact = '0' then ''
                else staff_cp
            end
        ) as staff_contact,
        (
            case
                when payment_type = 'Cash' then 'ຈ່າຍສົດ'
                when payment_type = 'Credit' then 'ຕິດໜີ້'
                else ''
            end
        ) as payment_type,
        pv_name,
        distict_name,
        gc_name,
        ref_number,
        acc_book,
        bank_code,
        ccy,
        bank_acc_name
    FROM
        tbl_customer a
        left join tbl_account_company b on a.acc_code = b.company_code
        left join tbl_provinces c on a.provinces = c.pv_id
        left join tbl_districts d on a.district = d.dis_id
        left join tbl_user_staff e on a.add_by = e.usid
        left join tbl_depart f on e.depart_id = f.dp_id
        left join tbl_group_company g on f.group_id = g.gc_id
        left join tbl_payment_term h on a.payment_term = h.b1_number
        left join tbl_staff_sale i on a.staff_contact = i.staff_code

);



--- end sale core data base ----


---- shop online database ------



create table tbl_user_customer (
    ucid int not null PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(300),
    user_name varchar(30),
    user_pass varchar(30),
    date_register date
);

create table tbl_item_detail (
    it_id int not null AUTO_INCREMENT PRIMARY KEY, 
    full_code varchar(100), 
    item_header_code varchar(10),
    item_code varchar(30),
    item_name varchar(300),
    item_price float, 
    sale_unit varchar(10),
    pack varchar(5),
    weight varchar(30),
    com_code varchar(30),
    date_register date
);

create table tbl_warehouse (
 wh_id int not null AUTO_INCREMENT PRIMARY KEY,
 wh_name varchar(150),
 wh_code varchar(20),
 com_code varchar(30),
 wh_province varchar(150),
 wh_district varchar(150),
 wh_village varchar(300),
 add_by int,
 date_register date
);


create table tbl_item_transaction (
    its_id int not null AUTO_INCREMENT PRIMARY KEY,
    item_code varchar(100),
    item_values int,
    its_type int,
    wh_id int,
    add_by int,
    date_register date
);


 
 

create table tbl_item_transaction_type
(
    itt_id int not null AUTO_INCREMENT PRIMARY KEY,
    itt_name varchar(150)
);

create or replace table tbl_shell_bill_order (
    sbo_id int not null PRIMARY KEY AUTO_INCREMENT,
    cus_code varchar(30),
    sbo_number varchar(30),
    sbo_status int,
    sbo_price float,
    sbo_type int,
    sbo_ccy varchar(5),
    credit_day int,
    sbo_b1_status int,
    order_by int,
    date_register date
);

create or replace table tbl_shell_sale_order(
sso_id int not null AUTO_INCREMENT PRIMARY KEY,
sbo_id int,
item_name varchar(300),
item_unit int,
item_price float,
item_total_price float,
item_cate_type varchar(30),
order_by int,
date_register date
);



---- warehouse database ------



create table tbl_warehouse (
 wh_id int not null AUTO_INCREMENT PRIMARY KEY,
 wh_name varchar(150),
 wh_code varchar(20),
 com_code varchar(30),
 wh_province varchar(150),
 wh_district varchar(150),
 wh_village varchar(300),
 add_by int,
 date_register date
);

create or replace table tbl_transfer_bill (
    tf_id int not null AUTO_INCREMENT PRIMARY KEY, 
    wh_id int,
    request_by int,
    doc_number varchar(20), 
    date_upload date,
    upload_by int

);

create table tbl_item_transaction (
    its_id int not null AUTO_INCREMENT PRIMARY KEY,
    tfb_id int,
    item_code varchar(100),
    item_name varchar(300),
    packing varchar(50), 
    item_values int,
    add_by int,
    time_transaction time,
    date_register date
);


create or replace table tbl_visit_dairy(
    vd_id int not null PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    cus_code varchar(30),
    c_shop_name varchar(150),
    provinces int,
    district int,
    village_name varchar(150),
    phone_number varchar(20),
    day_visit varchar(10),
    week_visit int ,
    register_date date
);

create table tbl_vendor (
    vendor_id int not null PRIMARY KEY AUTO_INCREMENT,
    acc_code varchar(5),
    vendor_name varchar(150),
    vendor_shop_name varchar(150),
    vendor_code varchar(30),
    vendor_code_type  varchar(10),
    last_number int,
    company_register_code varchar(30),
    vat_register_code varchar(30),
    phone_office varchar(15),
    phone_mobile varchar(15),
    email varchar(100),
    province_name varchar(150),
    district_name varchar(150),
    village varchar(300),
    contact_type varchar(30),
    contact_expire_date date,
    cash_type varchar(20),
    term_payment varchar(50),
    service_type varchar(150),
    service_detail text,
    transport_detail text,
    add_by int,
    register_date date
);

create table tbl_vendor_bank_account(
    vendor_bank_account_id int not null PRIMARY KEY AUTO_INCREMENT,
    vendor_id int,
    account_currency varchar(10),
    bank_name varchar(150),
    bank_account_name varchar(150),
    bank_account_number varchar(50)
);


create table tbl_evaluation_question(
    evaluation_question_id int not null PRIMARY KEY AUTO_INCREMENT,
    evaluation_question_title text,
    evaluation_question_data text,
    question_status int,
    evaluation_point int
);


create table tbl_vendor_evaluated(
    vendor_evaluated_id int not null PRIMARY KEY AUTO_INCREMENT,
    vendor_id int, 
    evaluated_date date,
    evaluated_by int,
    commend_from_evaluator text,
    evaluated_month date,
    approve_by int
);

create table tbl_vendor_evaluated_detail (
    vendor_evaluated_detail_id int not null PRIMARY KEY AUTO_INCREMENT,
    vendor_evaluated_id int,
    evaluation_question_id int,
    evaluation_score int,
    evaluation_multi_score int
);



---- customer module --------


create table tbl_customer_user(
    customer_user_id int not null PRIMARY KEY AUTO_INCREMENT, 
    customer_name varchar(150),
    customer_user_name varchar(30),
    customer_user_password varchar(30),
    customer_status int,
    company_depart_id int,
    role_id int,
    add_by int,
    add_date date
);

create table tbl_customer_shop_holder(
    customer_shop_holder_id int not null PRIMARY KEY AUTO_INCREMENT,
    customer_user_id int,
    customer_id int,
    add_by int,
    date_add date
);


create table tbl_customer_product_used(
    customer_product_used int PRIMARY KEY AUTO_INCREMENT,
    customer_user_id int,
    item_company_code_id int,
    add_by int,
    date_add date
);


create table tbl_customer_order_status (
    customer_order_status_id int not null PRIMARY KEY AUTO_INCREMENT,
    customer_order_status_name varchar(60)
);

insert into tbl_customer_order_status (customer_order_status_name) values ('ສັ່ງສຳເລັດ');
insert into tbl_customer_order_status (customer_order_status_name) values ('ຮັບອໍເດີ້ແລ້ວ'); ;
insert into tbl_customer_order_status (customer_order_status_name) values ('ຍົກເລີກ');

create table tbl_customer_order(
    customer_order_id int not null PRIMARY KEY AUTO_INCREMENT,
    customer_order_bill varchar(20),
    total_price decimal(20,4),
    order_status int,
    order_by int,
    order_date date, 
    recieve_order_date date
);

create table tbl_customer_order_detail(
    customer_order_detail_id int not null PRIMARY KEY AUTO_INCREMENT,
    customer_order_id int,
    item_code_list_id int,
    item_company_code_id int,
    item_post_id int,
    item_name varchar(300),
    order_values int,
    item_pack_unit varchar(10),
    item_price_unit decimal(20,4),
    item_total_price decimal(30,4),
    order_by int,
    date_order date
);

 
alter table tbl_item_code_list add column show_staff_status_id int;
alter table tbl_item_code_list add column show_customer_status_id int;


create  table tbl_item_post_customer(
    item_post_customer_id int not null PRIMARY KEY AUTO_INCREMENT,
    item_post_pic varchar(100),
    item_code_list_id int,
    item_company_code_id int,
    full_code varchar(100),
    item_name varchar(300),
    item_pack_sale varchar(30),
    item_status_sale int,
    item_price float,
    add_by int,
    add_date date
);

create table tbl_customer_order_cart (
    customer_order_cart_id int not null PRIMARY KEY AUTO_INCREMENT, 
    item_post_id int,
    item_code_list_id int,
    item_name varchar(300),
    item_pack_sale varchar(30),
    price_per_item float,
    item_values int,
    total_price float, 
    add_by int,
    add_date date
);