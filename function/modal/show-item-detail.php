<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_code = $_POST['item_code'];
$pack_type_name = $_POST['pack_type_name'];


?>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<form id="add-cart" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <?php
            $row_item = $conn->query(" select a.item_code,item_name,sale_price,pack_type_name,weight
             from tbl_item_price_sale a
             left join tbl_item_code_list b on a.item_code = b.full_code
             where a.item_code = '$item_code' and pack_type_name = '$pack_type_name'  ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="item_code" value='<?php echo "$item_code"; ?>'>
            <input type="hidden" name="pack_type_name" value='<?php echo "$pack_type_name"; ?>'>
            <input type="hidden" name="sale_price" value='<?php echo  $row_item['sale_price']; ?>'>

            <div class="col-md-12">
                <div class="contact-info px-4">
                    <h4 class="mt-3 mb-3">ຂໍ້ມູນສິນຄ້າ</h4>
                    <div class="row">
                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium"><?php echo $row_item['item_name']; ?></label>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">ຫົວໜ່ວຍ: <?php echo $row_item['pack_type_name']; ?> <?php echo $row_item['weight']; ?></label>
                            </div>
                        </div>

                        <?php

                        $pro_row = $conn->query(" 
                        select  promotion_detail_id, buy_values,
                        (case 
                        when promotion_type_pro = 1 then 'ແຖມສິນຄ້າ' 
                        when promotion_type_pro = 2 then 'ຮັບສ່ວນຫລຸດເປີເຊັນ'
                        when promotion_type_pro = 3 then 'ຮັບມູນຄ່າສ່ວນຫລຸດ' end) as category_pro_type,
                        (case when promotion_type_pro = 1 then b.item_name else '' end) as item_name,
                        (case 
                        when promotion_type_pro = 1 then concat(' ຈຳນວນ ', promotion_values, ' ', pack_type_name_pro)
                        when promotion_type_pro = 2 then concat(promotion_values,' ເປີເຊັນ')
                        when promotion_type_pro = 3 then concat(promotion_values,' THB') end) as promotion_item 
                        from tbl_promotion_detail a
                        left join tbl_item_code_list b on a.item_code_pro = b.full_code
                        where  item_code_buy = '$item_code' and pack_type_name_buy = '$pack_type_name'  ")->fetch(PDO::FETCH_ASSOC);



                        ?>

                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium"> 
                                <span style='color:blue'><?php echo  $pro_row['buy_values']; ?>  </span>ຂື້ນໄປ
                                <span><?php echo  $pro_row['category_pro_type']; ?> </span>
                                <span style='color:blue'><?php echo  $pro_row['item_name']; ?> </span>
                                <span style='color:green'><?php echo  $pro_row['promotion_item']; ?> </span>
                             </label>

                        </div>

                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ຈຳນວນສັ່ງຊື້</label>
                            <div class="form-group">
                                <input type="number" name="order_values" autocomplete="off" class="form-control" required />
                            </div>
                        </div>





                    </div>
                    <div class="d-flex justify-content-center ">
                        <button type="submit" class="btn btn-info mb-2 btn-pill">ສັງສິນຄ້າ</button>
                    </div>
                </div>


            </div>


        </div>
    </div>
</form>