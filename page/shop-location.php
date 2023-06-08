<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍການປັກໝຸດ";
$header_click = "1";


if (isset($_POST['btn_view'])) {


    $status_name = $_POST['st_name'];
} else {
    $status_name = 'ALL';
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

                                        <?php

                                        if ($role_id == 1) {
                                            $syntax = "where depart_id is not null ";
                                        } else {
                                            $syntax = "where depart_id ='$depart_id'";
                                        }
                                        ?>

                                        <div class="row">

                                            <div class="form-group  col-lg-12">
                                                <label class="text-dark font-weight-medium">ສະຖານະປັກໝຸດ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="st_name" id="st_name">
                                                        <option value=""> ເລືອກສະຖານະ </option>
                                                        <option value="ປັກໝຸດສຳເລັດ"> ປັກໝຸດແລ້ວ </option>
                                                        <option value="ລໍຖ້າປັກໝຸດ"> ລຳຖ້າ </option>
                                                    </select>
                                                </div>
                                            </div>




                                        </div>

                                        <div class="d-flex justify-content-end mt-6">

                                            <button type="submit" name="btn_view" class="btn btn-primary mb-2 btn-pill"> ສະແດງລາຍງານ </button>
                                        </div>


                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ລະຫັດລູກຄ້າ</th>
                                                    <th>ຊື່ຮ້ານ</th>
                                                    <th>ຊື່ລູກຄ້າ</th>
                                                    <th>ເມືອງ</th>
                                                    <th>ບ້ານ</th>
                                                    <th>ສະຖານະທີ່ຕັ້ງຮ້ານ</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $i = 1;
                                                $stmt4 = $conn->prepare("  
                                                SELECT c_code,c_shop_name,c_name,distict_name,village,
                                                (case when scl_id is null then 'ລໍຖ້າປັກໝຸດ' else 'ປັກໝຸດສຳເລັດ' end) as location_status
                                                FROM tbl_customer a  
                                                left join tbl_districts b on a.district = b.dis_id
                                                left join tbl_staff_sale c on a.staff_contact = c.staff_code
                                                left join tbl_shop_customer_location d on a.c_code = d.cus_code
                                                left join tbl_user_staff e on c.user_ids = e.usid
												$syntax  and (case when scl_id is null then 'ລໍຖ້າປັກໝຸດ' else 'ປັກໝຸດສຳເລັດ' end) like '%$status_name%'
												order by c_id DESC ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {



                                                        $c_code = $row4['c_code'];
                                                        $c_shop_name = $row4['c_shop_name'];
                                                        $c_name = $row4['c_name'];
                                                        $distict_name = $row4['distict_name'];
                                                        $village = $row4['village'];
                                                        $location_status = $row4['location_status'];


                                                ?>

                                                        <tr>
                                                            <td><?php echo "$i"; ?></td>
                                                            <td><?php echo "$c_code"; ?></td>
                                                            <td><?php echo "$c_shop_name"; ?></td>
                                                            <td><?php echo "$c_name"; ?></td>
                                                            <td><?php echo "$distict_name"; ?></td>
                                                            <td><?php echo "$village"; ?></td>
                                                            <td><?php echo "$location_status"; ?></td>



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



    <!--  -->


</body>

</html>