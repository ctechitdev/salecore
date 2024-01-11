<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_post_id = $_POST['item_post_id'];

?>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<form id="update-modal" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php
            $row_item = $conn->query("SELECT * FROM tbl_item_post_customer where item_post_customer_id = '$item_post_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="item_post_id" value='<?php echo "$item_post_id"; ?>'>
            <input type="hidden" name="oldpic_profile" value='<?php echo $row_item['item_post_pic']; ?>'>


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
                            <input type="file" class="form-control mt-5" name="profile_pic" id="profile_pic" multiple>
                        </div>



                    </div>


                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ຂໍ້ມູນສິນຄ້າຈັດການສິນຄ້າສະແດງ</h4>
                    <div class="row">
                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                            <div class="form-group">
                                <select class=" form-control font" name="item_id">
                                    <option value=""> ເລືອກສິນຄ້າ </option>

                                    <?php


                                    $stmt1 = $conn->prepare(" SELECT  icl_id,concat( item_name, ' (', full_code ,')' ) as item_name
                                                                                                    from tbl_item_code_list a
                                                                                                    left join tbl_staff_item_code b on a.com_code = b.icc_id
                                                                                                    where use_by = '$depart_id' and item_price > 0
                                                                                                    order by item_name");
                                    $stmt1->execute();
                                    if ($stmt1->rowCount() > 0) {
                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row1['icl_id']; ?>" <?php if ($row_item['item_code_list_id'] == $row1['icl_id']) {
                                                                                            echo "selected";
                                                                                        } ?>> <?php echo $row1['item_name']; ?></option>
                                    <?php
                                        }
                                    }



                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="firstName">ຫົວໜ່ວຍ</label>
                                <select class="form-control" name="sale_unit">
                                    <option value="">ຫົວໜ່ວຍ</option>
                                    <?php
                                    $stmt3 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name ");
                                    $stmt3->execute();
                                    if ($stmt3->rowCount() > 0) {
                                        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row3['cat_name']; ?>" <?php if ($row_item['item_pack_sale'] == $row3['cat_name']) {
                                                                                            echo "selected";
                                                                                        } ?>> <?php echo $row3['cat_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>




                        <div class="form-group  col-lg-6">
                            <label class="text-dark font-weight-medium">ລາຄາຂາຍ</label>
                            <div class="form-group">
                                <input type="number" name="item_price" autocomplete="off" class="form-control" value='<?php echo $row_item['item_price'] ?>' require />
                            </div>
                        </div>
                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ສະຖານະ</label>
                            <div class="form-group">
                                <label class="switch switch-primary switch-pill form-control-label mr-2">
                                    <input type="checkbox" class="switch-input form-check-input" name="item_status_sale" value="1" <?php if ($row_item['item_status_sale'] == 1) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>

                        </div>


                        <div class="d-flex justify-content-end mt-6">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
                        </div>

                    </div>

                </div>


            </div>


        </div>
    </div>
</form>

<script>
    $('#update-modal').submit(function(e) {
        e.preventDefault();

        var form = new FormData($(this)[0]);
        $.ajax({
            url: "../query/update-item-post-customer.php",
            method: "POST",
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
                } else if (result.res == "exist") {
                    Swal.fire(
                        'ຜິດພາດ',
                        'ມີຊື່ນີ້ແລ້ວ',
                        'error'
                    )
                }
            },
            error: function(er) {}
        });
    });
</script>