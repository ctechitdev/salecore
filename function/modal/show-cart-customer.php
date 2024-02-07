<?php
include("../../setting/checksession.php");
include("../../setting/conn.php");


?>
<form id="add-bill">
    <div class="card-body" data-simplebar style="height: 550px;">

        <?php
        $stmt_cart = $conn->prepare(" 
        SELECT a.item_post_id,a.item_name,item_values,total_price,item_post_pic,price_per_item,customer_order_cart_id
        FROM tbl_customer_order_cart a
        left join tbl_item_post_customer b on a.item_post_id = b.item_post_customer_id
        where a.add_by = '$id_users'    ");

        $total_sale_cart = 0;

        $stmt_cart->execute();
        if ($stmt_cart->rowCount() > 0) {
            while ($cart_row = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <div class="media media-sm">
                    <div class="media-sm-wrapper">
                        <img src='../images/item_post/<?php echo $cart_row['item_post_pic']; ?>' width="100%" alt="User Image">

                    </div>
                    <div class="media-body mx-1">

                        <div class="row  ">

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium"><?php echo  $cart_row['item_name']; ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ລາຄາຕໍ່ໜ່ວຍ: <?php echo  $cart_row['price_per_item']; ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ຈຳນວນ: <?php echo  $cart_row['item_values']; ?></label>
                            </div>

                            <div class="col-lg-12">
                                <label class="text-dark font-weight-medium">ລວມ: <?php echo number_format($cart_row['total_price']); ?></label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">

                            <b>
                                <a type="button"  id="delete-cart" data-cart_id='<?php echo $cart_row['customer_order_cart_id']; ?>' class="btn btn-danger btn-pill  ">
                                    ລົບ
                                </a>
                            </b>
                        </div>

                    </div>
                </div>


        <?php

                $total_sale_cart += $cart_row['total_price'];
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

            </div>
        </div>
        <div class="d-flex justify-content-center ">
            <button type="submit" class="btn btn-success btn-pill" >ຢືນຢັນສັ່ງຊື້</button>
        </div>
    </div>

</form>