<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_post_id = $_POST['item_post_id'];

?>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<form id="add-cart" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php
            $row_item = $conn->query("SELECT * FROM tbl_item_post_customer where item_post_customer_id = '$item_post_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="item_post_id" value='<?php echo "$item_post_id"; ?>'>
          

            <div class="col-md-5">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">

                            <?php

                            if ($row_item['item_post_pic'] == "") {
                            ?>
                                <img src="../images/ic_launcher.png" alt="user image" width="70%" />
                            <?php
                            } else {
                            ?>
                                <img src='../images/item_post/<?php echo $row_item['item_post_pic']; ?>' width="70%" alt="user image" />

                            <?php
                            }

                            ?>
                        </div>



                    </div>


                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-info px-4">
                    <h4 class="mt-3 mb-3">ຂໍ້ມູນສິນຄ້າ</h4>
                    <div class="row">
                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium"><?php echo $row_item['item_name']; ?></label>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">ຫົວໜ່ວຍ: <?php echo $row_item['item_pack_sale']; ?></label>
                            </div>
                        </div>

                        <div class="form-group  col-lg-6">
                            <label class="text-dark font-weight-medium">ລາຄາຂາຍ: <?php echo number_format($row_item['item_price']); ?></label>
                        </div>


                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ຈຳນວນສັ່ງຊື້</label>
                            <div class="form-group">
                                <input type="number" name="item_value" autocomplete="off" class="form-control"   require />
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