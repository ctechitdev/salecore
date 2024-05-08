<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$stock_bill_id = $_POST['stock_bill_id'];

?>



<form id="update-modal">
    <div class="modal-body pt-0">
        <div class="row no-gutters">


            <?php

            $headrow = $conn->query("  SELECT * FROM tbl_stock_bill WHERE stock_bill_id = '$stock_bill_id'  ")->fetch(PDO::FETCH_ASSOC);

            ?>

            <input type="hidden" name="stock_bill_id" value='<?php echo "$stock_bill_id"; ?>'>

            <div class="form-group col-lg-12 text-center  ">
                <label class="text-dark font-weight-medium h3">ເລກບິນ: <?php echo $headrow['stock_bill_number']; ?> </label><br>
            </div>


            <div class="col-md-12">
                <div class="profile-content-left ">
                    <div class="card  ">

                        <div class="input-states">
                            <table class="table" id="tableEdit">
                                <thead>
                                    <tr>
                                        <th>ລຳດັບ</th>
                                        <th>ລະຫັດສິນຄ້າ</th>
                                        <th>ຊື່ສິນຄ້າ</th>
                                        <th>ຫົວໜ່ວຍ</th>
                                        <th>ຈຳນວນ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $total_sale = 0;
                                    $arrayNumberEdit = 0;
                                    $i = 1;

                                    $detail = $conn->prepare("SELECT a.item_code,b.item_name,credit_value,pack_type_name
                                    FROM tbl_stock_bill_detail a
                                    left join tbl_item_code_list b on a.item_code = b.full_code
                                    WHERE stock_bill_id = '$stock_bill_id'   ");
                                    $detail->execute();
                                    if ($detail->rowCount() > 0) {
                                        while ($detailrow = $detail->fetch(PDO::FETCH_ASSOC)) {


                                    ?>



                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $detailrow['item_code']; ?></td>
                                                <td><?php echo $detailrow['item_name']; ?></td>
                                                <td><?php echo $detailrow['pack_type_name']; ?></td>
                                                <td><?php echo number_format($detailrow['credit_value']); ?></td>
                                            </tr>


                                    <?php
                                            $total_sale += $detailrow['credit_value'];
                                            $i++;
                                        }
                                    }
                                    ?>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td>ລວມ</td>
                                        <td><?php echo number_format($total_sale); ?></td>
                                    </tr>

                            </table>
                        </div>



                    </div>

                    <div class="card text-center px-0 border-0">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-pill">ຮັບອໍເດີ້</button>
                        </div>
                    </div>



                </div>
            </div>



        </div>



    </div>
    </div>
</form>