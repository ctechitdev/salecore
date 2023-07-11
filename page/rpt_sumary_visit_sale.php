<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ສັງລວມຢ້ຽມຢາມ";
$header_click = "6";




if (isset($_POST['btn_view'])) {

    $date_request_from = $_POST['date_request_from'];
    $request_date_from = str_replace('/', '-', $date_request_from);
    $date_view_from = date('Y-m-d', strtotime($request_date_from));
    $month_view_from = date('m', strtotime($request_date_from));


    $date_request_to = $_POST['date_request_to'];
    $request_date_to = str_replace('/', '-', $date_request_to);
    $date_view_to = date('Y-m-d', strtotime($request_date_to));
    $month_view_to = date('m', strtotime($request_date_to));
} else {
    $date_view_from = date("Y-m-d");
    $date_view_to = date("Y-m-d");

    $month_view_from = date("m");
    $month_view_to = date("m");
}

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



</head>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


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



                            <div class="col-lg-12 col-xl-12 col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark"> ລາຍການຢ້ຽມຢາມ</h4>
                                        <?php

                                         echo "$date_view_from - $month_view_from and  $date_view_to - $month_view_to";
                                        ?>


                                    </div>
                                    <form method="post">


                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> ຈາກວັນທີ </label>
                                                    <input type="date" class="form-control" id="date_request_from" name="date_request_from" value='<?php echo "$date_view_from"; ?>'>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> ຫາວັນທີ </label>
                                                    <input type="date" class="form-control" id="date_request_to" name="date_request_to" value='<?php echo "$date_view_to"; ?>'>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="d-flex justify-content-end mt-6">

                                            <button type="submit" name="btn_view" class="btn btn-primary mb-2 btn-pill"> ສະແດງລາຍງານ </button>
                                            <button type="submit" class="btn btn-success  mb-2 btn-pill" formaction="../export/export-customer-visit-sale.php">ດາວໂຫລດ</button>

                                        </div>

                                        <div class="card-body">
                                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ລຳດັບ</th>
                                                        <th>ປະເພດ</th> 
                                                        <th>ຢ້ຽມຢາມ</th>
                                                        <th>ການຊື້</th>
                                                        <th>ຮ້ານເປີດໃໝ່</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $i = 1;
 

                                                    $stmt4 = $conn->prepare("call rpt_sumary_visit_sale_report('$date_view_from','$date_view_to','$month_view_from','$month_view_to') ");
                                                    $stmt4->execute();

                                                    if ($stmt4->rowCount() > 0) {
                                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                                            $customer_type = $row4['customer_type'];
                                                            $count_visit = $row4['count_visit'];
                                                            $count_buy = $row4['count_buy'];
                                                            $new_count = $row4['new_count']; 


                                                    ?>



                                                            <tr>
                                                                <td><?php echo "$i"; ?></td>
                                                                <td><?php echo "$customer_type"; ?></td>
                                                                <td><?php echo "$count_visit"; ?></td>
                                                                <td><?php echo "$count_buy"; ?></td>
                                                                <td><?php echo "$new_count"; ?></td> 
                                                            </tr>


                                                    <?php
                                                            $i++;
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
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


                    </div>


                </div>

            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include("../setting/calljs.php"); ?>



</body>

</html>