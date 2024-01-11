
<?php
include("../../setting/checksession.php");
include("../../setting/conn.php");


?>


<div class="card-body" data-simplebar style="height: 580px;">


    <?php



    $stmt_his = $conn->prepare(" 
                                            select sale_id,buyer_lottery,sale_bill_number,  total_sale,currency_code
                                            from tbl_sale  
                                            where draw_number = '$last_draw' and add_by ='$id_users' and sale_status_id = '1'
                                            order by sale_id asc 
                                           ");
    ?>
    <tbody>
        <?php


        $total_his_sale_lak = 0;
        $total_his_sale_thb = 0;

        $stmt_his->execute();
        if ($stmt_his->rowCount() > 0) {
            while ($his_row = $stmt_his->fetch(PDO::FETCH_ASSOC)) {
        ?>



                <div class="media ">
                    <div class="media-body mt-1">
                        <span class="title"><b><?php echo  $his_row['sale_bill_number']; ?></b></span>
                    </div>
                    <div class="media-body mt-1">
                        <span class="title"><b><?php echo number_format($his_row['total_sale']) . " " . $his_row['currency_code']; ?></b></span>
                    </div>
                    <a href="javascript:0" class="btn btn-danger btn-pill  mb-1" id="editmodal" data-sale_id='<?php echo $his_row['sale_id']; ?>' data-toggle="modal" data-target="#modal-edit">ຍົກເລີກ</a>
                </div>

        <?php

                if ($his_row['currency_code'] == "LAK") {
                    $total_his_sale_lak += $his_row['total_sale'];
                } else {
                    $total_his_sale_thb += $his_row['total_sale'];
                }
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

            <span class="title"><?php echo number_format($total_his_sale_lak); ?> LAK </span>
            <span class="title"> <?php echo number_format($total_his_sale_thb); ?> THB</span>
        </div>
    </div>
</div>