<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$item_code = $_POST['item_code'];
$pack_type_name = $_POST['pack_type_name'];

?>





<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">

            <?php

            $headrow = $conn->query(" 
            select a.item_code,item_name,pack_type_name,sale_price
            from tbl_item_price_sale a
            left join tbl_item_code_list b on a.item_code = b.full_code 
            where a.item_code = '$item_code' and pack_type_name = '$pack_type_name' ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="item_code" value='<?php echo "$item_code"; ?>'>
            <input type="hidden" name="pack_type_name" value='<?php echo "$pack_type_name"; ?>'>

            <div class="form-group col-lg-12 text-center">
                <label class="text-dark font-weight-medium h3">ຊື່ສິນຄ້າ</label><br>
                <label class="text-dark font-weight-medium h3"><?php echo $headrow['item_name']; ?> (<?php echo $headrow['pack_type_name']; ?>)</label><br>
            </div>




            <div class="col-md-12">
                <div class="profile-content-left ">


                    <input type="hidden" class="form-control" name="item_detail_id[]" value="<?php echo $row1['item_detail_id']; ?>">

                    <div class="row text-center">



                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="firstName">ລາຄາຂາຍ</label>
                                <input type="number" step="any" class="form-control" name="sale_price" value="<?php echo $headrow['sale_price']; ?>">
                            </div>
                        </div>

                    </div>




                    <div class="card text-center px-0 border-0">


                        <div class="card-body">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ປ່ຽນລາຄາ</button>
                        </div>
                    </div>




                </div>
            </div>


        </div>
    </div>
</form>