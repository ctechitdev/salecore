<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$promotion_promote_id = $_POST['promotion_promote_id'];

?>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<form id="update-form" enctype="multipart/form-data">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php
            $row_item = $conn->query(" select * from tbl_promotion_promote where promotion_promote_id = '$promotion_promote_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="promotion_promote_id" value='<?php echo "$promotion_promote_id"; ?>'>
            <input type="hidden" name="oldpic_profile" value='<?php echo $row_item['promotion_promote_picture']; ?>'>

            <div class="col-md-5">
                <div class="profile-content-left px-5">
                    <div class="card text-center px-0 border-0">
                        <div class="card-img mx-auto">

                            <?php

                            if ($row_item['promotion_promote_picture'] == "") {
                            ?>
                                <img src="../images/Kp-Logo.png" alt="user image" width="100%" />
                            <?php
                            } else {
                            ?>
                                <img src='../images/promotion_picture/<?php echo $row_item['promotion_promote_picture']; ?>' width="100%" alt="user image" />

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
                    <h4 class="mb-1">ຂໍ້ມູນໂປໂຫມດ</h4>
                    <div class="row">

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                            <div class="form-group">
                                <select class=" form-control font" name="item_company_code_id">
                                    <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>
                                    <?php
                                    $stmt1 = $conn->prepare(" 
																				select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
																				from tbl_item_company_code a
																				left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id' ");
                                    $stmt1->execute();
                                    if ($stmt1->rowCount() > 0) {
                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row1['icc_id']; ?>" <?php if ($row_item['item_company_code_id'] == $row1['icc_id']) {
                                                                                            echo "selected";
                                                                                        } ?>> <?php echo $row1['item_group_code']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="firstName">ວັນທີເລິ່ມ</label>
                                <input type="date" class="form-control" name="active_date" value='<?php echo $row_item['active_date']; ?>'>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="firstName">ເຖິງວັນທີ</label>
                                <input type="date" class="form-control" name="expire_date" value='<?php echo $row_item['expire_date']; ?>' required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                            <div class="form-group">
                                <select class=" form-control font" name="active_status_id">
                                    <option value=""> ເລືອກສະຖານະ </option>
                                    <?php
                                    $stmt2 = $conn->prepare("select * from tbl_active_status where active_status_id != '1' ");
                                    $stmt2->execute();
                                    if ($stmt2->rowCount() > 0) {
                                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                    ?> <option value="<?php echo $row2['active_status_id']; ?>" <?php if ($row_item['active_status_id'] == $row2['active_status_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $row2['active_status_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
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
            url: "../query/update-promote-promotion.php",
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