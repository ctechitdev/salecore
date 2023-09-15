<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພິນຜູ້ສະໜອງ";
$header_click = "1";
?>

<!DOCTYPE html>


<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />



    <?php

    include("../setting/callcss.php");

    ?>


    <script src="../plugins/nprogress/nprogress.js"></script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">

    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php

            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">



                            <div class="  col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <form method="post" target="_blank">


                                        <div class="form-footer  d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-pill" formaction="../pdf/print-vendor-pdf.php">ພິນຂໍ້ມູນລູກຄ້າ</button>
                                            <button type="submit" class="btn btn-success btn-pill" formaction="../export/export-customer-data.php">ດາວໂຫລດ</button>


                                        </div><br>




                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ເລກທີ</th>
                                                    <th>ລະຫັດຜູ້ສະໜອງ</th>
                                                    <th>ຊື່ຜູ້ສະໜອງ</th>
                                                    <th>ຊື່ຮ້ານ</th> 
                                                    <th>ກຸ່ມສິນຄ້າ</th>
                                                    <th>ວັນລົງທະບຽນ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php



                                                $stmt4 = $conn->prepare("SELECT vendor_id,a.vendor_code,vendor_name,vendor_shop_name,phone_office,register_date,acc_name
                                                FROM tbl_vendor a
                                                left join tbl_account_company b on a.acc_code = b.company_code
                                                where add_by = '$id_users'
                                                order by vendor_id desc    ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                                        $vendor_id = $row4['vendor_id'];
                                                        $vendor_code = $row4['vendor_code'];
                                                        $vendor_name = $row4['vendor_name'];
                                                        $vendor_shop_name = $row4['vendor_shop_name']; 
                                                        $acc_name = $row4['acc_name'];
                                                        $register_date = $row4['register_date'];

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$vendor_id"; ?></td>
                                                            <td><?php echo "$vendor_code"; ?></td>
                                                            <td><?php echo "$vendor_name"; ?></td>
                                                            <td><?php echo "$vendor_shop_name"; ?></td> 
                                                            <td><?php echo "$acc_name"; ?></td>
                                                            <td><?php echo "$register_date"; ?></td>



                                                            <td>
                                                                <div class="form-check d-inline-block mr-3 mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="<?php echo "$vendor_id"; ?>" name="check_box[]" id="check_box<?php echo "$vendor_id"; ?>">
                                                                    <label class="form-check-label" for="check_box<?php echo "$vendor_id"; ?>">

                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <?php include "footer.php"; ?>
        </div>
    </div>


    <?php include("../setting/calljs.php"); ?>



    <!--  -->


</body>

</html>