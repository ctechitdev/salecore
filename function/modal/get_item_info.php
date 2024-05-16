<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_code = $_POST['item_code'];
$pack_type_name = $_POST['pack_type_name'];

?>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<form id="update-form" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php
            $row_item = $conn->query("
            select a.item_code, item_name,pack_type_name,sale_price,date_add,name_company,item_picture 
            from tbl_item_price_sale a
            left join tbl_item_code_list b on a.item_code = b.full_code 
            left join tbl_item_company_code c on b.com_code = c.icc_id
            left join tbl_staff_item_code d on b.com_code = d.icc_id 
            where a.item_code = '$item_code' and  pack_type_name ='$pack_type_name' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="item_code" value='<?php echo "$item_code"; ?>'>
            <input type="hidden" name="pack_type_name" value='<?php echo "$pack_type_name"; ?>'>

            <input type="hidden" name="oldpic_profile" value='<?php echo $row_item['item_picture']; ?>'>


            <div class="col-md-5">
                <div class="profile-content-left px-5">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">

                            <?php

                            if ($row_item['item_picture'] == "") {
                            ?>
                                <img src="../images/Kp-Logo.png" alt="user image" width="100%" />
                            <?php
                            } else {
                            ?>
                                <img src='../images/product_picture/<?php echo $row_item['item_picture']; ?>' width="100%" alt="user image" />

                            <?php
                            }

                            ?>
                            <input type="file" class="form-control mt-5" name="profile_pic" id="profile_pic" multiple>
                        </div>

                        <div class="col-lg-12  mt-2 text-center">

                            <div class="form-group">
                                <div class="custom-control custom-checkbox checkbox-danger d-inline-block mr-3 mb-3">
                                    <input type="checkbox" class="custom-control-input" id="picture_status" name="picture_status">
                                    <label class="custom-control-label" for="picture_status">ຍົກເລີກຮູບພາບ</label>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-7">
                <div class="contact-info px-4">
                    <h4 class="mb-1">ຂໍ້ມູນສິນຄ້າ</h4>
                    <div class="row">

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                            <div class="form-group">
                                <label class="text-dark font-weight-medium"><?php echo $row_item['item_name']; ?></label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ລະຫັດສິນຄ້າ</label>
                            <div class="form-group">
                                <label class="text-dark font-weight-medium"><?php echo $row_item['item_code']; ?></label>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ກຸ່ມສິນຄ້າ</label>
                            <div class="form-group">
                                <label class="text-dark font-weight-medium"><?php echo $row_item['name_company']; ?></label>
                            </div>
                        </div>



                        <div class="form-group  col-lg-12">
                            <label class="text-dark font-weight-medium">ລາຄາຂາຍ</label>
                            <div class="form-group">
                                <input type="number" name="sale_price" autocomplete="off" class="form-control" value='<?php echo $row_item['sale_price'] ?>' required />
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
    $('#update-form').submit(function(e) {
        e.preventDefault();

        var form = new FormData($(this)[0]);
        $.ajax({
            url: "../query/update-item-sale-data.php",
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