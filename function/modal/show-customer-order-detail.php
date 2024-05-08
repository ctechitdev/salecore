<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$customer_order_id = $_POST['customer_order_id'];

?>


<form id="accept-order">
    <div class="modal-body ">
        <div class="row no-gutters">

            <input type="hidden" name="customer_order_id" value='<?php echo "$customer_order_id"; ?>'>

            <?php

            $headrow = $conn->query("
            select customer_order_id,customer_order_bill,order_date,recieve_order_date,order_status,customer_order_status_name,total_price
            from tbl_customer_order a
            left join tbl_customer_order_status b on a.order_status = b.customer_order_status_id
            where customer_order_id = '$customer_order_id' ")->fetch(PDO::FETCH_ASSOC);


            ?>

            <div class="form-group col-lg-12 text-center ">
                <label class="text-dark font-weight-medium h3"> ເລກບິນ: <?php echo $headrow['customer_order_bill']; ?> </label><br>
                <label class="text-dark font-weight-medium h3">ວັນທີສັ່ງ: <?php echo $headrow['order_date']; ?> </label><br>
                <label class="text-dark font-weight-medium mt-2 h3">(<?php echo $headrow['customer_order_status_name']; ?>)</label><br>
            </div>




            <div class="col-md-12">
                <div class="profile-content-left ">
                    <div class="card  ">

                        <div class="input-states">
                            <table class="table" id="tableEdit">
                                <thead>
                                    <tr>

                                        <th>ສິນຄ້າ</th>
                                        <th>ລາຄາຕໍ່ໜ່ວຍ</th>
                                        <th>ຈຳນວນສັ່ງ</th>
                                        <th>ລວມ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php



                                    $detail = $conn->prepare("select a.item_code,item_name,pack_type_name,sale_price,order_values,total_price_order
                                    from tbl_customer_order_detail a
                                    left join tbl_item_code_list b on a.item_code = b.full_code
                                    where customer_order_id ='" . $headrow['customer_order_id'] . "'
                                    ");
                                    $detail->execute();
                                    if ($detail->rowCount() > 0) {
                                        while ($detailrow = $detail->fetch(PDO::FETCH_ASSOC)) {



                                    ?>



                                            <tr>
                                                <td><b><?php echo $detailrow['item_name']; ?></td>
                                                <td><b><?php echo $detailrow['pack_type_name']; ?></td>
                                                <td><b><?php echo $detailrow['order_values']; ?></td>
                                                <td><b><?php echo number_format($detailrow['total_price_order']); ?></td>
                                            </tr>


                                    <?php

                                        }
                                    }
                                    ?>

                            </table>
                        </div>
                        <div class="form-group col-lg-12 text-right mt-4 ">
                            <label class="text-dark font-weight-medium h3"> ມູນຄ່າ: <?php echo number_format($headrow['total_price']); ?> </label><br>
                        </div>

                    </div>



                    <?php




                    if ($headrow['order_status'] == 1) {
                    ?>
                        <div class="card text-center px-0 border-0">


                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-pill">ຮັບອໍເດີ້</button>
                            </div>
                        </div>
                    <?php

                    }
                    ?>



                </div>
            </div>




        </div>
    </div>
</form>