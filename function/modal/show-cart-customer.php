<?php
include("../../setting/checksession.php");
include("../../setting/conn.php");


?>
<form id="add-bill">
    <div class="card-body" data-simplebar style="height: 520px;">

        <?php
        $stmt_cart = $conn->prepare("  select *  from tbl_customer_order_cart  where add_by = '$id_users'    ");
     
        $total_sale_cart = 0;

        $stmt_cart->execute();
        if ($stmt_cart->rowCount() > 0) {
            while ($cart_row = $stmt_cart->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <div class="media ">
                    <div class="media-body mt-1">

                        <span class="title"><b><?php echo  $cart_row['item_post_id']; ?></b></span>

                    </div>
                    <div class="media-body mt-1">

                        <span class="title"><b><?php echo number_format($cart_row['item_post_id']); ?></b></span>

                    </div>
                    <a type="button" id="delete-cart" data-cart_id='<?php echo $cart_row['buy_lottery_cart_id']; ?>' class="btn btn-danger btn-pill  mb-1">
                        ລົບ
                    </a>
                </div>

        <?php
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
            <button type="submit" class="btn btn-success btn-pill" data-toggle="modal" data-target="#modal-edit">ອອກບິນ</button>
        </div>
    </div>

</form>