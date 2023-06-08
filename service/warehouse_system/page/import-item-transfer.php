<?php

include("../setting/conn.php");
include "../service/warehouse_system/setting/connect_warehouse_system.php";


?>

<div class="content-wrapper">
    <div class="content">
        <div class="email-wrapper rounded border bg-white">
            <div class="row no-gutters justify-content-center">

                <div class="col-xxl-12">
                    <div class="email-right-column  email-body p-4 p-xl-5">
                        <div class="email-body-head mb-5 ">
                            <h4 class="text-dark">ໂອນສິນຄ້າເຂົ້າສາງ </h4>



                        </div>


                        <form class="" action="" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="form-group  col-lg-4">
                                    <label class="text-dark font-weight-medium">ສາງ</label>
                                    <div class="form-group">
                                        <select class=" form-control font" name="wh_id" id="wh_id">
                                            <option value=""> ເລືອກສາງ </option>
                                            <?php
                                            $stmtv = $conn_warehouse->prepare(" SELECT * FROM tbl_warehouse  ");
                                            $stmtv->execute();
                                            if ($stmtv->rowCount() > 0) {
                                                while ($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)) {
                                            ?> <option value="<?php echo $rowv['wh_id']; ?>"> <?php echo $rowv['wh_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  col-lg-4">
                                    <label class="text-dark font-weight-medium">ພະນັກງານ</label>
                                    <div class="form-group">
                                        <select class=" form-control font" name="staff_code" id="staff_code">
                                            <option value=""> ເລືອກພະນັກງານ </option>
                                            <?php
                                            $stmtv = $conn->prepare(" SELECT staff_code, concat(staff_cp,' ',staff_name) as staff_name FROM tbl_staff_sale  ");
                                            $stmtv->execute();
                                            if ($stmtv->rowCount() > 0) {
                                                while ($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)) {
                                            ?> <option value="<?php echo $rowv['staff_code']; ?>"> <?php echo $rowv['staff_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">ເລກທີເອກະສານ</label>
                                        <input type="text" class="form-control" id="doc_code" name="doc_code">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">ໄຟຣຂໍ້ມູນ</label> <br>
                                        <input type="file" name="excel" required value="">
                                    </div>
                                </div>


                            </div>


                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" name="import" class="btn btn-primary mb-2 btn-pill">ອັຟໂຫລດ</button>
                            </div>

                        </form>
                        <?php
                        if (isset($_POST["import"])) {
                            $wh_id = $_POST['wh_id'];
                            $staff_code = $_POST['staff_code'];
                            $doc_code = $_POST['doc_code'];
                            

                             
                                $insert_bill = $conn_warehouse->query(" INSERT INTO tbl_transfer_bill ( wh_id,request_by,doc_number,date_upload,upload_by) 
                                VALUES(  '$item_code', '$item_values',  '$wh_id','$id_users',now(),now()) ");
                           


                            $fileName = $_FILES["excel"]["name"];
                            $fileExtension = explode('.', $fileName);
                            $fileExtension = strtolower(end($fileExtension));
                            $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

                            $targetDirectory = "../excelReader/" . $newFileName;
                            move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

                            error_reporting(0);
                            ini_set('display_errors', 0);

                            require '../excelReader/excel_reader2.php';
                            require '../excelReader/SpreadsheetReader.php';

                            $reader = new SpreadsheetReader($targetDirectory);
                            foreach ($reader as $key => $row) {
                                $item_code = $row[3];
                                $item_values = $row[18];


                                if ($item_code != "") {
                                    $insert = $conn_warehouse->query(" INSERT INTO tbl_history_item_transaction ( item_code,item_values, wh_id,add_by,time_transaction ,date_register) 
                                    VALUES(  '$item_code', '$item_values',  '$wh_id','$id_users',now(),now()) ");
                                }
                            }

                            unlink($targetDirectory);

                            echo
                            "
			<script>
			alert('ອັຟໂຫລດຂໍ້ມູນສຳເລັດ');
			document.location.href = '';
			</script>
			";
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="content-wrapper">
    <div class="content">
        <!-- For Components documentaion -->



        <div class="card card-default">

            <div class="card-body">

                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>ເລກທີ</th>
                            <th>ຊື່ສາງ</th>
                            <th>ໂຄດສາງ</th>
                            <th>ແຂວງ</th>
                            <th>ເມືອງ</th>
                            <th>ບ້ານ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $stmt4 = $conn_warehouse->prepare("select * from tbl_warehouse ");
                        $stmt4->execute();
                        if ($stmt4->rowCount() > 0) {
                            while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                $wh_id = $row4['wh_id'];
                                $wh_name = $row4['wh_name'];
                                $wh_code = $row4['wh_code'];
                                $wh_province = $row4['wh_province'];
                                $wh_district = $row4['wh_district'];
                                $wh_village = $row4['wh_village'];

                        ?>



                                <tr>
                                    <td><?php echo "$wh_id"; ?></td>
                                    <td><?php echo "$wh_name"; ?></td>
                                    <td><?php echo "$wh_code"; ?></td>
                                    <td><?php echo "$wh_province"; ?></td>
                                    <td><?php echo "$wh_district"; ?></td>
                                    <td><?php echo "$wh_village"; ?></td>



                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="warehouse-online.php?wh_id=<?php echo "$wh_id"; ?>">ແກ້ໄຂ</a>
                                                <a class="dropdown-item" type="button" id="deletewarehouse" data-id='<?php echo $row4['wh_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
                                            </div>
                                        </div>
                                    </td>
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