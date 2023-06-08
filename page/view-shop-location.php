<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປັກໝຸດຮ້ານ";
$header_click = "1";

$cus_id = $_GET['cus_id'];


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
<script type="text/javascript" src="../js/jquery.min.js"></script> <!-- jQuery -->



<body class="navbar-fixed sidebar-fixed" id="body" onload="getLocation()">




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

                                        //   echo "$date_view and $id_staff";
                                        ?>


                                    </div>
                                    <form method="post" id="lacationshopfrm">

                                        <input type="hidden" class="form-control" id="lat_data" name="lat_data">
                                        <input type="hidden" class="form-control" id="long_data" name="long_data">

                                        <script>
                                            var x = document.getElementById("lat_data").value;




                                            function getLocation() {
                                                navigator.geolocation.getCurrentPosition(showPosition);
                                            }

                                            function showPosition(position) {
                                                x.innerHTML = position.coords.latitude + " " + position.coords.longitude;


                                                document.getElementById("lat_data").value = position.coords.latitude;
                                                document.getElementById("long_data").value = position.coords.longitude;
                                            }
                                        </script>

                                        <?php




                                        $cusrows = $conn->query(" 
                                        SELECT c_code,c_shop_name,c_name, pv_name as provinces,
                                        distict_name as district,village,street,h_unit,h_number,phone1 
                                        FROM tbl_customer a
                                        left join tbl_provinces b on a.provinces = b.pv_id
                                        left join tbl_districts c on a.district = c.dis_id where c_code = '$cus_id' ")->fetch(PDO::FETCH_ASSOC);
                                        $c_code = $cusrows['c_code'];
                                        $c_shop_name = $cusrows['c_shop_name'];
                                        $c_name = $cusrows['c_name'];
                                        $provinces = $cusrows['provinces'];
                                        $district = $cusrows['district'];
                                        $village = $cusrows['village'];
                                        $street = $cusrows['street'];
                                        $h_unit = $cusrows['h_unit'];
                                        $h_number = $cusrows['h_number'];
                                        $phone1 = $cusrows['phone1'];


                                        ?>

                                        <input type="hidden" class="form-control" name="cus_code" id="cus_code" value='<?php echo "$c_code" ?>' required>

                                        <div class="row text-center">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h2><?php echo "$c_code"; ?></h2>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ຊື່ຮ້ານ: <?php echo "$c_shop_name"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ຊື່ລູກຄ້າ: <?php echo "$c_name"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> <?php echo "ຖະໜົນ: $street ບ້ານ:$village ເມືອງ: $district ແຂວງ:$provinces "; ?> </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> <?php echo "ເຮືອນເລກທີ: $h_number / ໜ່ວຍ: $h_unit "; ?> </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName"> <?php echo "ເບີໂທຕິດຕໍ່: $phone1"; ?> </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ຮູບພາບ</label>

                                                    <input type="file" accept="image/*;capture=camera" class="form-control" id="shop_pic" name="shop_pic" placeholder="ກົດເພືອເປີດກ້ອງ">
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit" name="btn_check_in" class="btn btn-success mb-2 btn-pill"> ເພີ່ມຂໍ້ມູນ </button>
                                                </div>

                                            </div>



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
                                        <th>ລຳດັບ</th>
                                        <th>ລະຫັດລູກຄ້າ</th>
                                        <th>ຊື່ຮ້ານ</th>
                                        <th>ຊື່ລູກຄ້າ</th>
                                        <th>ເບີໂທ</th>
                                        <th>ການປັກໝຸດ</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $i = 1;
                                    $day_name = date('D');
                                    $stmt4 = $conn->prepare(" SELECT c_code,c_shop_name,c_name,phone1,scl_id,
                                                (case when scl_id is null then 'ລໍຖ້າປັກໝຸດ' else 'ປັກໝຸດສຳເລັດ' end) as location_status
                                                FROM tbl_customer a  
                                                left join tbl_staff_sale c on a.staff_contact = c.staff_code
                                                left join tbl_shop_customer_location d on a.c_code = d.cus_code
                                                where user_ids = '$id_users' and (case when add_date is null then curdate() else add_date end) >= curdate()  ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                            $c_code = $row4['c_code'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $c_name = $row4['c_name'];
                                            $location_status = $row4['location_status'];
                                            $phone1 = $row4['phone1'];
                                            $scl_id = $row4['scl_id'];




                                    ?>



                                            <tr>
                                                <td><?php echo "$i"; ?></td>
                                                <td><?php echo "$c_code"; ?></td>
                                                <td><?php echo "$c_shop_name"; ?></td>
                                                <td><?php echo "$c_name"; ?></td>
                                                <td><?php echo "$phone1"; ?></td>
                                                <td><?php echo "$location_status"; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="view-shop-location.php?cus_id=<?php echo "$c_code"; ?>">ສະແດງຂໍ້ມູນ</a>

                                                            <?php
                                                            if ($scl_id) {
                                                            ?>
                                                                <a class="dropdown-item" type="button" id="delchecklocate" data-id='<?php echo $row4['scl_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກປັກໝຸດ</a>


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
                        </div>
                    </div>


                </div>

            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

	<?php include("../setting/calljs.php"); ?>

    <script>
        // add company 
        $(document).on("submit", "#lacationshopfrm", function() {


            $.ajax({
                url: "../query/add-shop-location.php",
                type: "POST",
                dataType: "json",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire("ສຳເລັດ", "ເພິ່ມຂໍ້ມູນສຳເລັດ", "success");



                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else if (data.res == "nopic") {
                        Swal.fire(
                            'ແຈ້ງເຕືອນ',
                            'ບໍ່ມີຮູບພາບຮ້ານ',
                            'error'
                        )

                    } else if (data.res == "successupdate") {
                        Swal.fire(
                            'ແຈ້ງເຕືອນ',
                            'ແກ້ໄຂສຳເລັດ',
                            'success'
                        )
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                },
            });

            return false;
        });


        $(document).on("click", "#delchecklocate", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-shop-location.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ຍົກເລີກປັກໝຸດສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
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