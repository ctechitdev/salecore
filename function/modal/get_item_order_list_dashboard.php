<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_post_id = $_POST['item_post_id'];

?>



<form id="update-modal" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php
            $row_item = $conn->query("SELECT * FROM tbl_item_post_customer where item_post_customer_id = '$item_post_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>



            <div class="col-md-5">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">

                            <?php

                            if ($row_item['item_post_pic'] == "") {
                            ?>
                                <img src="../images/ic_launcher.png" alt="user image" width="100%" />
                            <?php
                            } else {
                            ?>
                                <img src='../images/item_post/<?php echo $row_item['item_post_pic']; ?>' width="100%" alt="user image" />

                            <?php
                            }

                            ?>

                        </div>



                    </div>


                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ປະຫວັດການເຄື່ອນໄຫວ</h4>

                    <table class="table table-borderless table-thead-border">
                        <thead>
                            <tr>
                                <th>ຊື່ຮ້ານ</th>
                                <th>ຈຳນວນສັ່ງ</th>
                                <th>ມູນຄ່າ</th>
                                <th>ວັນທີສັ່ງ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $stmt1 = $conn->prepare("select date_order,customer_name,sum(order_values) as order_values,sum(item_total_price) as item_total_price
                            from tbl_customer_order_detail a
                            left join tbl_customer_order b on a.customer_order_id = b.customer_order_id
                            left join tbl_customer_user c on b.order_by = c.customer_user_id
                            where item_post_id = '$item_post_id'
                            group by date_order,customer_name,a.customer_order_id
                            order by date_order desc   ");
                            $stmt1->execute();
                            if ($stmt1->rowCount() > 0) {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr>
                                        <td class="text-dark font-weight-bold"><?php echo $row1['customer_name']; ?></td>
                                        <td class="text-dark font-weight-bold"><?php echo number_format($row1['order_values']); ?></td>
                                        <td class="text-dark font-weight-bold"><?php echo number_format($row1['item_total_price']); ?></td>
                                        <td class="text-dark font-weight-bold"><?php echo $row1['date_order']; ?></td>
                                      
                                    </tr>
                            <?php
                                }
                            }
                            ?>




                        </tbody>

                    </table>

                     

                </div>


            </div>


        </div>
    </div>
</form>