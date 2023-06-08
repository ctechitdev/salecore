<?php

include("../setting/conn.php");

include("../service/warehouse_system/setting/connect_warehouse_system.php");

?>

<div class="content-wrapper">
    <div class="content">
        <div class="email-wrapper rounded border bg-white">
            <div class="row no-gutters justify-content-center">

                <div class="col-xxl-12">
                    <div class="email-right-column  email-body p-4 p-xl-5">
                        <div class="email-body-head mb-5 ">
                            <h4 class="text-dark">ສ້າງສາງອອນລາຍ </h4>



                        </div>


                        <form method="post" id="addwhfrm">

                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">ຊື່ສາງ</label>
                                        <input type="text" class="form-control" id="wh_name" name="wh_name">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">ໂຄດສາງ</label>
                                        <input type="text" class="form-control" id="wh_code" name="wh_code">
                                    </div>
                                </div>

                                <div class="form-group  col-lg-4">
                                    <label class="text-dark font-weight-medium">ພະແນກ</label>
                                    <div class="form-group">
                                        <select class=" form-control font" name="com_id" id="com_id">
                                            <option value=""> ເລືອກພະແນກ </option>
                                            <?php
                                            $stmt = $conn->prepare(" SELECT icc_id,concat('(',sale_tax_code,') ',name_company) as name_company FROM tbl_item_company_code order by name_company");
                                            $stmt->execute();
                                            if ($stmt->rowCount() > 0) {
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?> <option value="<?php echo $row['icc_id']; ?>"> <?php echo $row['name_company']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  col-lg-4">
                                    <label class="text-dark font-weight-medium">ແຂວງ</label>
                                    <div class="form-group">
                                        <select class=" form-control font" name="pv_id" id="pv_id">
                                            <option value=""> ເລືອກແຂວງ </option>
                                            <?php
                                            $stmt = $conn->prepare(" SELECT pv_id,pv_name FROM tbl_provinces order by pv_name");
                                            $stmt->execute();
                                            if ($stmt->rowCount() > 0) {
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?> <option value="<?php echo $row['pv_name']; ?>"> <?php echo $row['pv_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group col-lg-4">
                                    <label class="text-dark font-weight-medium">ເມືອງ</label>
                                    <div class="form-group">

                                        <select class="form-control  font" name="dis_id" id="dis_id">
                                            <option value=""> ເລືອກເມືອງ </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">ບ້ານ</label>
                                        <input type="text" class="form-control" id="village" name="village">
                                    </div>
                                </div>




                            </div>


                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພິ່ມຂໍ້ມູນ</button>
                            </div>

                        </form>


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