<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$customer_order_id = $_POST['customer_order_id'];

?>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php

            $headrow = $conn->query("SELECT customer_order_bill,total_price,order_status,order_date,customer_order_status_name
            from tbl_customer_order a
            left join tbl_customer_order_status b on a.order_status = b.customer_order_status_id
            where customer_order_id = '$customer_order_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>


            <input type="hidden" name="customer_order_id" value='<?php echo "$customer_order_id"; ?>'>


            <div class="form-group col-lg-12 text-center  ">
                <label class="text-dark font-weight-medium h3">ເລກບິນ: <?php echo $headrow['customer_order_bill']; ?> </label><br>
                <label class="text-dark font-weight-medium h3">ສະຖານະ: <?php echo $headrow['customer_order_status_name']; ?> </label><br>
            </div>


            <div class="col-md-12">
                <div class="profile-content-left ">
                    <div class="card  ">

                        <div class="input-states">
                            <table class="table" id="tableEdit">
                                <thead>
                                    <tr>
                                        <th>ລຳດັບ</th>
                                        <th>ຊື່ສິນຄ້າ</th>
                                        <th>ຈຳນວນ</th>
                                        <th>ລາຄາຕໍ່ອັນ</th>
                                        <th>ລາຄາລວມ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $total_sale = 0;
                                    $arrayNumberEdit = 0;
                                    $i = 1;

                                    $detail = $conn->prepare("select item_name,order_values,item_price_unit,item_total_price
                                    from tbl_customer_order_detail
                                    where customer_order_id = '$customer_order_id'  ");
                                    $detail->execute();
                                    if ($detail->rowCount() > 0) {
                                        while ($detailrow = $detail->fetch(PDO::FETCH_ASSOC)) {


                                    ?>



                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $detailrow['item_name']; ?></td>
                                                <td><?php echo $detailrow['order_values']; ?></td>
                                                <td><?php echo number_format($detailrow['item_price_unit']); ?></td>
                                                <td><?php echo number_format($detailrow['item_total_price']); ?></td>
                                            </tr>


                                    <?php
                                            $total_sale += $detailrow['item_total_price'];
                                            $i++;
                                        }
                                    }
                                    ?>

                            </table>
                        </div>

                    </div>

                    <div class="form-group col-lg-12 text-right ">
                        <label class="text-dark font-weight-medium h3"> ລວມມູນຄ່າ: <?php echo number_format($headrow['total_price']); ?> </label><br>
                    </div>




                </div>
            </div>



        </div>



    </div>
    </div>
</form>