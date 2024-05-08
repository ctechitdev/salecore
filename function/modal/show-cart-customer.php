<?php
include("../../setting/checksession.php");
include("../../setting/conn.php");


?>
<form id="add-bill">
    <div class="card-body" data-simplebar style="height: 550px;">

        <?php
        $stmt_cart = $conn->prepare(" 
        select customer_order_cart_id,a.item_code,item_name,pack_type_name,sale_price,order_values,total_price_order
        from tbl_customer_order_cart a
        left join tbl_item_code_list b on a.item_code = b.full_code
        where a.add_by = '$id_users'    ");

        $total_sale_cart = 0;

        $stmt_cart->execute();
        if ($stmt_cart->rowCount() > 0) {
            while ($cart_row = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <div class="media media-sm">

                    <div class="media-body mx-1">

                        <div class="row  ">

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium"><?php echo  $cart_row['item_name']; ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ລາຄາຕໍ່ໜ່ວຍ: <?php echo  number_format($cart_row['sale_price'],2); ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ຈຳນວນ: <?php echo  $cart_row['order_values']; ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ລວມ: <?php echo number_format($cart_row['total_price_order'],2); ?></label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">

                            <b>
                                <a type="button" id="delete-cart" data-cart_id='<?php echo $cart_row['customer_order_cart_id']; ?>' class="btn btn-danger btn-pill  ">
                                    ລົບ
                                </a>
                            </b>
                        </div>

                    </div>
                </div>


        <?php

                $total_sale_cart += $cart_row['total_price_order'];
            }
        }

        ?>


    </div>


    <div class="card-footer">
        <div class="media media-sm">
            <div class="media-body">

                <span class="title">ລວມ</span>

            </div>
            <div class="media-body">

                <span class="title"><?php echo number_format($total_sale_cart); ?></span>


                <input type="hidden" name="total_sale_cart" value='<?php  echo ($total_sale_cart)  ; ?>'>

            </div>
        </div>
        <div class="d-flex justify-content-center ">
            <button type="submit" class="btn btn-success btn-pill">ຢືນຢັນສັ່ງຊື້</button>
        </div>
    </div>

</form>