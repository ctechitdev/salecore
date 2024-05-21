<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຢ້ຽມຢາມລູກຄ້າ";
$header_click = "6";
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
                                    <form method="post">





                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ລະຫັດລູກຄ້າ</th>
                                                    <th>ຊື່ຮ້ານ</th>
                                                    <th>ເມືອງ</th>

                                                    <th>ບ້ານ</th>
                                                    <th>ເບີໂທ</th>
                                                    <th>ເວລາຢ້ຽມ</th>
                                                    <th>ເວລາອອກ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                //  echo "$depart_id";

                                                function weekOfMonth($date)
                                                {
                                                    //Get the first day of the month.
                                                    $firstOfMonth = strtotime(date("Y-m-01", $date));
                                                    //Apply above formula.
                                                    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
                                                }

                                                function weekOfYear($date)
                                                {
                                                    $weekOfYear = intval(date("W", $date));
                                                    if (date('n', $date) == "1" && $weekOfYear > 51) {
                                                        // It's the last week of the previos year.
                                                        return 0;
                                                    } else if (date('n', $date) == "12" && $weekOfYear == 1) {
                                                        // It's the first week of the next year.
                                                        return 53;
                                                    } else {
                                                        // It's a "normal" week.
                                                        return $weekOfYear;
                                                    }
                                                }

                                                $week_visit =  weekOfMonth(strtotime(date("Y-m-d")));


                                                // $week_visit =  weekOfMonth(strtotime(date("2023-06-30")));  



                                                $day_name = date('D');
                                                $month_now = date('m');
                                                $year_now = date('Y');

                                                //  echo "$week_visit / $day_name / $month_now / $year_now";

                                                $i = 1;

                                                if (($depart_id == 21) || ($depart_id == 18)) {

                                                    $stmt4 = $conn->prepare("
                                                    select vd_id,cus_code,c_shop_name,pv_name,distict_name,village_name,phone_number
                                                    from tbl_visit_dairy a
                                                    left join tbl_provinces b on a.provinces = b.pv_id
                                                    left join tbl_districts c on a.district = c.dis_id
                                                    where user_id = '$id_users' and day_visit = '$day_name'  ");
                                                } else {

                                                    if ($week_visit >= 5) {

                                                        $stmt4 = $conn->prepare("
                                                        call stp_check_visit_week_5('$day_name','$month_now','$year_now','$id_users')   ");
                                                    } else {


                                                        $stmt4 = $conn->prepare("
                                                    select vd_id,cus_code,c_shop_name,pv_name,distict_name,village_name,phone_number
                                                    from tbl_visit_dairy a
                                                    left join tbl_provinces b on a.provinces = b.pv_id
                                                    left join tbl_districts c on a.district = c.dis_id
                                                    where user_id = '$id_users' and day_visit = '$day_name' and week_visit ='$week_visit' ");
                                                    }
                                                }




                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {


                                                        $vd_id = $row4['vd_id'];
                                                        $c_code = $row4['cus_code'];
                                                        $c_shop_name = $row4['c_shop_name'];
                                                        $distict_name = $row4['distict_name'];
                                                        $village = $row4['village_name'];
                                                        $phone1 = $row4['phone_number'];

                                                        $sql = "SELECT time_check_in,time_check_out,vc_id
                                                        FROM tbl_visited_customer 
                                                        WHERE check_by = '$id_users' and  date_check =curdate() and cus_code ='$vd_id' ";

                                                        $result = $conn->prepare($sql);
                                                        $result->execute();
                                                        $row2 = $result->fetch(PDO::FETCH_ASSOC);


                                                        if (empty($row2['time_check_in'])) {
                                                            $time_check_in = "ລໍຖ້າຢ້ຽມຢາມ";
                                                        } else {
                                                            $time_check_in = $row2['time_check_in'];
                                                        }

                                                        if (empty($row2['time_check_out'])) {
                                                            $time_check_out = "ລໍຖ້າເຊັກອອກ";
                                                        } else {
                                                            $time_check_out = $row2['time_check_out'];
                                                        }

                                                        if (empty($row2['vc_id'])) {
                                                            $vc_id = "";
                                                        } else {
                                                            $vc_id = $row2['vc_id'];
                                                        }



                                                ?>



                                                        <tr>
                                                            <td><?php echo "$i"; ?></td>
                                                            <td><?php echo "$c_code"; ?></td>
                                                            <td><?php echo "$c_shop_name"; ?></td>
                                                            <td><?php echo "$distict_name"; ?></td>
                                                            <td><?php echo "$village"; ?></td>
                                                            <td><?php echo "$phone1"; ?></td>
                                                            <td><?php echo "$time_check_in"; ?></td>
                                                            <td><?php echo "$time_check_out"; ?></td>

                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="view-customer-latlong.php?vd_id=<?php echo "$vd_id"; ?>">ສະແດງຂໍ້ມູນ</a>
                                                                        <?php
                                                                        if ($vc_id != "") {
                                                                        ?>
                                                                            <a class="dropdown-item" type="button" id="delchecklocate" data-id='<?php echo $row2['vc_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກລາຍການ</a>

                                                                        <?php
                                                                        }

                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                <?php
                                                        $i++;
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

    <script>
        // Delete Customer
        $(document).on("click", "#delchecklocate", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-check-in-location.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ຍົກເລີກລາຍການຢ້ຽມຢາມສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'visit-customer-location.php';
                            }, 1000);

                    }
                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });



            return false;
        });
    </script>


</body>

</html>