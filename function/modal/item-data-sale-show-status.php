<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_list_id = $_POST['item_list_id'];

?>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php

            $headrow = $conn->query("SELECT full_code,item_name,item_price,show_staff_status_id,show_customer_status_id
            from tbl_item_code_list
            where icl_id = '$item_list_id' ")->fetch(PDO::FETCH_ASSOC);

            ?>
 

            <input type="hidden" name="item_list_id" value='<?php echo "$item_list_id"; ?>'>


            <div class="form-group col-lg-12 text-center  ">
                <label class="text-dark font-weight-medium h3">ໂຄດສິນຄ້າ <?php echo $headrow['full_code']; ?> </label><br>
            </div>


            <div class="form-group col-lg-12">
                <div class="row">

                    <div class="form-group  col-lg-6">
                        <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                        <div class="form-group">
                            <label class="text-dark font-weight-medium"><?php echo $headrow['item_name']; ?></label>
                        </div>
                    </div>

                    <div class="form-group  col-lg-2">
                        <label class="text-dark font-weight-medium">ລາຄາຂາຍ</label>
                        <div class="form-group">
                            <label class="text-dark font-weight-medium"><?php echo $headrow['item_price']; ?></label>
                        </div>
                    </div>

                    <div class="form-group  col-lg-2">
                        <label class="text-dark font-weight-medium">ຂາຍໂດຍເຊວ</label>
                        <div class="form-group">
                            <label class="switch switch-primary switch-pill form-control-label mr-2">
                                <input type="checkbox" class="switch-input form-check-input" name="staff_status" value="1" <?php if($headrow['show_staff_status_id'] == 1){ echo "checked";}?>>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>

                    </div>

                    <div class="form-group  col-lg-2">
                        <label class="text-dark font-weight-medium">ຊື້ໂດຍລູກຄ້າ</label>
                        <div class="form-group">
                            <label class="switch switch-primary switch-pill form-control-label mr-2">
                                <input type="checkbox" class="switch-input form-check-input" name="customer_status" value="1"  <?php if($headrow['show_customer_status_id'] == 1){ echo "checked";}?>>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>

                    </div>

                </div>

                <div class="card text-center border-0 ">


                    <div class="card-body">
                        <button type="submit" class="btn btn-primary  btn-pill">ແກ້ໄຂ</button>
                    </div>
                </div>

            </div>



        </div>



    </div>
    </div>
</form>