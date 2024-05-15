<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$billing_discount_id = $_POST['billing_discount_id'];


?>


<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <input type="hidden" name="billing_discount_id" value='<?php echo "$billing_discount_id"; ?>'>

            <?php

            $edit_row = $conn->query("select * from tbl_billing_discount where billing_discount_id = '$billing_discount_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="form-group col-lg-12 text-center mb-4">
                <label class="text-dark font-weight-medium h3"> ແກ້ໄຂຂໍ້ມູນ </label>
            </div>




            <div class="col-md-12">
                <div class="profile-content-left px-4">
                    <div class="card text-center px-0 border-0">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">ຊື່ແພັກເກຈ</label>
                                    <input type="text" class="form-control" name="billing_discount_name"  value="<?php echo $edit_row['billing_discount_name']?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">ປະເພດຫຼຸດລາຄາ</label>
                                    <select class="form-control" name="promotion_type_id" required>
                                        <option value="">ເລືອກປະເພດຫຼຸດລາຄາ</option>
                                        <?php
                                        $stmt1 = $conn->prepare("select * from tbl_promotion_type  where promotion_type_id != 1");
                                        $stmt1->execute();
                                        if ($stmt1->rowCount() > 0) {
                                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option value="<?php echo $row1['promotion_type_id']; ?>" <?php if ($edit_row['promotion_type_id'] == $row1['promotion_type_id']) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?php echo $row1['promotion_type_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  col-lg-4">
                                <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                                <div class="form-group">
                                    <select class=" form-control font" name="item_group_code" id="item_group_code">
                                        <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>
                                        <?php
                                        $stmt2 = $conn->prepare(" 
                                        select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
                                        from tbl_item_company_code a
                                        left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id' ");
                                        $stmt2->execute();
                                        if ($stmt2->rowCount() > 0) {
                                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        ?> <option value="<?php echo $row2['icc_id']; ?>" <?php if ($edit_row['item_company_code_id'] == $row2['icc_id']) {
                                                                                                echo "selected";
                                                                                            } ?>> <?php echo $row2['item_group_code']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="firstName">ມູນຄ່າຊື້</label>
                                    <input type="number" class="form-control" name="billing_buy_values" value="<?php echo $edit_row['billing_buy_values']?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="firstName">ມູນຄ່າຫຼຸດ</label>
                                    <input type="number" class="form-control" name="billing_discount_values" value="<?php echo $edit_row['billing_discount_values']?>" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">ວັນທີ່ເລິ່ມ</label>
                                    <input type="date" class="form-control" name="active_date" value="<?php echo $edit_row['active_date']?>" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">ວັນທີ່ສິ້ນສຸດ</label>
                                    <input type="date" class="form-control" name="expire_date" value="<?php echo $edit_row['expire_date']?>" required>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="firstName">ສະຖານະ</label>
                                    <select class="form-control" name="active_status_id" required>
                                        <option value="">ເລືອກສະຖານະ</option>
                                        <?php
                                        $stmt6 = $conn->prepare(" SELECT * from tbl_active_status where active_status_id != 1  ");
                                        $stmt6->execute();
                                        if ($stmt6->rowCount() > 0) {
                                            while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option value="<?php echo $row6['active_status_id']; ?>" <?php if ($edit_row['active_status_id'] == $row6['active_status_id']) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?php echo $row6['active_status_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="card text-center px-0 border-0">


                            <div class="card-body">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
                            </div>
                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>
</form>