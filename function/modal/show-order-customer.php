<?php
include("../../setting/checksession.php");
include("../../setting/conn.php");


?>


<div class="card-body" data-simplebar style="height: 600px;">
    <?php
    $stmt_his = $conn->prepare(" select * from tbl_customer_order where order_by = '$id_users' order by customer_order_id desc ");
    ?>
    <tbody>
        <?php



        $stmt_his->execute();
        if ($stmt_his->rowCount() > 0) {
            while ($his_row = $stmt_his->fetch(PDO::FETCH_ASSOC)) {

                if ($his_row['order_status'] == 1) {
                    $button_color = "btn-info";
                }else  if ($his_row['order_status'] == 2){
                    $button_color = "btn-success";
                }else  if ($his_row['order_status'] == 3){
                    $button_color = "btn-danger";
                }

        ?>



                <div class="media ">

                    <div class="row  ">

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium"><?php echo  $his_row['customer_order_bill']; ?></label>
                        </div>

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ລວມ: <?php echo number_format($his_row['total_price']); ?></label>
                        </div>
                    </div>

                    <a href="javascript:0" class='btn <?php echo "$button_color";?> btn-pill  mb-1' id="show-bill" data-customer_order_id='<?php echo $his_row['customer_order_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສະແດງ</a>



                </div>

        <?php

            }
        }


        ?>

</div>