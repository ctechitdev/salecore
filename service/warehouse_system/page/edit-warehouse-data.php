<?php

include("../setting/conn.php");

include("../service/warehouse_system/setting/connect_warehouse_system.php");

$wh_id = $_GET['wh_id'];
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


                        <form method="post" id="editwhfrm">

                            <?php

                            $editrows = $conn_warehouse->query("SELECT  * FROM tbl_warehouse where wh_id = '$wh_id' ")->fetch(PDO::FETCH_ASSOC);
                            $wh_id = $editrows['wh_id'];
                            $wh_name = $editrows['wh_name'];
                            $wh_code = $editrows['wh_code'];
                            $wh_province = $editrows['wh_province'];
                            $wh_district = $editrows['wh_district'];
                            $wh_village = $editrows['wh_village'];


                            ?>

                            <div class="row">

                                <input type="hidden" class="form-control" id="wh_id" name="wh_id" value='<?php echo "$wh_id"; ?>'>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">ຊື່ສາງ</label>
                                        <input type="text" class="form-control" id="wh_name" name="wh_name" value='<?php echo "$wh_name"; ?>'>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">ໂຄດສາງ</label>
                                        <input type="text" class="form-control" id="wh_code" name="wh_code" value='<?php echo "$wh_code"; ?>'>
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
                                                    $pv_name = $row['pv_name']
                                            ?> <option value="<?php echo $row['pv_name']; ?>" <?php if ($wh_province == $row['pv_name']) {
                                                                                                    echo "selected";
                                                                                                } ?>> <?php echo $row['pv_name']; ?></option>
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
                                            <?php
                                            $stmt2 = $conn->prepare("
                                            SELECT dis_id,distict_name 
                                            FROM tbl_districts a
                                            left join tbl_provinces b on a.pv_id =b.pv_id
                                            where pv_name ='$wh_province'order by distict_name 
                                            
                                            ");
                                            $stmt2->execute();
                                            if ($stmt2->rowCount() > 0) {
                                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                            ?> <option value="<?php echo $row2['distict_name']; ?>" <?php if ($wh_district == $row2['distict_name']) {
                                                                                                        echo "selected";
                                                                                                    } ?>> <?php echo $row2['distict_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="firstName">ບ້ານ</label>
                                        <input type="text" class="form-control" id="village" name="village" value='<?php echo "$wh_village"; ?>'>
                                    </div>
                                </div>




                            </div>


                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
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