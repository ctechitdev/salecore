<?php

include("../setting/conn.php");





if (isset($_POST['btn_view'])) {

    $date_request_from = $_POST['date_request_from'];
    $request_date_from = str_replace('/', '-', $date_request_from);
    $date_view_from = date('Y-m-d', strtotime($request_date_from));

    $date_request_to = $_POST['date_request_to'];
    $request_date_to = str_replace('/', '-', $date_request_to);
    $date_view_to = date('Y-m-d', strtotime($request_date_to));
} else {
    $date_view_from = '';
    $date_view_to = '';
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


<body class=" ">

    <div class="email-wrapper rounded border bg-white text-center">
        <div class="row no-gutters justify-content-center">

            <div class="col-lg-12 col-xl-12 col-xxl-12">
                <div class="email-right-column  email-body p-4 p-xl-5">
                    <div class="email-body-head mb-5 ">



                        <div class="form-group  col-lg-12">
                            <img src="../images/Kp-Logo.png" width="10%" height="100%" alt="Mono">

                        </div>

                        <h4 class="text-dark"> Bridgestone Tyres</h4>

                        <h4 class="text-dark mt-5"> Export pjp data </h4>

                    </div>
                    <form method="post">


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName"> Date Start </label>
                                    <input type="date" class="form-control" id="date_request_from" name="date_request_from" value='<?php echo "$date_view_from"; ?>'>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName"> Date End </label>
                                    <input type="date" class="form-control" id="date_request_to" name="date_request_to" value='<?php echo "$date_view_to"; ?>'>
                                </div>
                            </div>



                        </div>

                        <div class="d-flex justify-content-end mt-6">

                            <button type="submit" name="btn_view" class="btn btn-primary mb-2 btn-pill"> View </button>
                            <button type="submit" class="btn btn-success  mb-2 btn-pill" formaction="export-pjp-data.php">Export</button>

                        </div>

                        <div class="card-body">
                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Entry time</th>
                                        <th>Sales person</th>
                                        <th>Check Entry</th>
                                        <th>Customer Name</th>
                                        <th>Entry Date</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $i = 1;

                                    $stmt4 = $conn->prepare(" call rptexportpjp('$date_view_from','$date_view_to'); ");
                                    $stmt4->execute();

                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                            $time_check_in = $row4['time_check_in'];
                                            $staff_name = $row4['staff_name'];
                                            $types = $row4['types'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $date_check = $row4['date_check'];


                                    ?>



                                            <tr>
                                                <td><?php echo "$i"; ?></td>
                                                <td><?php echo "$time_check_in"; ?></td>
                                                <td><?php echo "$staff_name"; ?></td>
                                                <td><?php echo "$types"; ?></td>
                                                <td><?php echo "$c_shop_name"; ?></td>
                                                <td><?php echo "$date_check"; ?></td>
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


	<?php include("../setting/calljs.php"); ?>




</body>

</html>