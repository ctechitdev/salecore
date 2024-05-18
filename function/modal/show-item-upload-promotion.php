<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$promotion_id = $_POST['promotion_id'];

?>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php

            $headrow = $conn->query("  SELECT * FROM tbl_promotion WHERE promotion_id = '$promotion_id'  ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="promotion_id" value='<?php echo "$promotion_id"; ?>'>

            <div class="form-group col-lg-12 text-center  ">
                <label class="text-dark font-weight-medium h3">ເລກບິນ: <?php echo $headrow['promotion_title']; ?> </label><br>
            </div>

            <div class="form-group col-lg-12 text-center  ">
                <label class="text-dark font-weight-medium h3">ວັນທີເລິ່ມ: <?php echo $headrow['active_date']; ?> </label>
                <label class="text-dark font-weight-medium h3">ເຖິງວັນທີ: <?php echo $headrow['expire_date']; ?> </label>
            </div>


            <div class="col-md-12">
                <div class="profile-content-left ">
                    <div class="card  ">

                        <div class="input-states">
                            <table class="table" id="tableEdit">
                                <thead>
                                    <tr>
                                        <th>ລຳດັບ</th>
                                        <th>ຊື້ສິນຄ້າ</th> 
                                        <th>ມູນຄ່າຊື້</th>
                                        <th>ສິນຄ້າໂປຣ</th>
                                        <th>ປະເພດໂປຣ</th>
                                        <th>ມູນຄ່າໂປຣ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $total_sale = 0;
                                    $arrayNumberEdit = 0;
                                    $i = 1;

                                    $detail = $conn->prepare("select concat( item_code_buy, ' ',b.item_name,' ',pack_type_name_buy ) as item_buy_name, 
                                    buy_values,
                                    concat(item_code_pro,' ',c.item_name, ' ', pack_type_name_pro) as item_pro_name,promotion_type_name,promotion_values
                                    from tbl_promotion_detail a
                                    left join tbl_item_code_list b on a.item_code_buy = b.full_code
                                    left join tbl_item_code_list c on a.item_code_pro = c.full_code
                                    left join tbl_promotion_type d on a.promotion_type_pro = d.promotion_type_id
                                    where  promotion_id = '$promotion_id' ");
                                    $detail->execute();
                                    if ($detail->rowCount() > 0) {
                                        while ($detailrow = $detail->fetch(PDO::FETCH_ASSOC)) {


                                    ?>



                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $detailrow['item_buy_name']; ?></td> 
                                                <td><?php echo $detailrow['buy_values']; ?></td>
                                                <td><?php echo $detailrow['item_pro_name']; ?></td>
                                                <td><?php echo $detailrow['promotion_type_name']; ?></td>
                                                <td><?php echo   number_format($detailrow['promotion_values']); ?></td>
                                            </tr>


                                    <?php

                                            $i++;
                                        }
                                    }
                                    ?>



                            </table>
                        </div>



                    </div>

                    <div class="card text-center px-0 border-0">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-pill">ຢືນຢັນ</button>
                        </div>
                    </div>



                </div>
            </div>



        </div>



    </div>
    </div>
</form>