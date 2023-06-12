<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຕິດຕາມອໍເດີ້";
$header_click = "5";

$vd_id = $_GET['vd_id'];
$bill_id = $_GET['order_id'];

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


                                    <?php




                                    $cusrows = $conn->query(" 
                                    select cus_code,c_shop_name,pv_name,distict_name,village_name,phone_number 
                                    from tbl_visit_dairy a
                                    left join tbl_provinces b on a.provinces = b.pv_id
                                    left join tbl_districts c on a.district = c.dis_id 
                                    where vd_id = '$vd_id'  ")->fetch(PDO::FETCH_ASSOC);

                                    $c_code = $cusrows['cus_code'];
                                    $c_shop_name = $cusrows['c_shop_name'];
                                    $provinces = $cusrows['pv_name'];
                                    $district = $cusrows['distict_name'];
                                    $village = $cusrows['village_name'];
                                    $phone1 = $cusrows['phone_number'];


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
                                                <h4> ເບີໂທຕິດຕໍ່: <?php echo "$phone1"; ?></h4>
                                            </div>
                                        </div>




                                    </div>



                                    <form method="post" id="confirmorder">

                                        <div class="row">

                                            <?php
                                            $billrows = $conn->query("select * from tbl_shell_bill_order where sbo_id = '$bill_id' ")->fetch(PDO::FETCH_ASSOC);
                                            $sbo_id = $billrows['sbo_id'];
                                            $sbo_number = $billrows['sbo_number'];
                                            $sbo_status = $billrows['sbo_status'];
                                            $sbo_type = $billrows['sbo_type'];
                                            $sbo_ccy = $billrows['sbo_ccy'];

                                            ?>

                                            <input type="hidden" class="form-control" name="cus_code_order" id="cus_code_order" value='<?php echo "$c_code" ?>' required>
                                            <input type="hidden" class="form-control" name="bill_id" id="bill_id" value='<?php echo "$bill_id" ?>' required>
                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <div class="col-lg-12 text-center mb-4">

                                                                        <label for="firstName">ເລກບິນ: <?php echo "123"; ?></label>

                                                                    </div>

                                                                    <div class="col-lg-4 text-center">

                                                                        <label for="firstName">ການຊຳລະ</label><br>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="pay" name="paytype" value="1" class="custom-control-input" disabled <?php if ($sbo_status == 1) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        } ?>>
                                                                            <label class="custom-control-label" for="pay">ຈ່າຍສົດ</label>
                                                                        </div>


                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="credit" name="paytype" value="2" class="custom-control-input" disabled <?php if ($sbo_status == 2) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                            <label class="custom-control-label" for="credit">ຄ້າງຊຳລະ</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 text-center">

                                                                        <label for="firstName">ປະເພດການຊຳລະ</label><br>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="cash" name="cashtype" value="1" class="custom-control-input" disabled <?php if ($sbo_type == 1) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                            <label class="custom-control-label" for="cash">ເງິນສົດ</label>
                                                                        </div>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="tran" name="cashtype" value="2" class="custom-control-input" disabled <?php if ($sbo_type == 2) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                            <label class="custom-control-label" for="tran">ເງິນໂອນ</label>
                                                                        </div>

                                                                    </div>



                                                                    <div class="form-group  col-lg-4">
                                                                        <label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
                                                                        <div class="form-group">

                                                                            <label class="text-dark font-weight-medium">
                                                                                <?php
                                                                                if ($sbo_ccy == "ccy") {
                                                                                    echo "ຕິດໜີ້";
                                                                                } else {
                                                                                    echo "$sbo_ccy";
                                                                                }

                                                                                ?>
                                                                            </label>

                                                                        </div>
                                                                    </div>




                                                                </div>
                                                            </div>




                                                            <table class="table" id="productTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:50%;">ຊື່ສິນຄ້າ</th>
                                                                        <th style="width:20%;">ຫົວໜ່ວຍ</th>
                                                                        <th style="width:10%;">ຈຳນວນ</th>
                                                                        <th style="width:20%;">ລາຄາ</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php
                                                                    $arrayNumber = 0;
                                                                    $total_sum = 0;

                                                                    $stmt3 = $conn->prepare(" SELECT * FROM tbl_shell_sale_order where sbo_id ='$bill_id' ");
                                                                    $stmt3->execute();
                                                                    $x = 1;
                                                                    if ($stmt3->rowCount() > 0) {
                                                                        while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

                                                                            $total_sum += $row3['item_total_price'];
                                                                    ?>

                                                                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">


                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="itemname[]" id="itemname<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_name']; ?>" readonly />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="sale_unit[]" id="sale_unit<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_cate_type']; ?>" readonly />
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="number" step="any" name="item_price[]" id="item_price<?php echo $x; ?>" value="<?php echo $row3['item_unit']; ?>" autocomplete="off" class="form-control" readonly />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <input type="number" step="any" name="item_price[]" id="item_price<?php echo $x; ?>" value="<?php echo $row3['item_total_price']; ?>" autocomplete="off" class="form-control" readonly />
                                                                                    </div>
                                                                                </td>


                                                                            </tr>





                                                                    <?php
                                                                            $arrayNumber++;
                                                                            $x++;
                                                                        }
                                                                    }
                                                                    ?>


                                                                </tbody>
                                                            </table>
                                                            <div class="d-flex justify-content-end mt-6">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <label for="firstName"> <?php echo "ລວມມູນຄ່າ: ";
                                                                                                echo number_format($total_sum);
                                                                                                echo " $sbo_ccy"; ?> </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-6">
                                                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ອອກບິນ</button>
                                                            </div>
                                                        </div>
                                                    </div>



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

                                        <th>ເລກບິນ</th>
                                        <th>ພະນັກງານຂາຍ</th>
                                        <th>ລະຫັດລູກຄ້າ</th>
                                        <th>ຊື່ຮ້ານ</th>
                                        <th>ລາຍການສິນຄ້າ</th>
                                        <th>ມູນຄ່າ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $day_name = date('D');
                                    $stmt4 = $conn->prepare(" 
                                    select staff_name,sbo_number,a.sbo_id,c_shop_name,cus_code,count(item_name) as item_group,a.date_register,sbo_price,
                                    (case when sbo_b1_status = 1 then 'ອອກບິນແລ້ວ' else 'ລໍຖ້າອອກບິນ' end) as sbo_b1_status
                                    from tbl_shell_bill_order a
                                    left join tbl_shell_sale_order b on a.sbo_id = b.sbo_id
                                    left join tbl_customer c on a.cus_code = c.c_code 
                                    left join tbl_staff_sale d on a.order_by = d.user_ids
                                    group by b.sbo_id  ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                            $sbo_id = $row4['sbo_id'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $cus_code = $row4['cus_code'];
                                            $item_group = $row4['item_group'];
                                            $date_register = $row4['date_register'];
                                            $sbo_number = $row4['sbo_number'];
                                            $staff_name = $row4['staff_name'];
                                            $sbo_price = $row4['sbo_price'];
                                            $sbo_b1_status = $row4['sbo_b1_status'];

                                    ?>

                                            <tr>

                                                <td><?php echo "$sbo_number"; ?></td>
                                                <td><?php echo "$staff_name"; ?></td>
                                                <td><?php echo "$cus_code"; ?></td>
                                                <td><?php echo "$c_shop_name"; ?></td>
                                                <td><?php echo "$item_group"; ?></td>
                                                <td><?php echo number_format($sbo_price); ?></td>
                                                <td><?php echo "$sbo_b1_status"; ?></td>
                                                <td><?php echo "$date_register"; ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="shell_view_order_detail.php?order_id=<?php echo "$sbo_id"; ?>&&cus_id=<?php echo "$cus_code"; ?>">ສະແດງຂໍ້ມູນ</a>


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
            <?php include "footer.php"; ?>
        </div>
    </div>

    <?php include("../setting/calljs.php"); ?>

    <script>
        // add order customer
        $(document).on("submit", "#confirmorder", function() {
            $.post("../query/confirm-shell-order.php", $(this).serialize(), function(data) {
                if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ຢືນຢັນອອກບິນສັ່ງຊື້ສຳເລັດ',
                        'success'
                    )

                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);

                }
            }, 'json');

            return false;
        });


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