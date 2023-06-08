<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປັກໝຸດຮ້ານ";
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
                                    <form method="post">





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