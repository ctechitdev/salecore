<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍງານປະເມີນຜູ້ສະໜອງ";
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
                                            <button type="submit" class="btn btn-primary btn-pill" formaction="../pdf/print-evaluate-vendor-pdf.php">ພິນຂໍ້ມູນລູກຄ້າ</button>
                                            <button type="submit" class="btn btn-success btn-pill" formaction="../export/export-customer-data.php">ດາວໂຫລດ</button>


                                        </div><br>




                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ເລກທີປະເມີນ</th>
                                                    <th>ລະຫັດຜູ້ສະໜອງ</th>
                                                    <th>ຊື່ຮ້ານ</th>
                                                    <th>ຊື່ລູກຄ້າ</th>
                                                    <th>ຄະແນນລວມ</th>
                                                    <th>ເດືອນປະເມີນ</th>
                                                    <th>ວັນທີປະເມີນ</th> 
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php



                                                $stmt4 = $conn->prepare("
                                                select  a.vendor_evaluated_id,sum(evaluation_multi_score) as total_score,vendor_code,vendor_shop_name,vendor_name,
                                                DATE_FORMAT(evaluated_month,'%m-%Y') as evaluated_month,evaluated_date
                                                from tbl_vendor_evaluated_detail a
                                                left join tbl_vendor_evaluated b on a.vendor_evaluated_id = b.vendor_evaluated_id
                                                left join tbl_vendor c on b.vendor_id = c.vendor_id
                                                group by a.vendor_evaluated_id,evaluated_month,vendor_code,vendor_shop_name,vendor_name,evaluated_date ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {


                                                        $vendor_evaluated_id = $row4['vendor_evaluated_id'];
                                                        $vendor_code = $row4['vendor_code'];
                                                        $vendor_shop_name = $row4['vendor_shop_name'];
                                                        $vendor_name = $row4['vendor_name'];
                                                        $evaluated_month = $row4['evaluated_month'];
                                                        $total_score = $row4['total_score'];
                                                        $evaluated_date = $row4['evaluated_date'];

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$vendor_evaluated_id"; ?></td>
                                                            <td><?php echo "$vendor_code"; ?></td>
                                                            <td><?php echo "$vendor_shop_name"; ?></td>
                                                            <td><?php echo "$vendor_name"; ?></td>
                                                            <td><?php echo "$total_score"; ?></td>
                                                            <td><?php echo "$evaluated_month"; ?></td>
                                                            <td><?php echo "$evaluated_date"; ?></td>


 
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