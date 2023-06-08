<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຢ້ຽມຢາມລູກຄ້າ";
$header_click = "6";

$vd_id = $_GET['vd_id'];


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
                                    <form method="post" id="checkinfrm">

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

                                        <input type="hidden" class="form-control" name="vd_id" id="vd_id" value='<?php echo "$vd_id" ?>' required>

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

                                            <?php

                                            $sql = "SELECT time_check_in,time_check_out,vc_id,comment_talk
                                            FROM tbl_visited_customer 
                                            WHERE check_by = '$id_users' and  date_check = CURDATE() and cus_code ='$vd_id' ";

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

                                            if (empty($row2['comment_talk'])) {
                                                $comment_talk = "";
                                            } else {
                                                $comment_talk = $row2['comment_talk'];
                                            }


                                            ?>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> <?php echo "ເວລາເຂົ້າ: $time_check_in"; ?> </label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> <?php echo "ເວລາອອກ: $time_check_out"; ?> </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-12 text-center">

                                                <div>
                                                    <label for="firstName">ການຢ້ຽມຢາມ</label>
                                                </div>
                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="checkin" name="customRadio" value="in" class="custom-control-input">
                                                    <label class="custom-control-label" for="checkin">ເຂົ້າຢ້ຽມ</label>
                                                </div>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="checkout" name="customRadio" value="out" class="custom-control-input">
                                                    <label class="custom-control-label" for="checkout">ອອກຮ້ານ</label>
                                                </div>
                                            </div>



                                            <div class="col-lg-12 text-center">




                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">ຄຳເຫັນ</label>
                                                        <textarea class="form-control" id="comment_box" name="comment_box" rows="3"><?php echo "$comment_talk" ?></textarea>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button type="submit" name="btn_check_in" class="btn btn-success mb-2 btn-pill"> ເພີ່ມຂໍ້ມູນ </button>
                                                </div>

                                            </div>



                                        </div>



                                    </form>

                                    <form method="post" target="_blank">
                                        <div class="col-lg-12 text-center">
                                            <div class="form-group">

                                                <button type="submit" class="btn btn-primary btn-pill" formaction="http://115.84.91.75/VanSaleV2">ເປີດແວນເຊວ</button>
                                            </div>

                                        </div>

                                    </form>


                                    <form method="post" id="additemorder">

                                        <div class="row">

                                            <input type="hidden" class="form-control" name="cus_code_order" id="cus_code_order" value='<?php echo "$vd_id" ?>' required>

                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <div class="col-lg-4 text-center">

                                                                        <label for="firstName">ການຊຳລະ</label><br>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="pay" name="paytype" value="1" class="custom-control-input">
                                                                            <label class="custom-control-label" for="pay">ຈ່າຍສົດ</label>
                                                                        </div>


                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="credit" name="paytype" value="2" class="custom-control-input">
                                                                            <label class="custom-control-label" for="credit">ຄ້າງຊຳລະ</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4 text-center">

                                                                        <label for="firstName">ປະເພດການຊຳລະ</label><br>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="cash" name="cashtype" value="1" class="custom-control-input">
                                                                            <label class="custom-control-label" for="cash">ເງິນສົດ</label>
                                                                        </div>

                                                                        <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                            <input type="radio" id="tran" name="cashtype" value="2" class="custom-control-input">
                                                                            <label class="custom-control-label" for="tran">ເງິນໂອນ</label>
                                                                        </div>

                                                                    </div>



                                                                    <div class="form-group  col-lg-4">
                                                                        <label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
                                                                        <div class="form-group">
                                                                            <select class=" form-control font" name="ccy" id="ccy">
                                                                                <option value=""> ເລືອກສະກຸນເງິນ </option>
                                                                                <option value="kip"> KIP </option>
                                                                                <option value="thb"> THB </option>
                                                                                <option value="usd"> USD </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>




                                                                </div>
                                                            </div>
                                                            <table class="table" id="productTable">

                                                                <tbody>
                                                                    <?php
                                                                    $arrayNumber = 0;
                                                                    for ($x = 1; $x < 2; $x++) { ?>

                                                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

                                                                            <td>

                                                                                <div class="form-group "> <?php echo "ລາຍການທີ: $x"; ?> <br>
                                                                                    <div class="row p-2">
                                                                                        <div class="form-group  col-lg-5">
                                                                                            <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                                                                                            <div class="form-group">
                                                                                                <select class=" form-control font" name="item_name[]" id="item_name<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກສິນຄ້າ </option>

                                                                                                    <?php


                                                                                                    $stmt1 = $conn->prepare(" SELECT  icl_id,item_name 
                                                                                                    from tbl_item_code_list a
                                                                                                    left join tbl_staff_item_code b on a.com_code = b.icc_id
                                                                                                    where use_by = '$depart_id' and item_price > 0
                                                                                                    order by item_name");
                                                                                                    $stmt1->execute();
                                                                                                    if ($stmt1->rowCount() > 0) {
                                                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                    ?> <option value="<?php echo $row1['item_name']; ?>"> <?php echo $row1['item_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }



                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-2">
                                                                                            <label class="text-dark font-weight-medium">ຈຳນວນ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="number" name="item_value[]" id="item_value<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-2">
                                                                                            <label class="text-dark font-weight-medium">ລາຄາຂາຍ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="number" name="total_price[]" id="total_price<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                                            </div>
                                                                                        </div>




                                                                                        <div class="col-lg-3">
                                                                                            <div class="form-group p-6">
                                                                                                <button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading...">
                                                                                                    <i class="mdi mdi-briefcase-plus"></i>
                                                                                                </button>

                                                                                                <button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)">
                                                                                                    <i class="mdi mdi-briefcase-remove"></i>
                                                                                                </button>
                                                                                            </div>

                                                                                        </div>


                                                                                    </div>



                                                                                </div>


                                                                            </td>
                                                                        </tr>


                                                                    <?php
                                                                        $arrayNumber++;
                                                                    } // /for
                                                                    ?>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ສັ່ງສິນຄ້າ</button>
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
                                        <th>ລະຫັດລູກຄ້າ</th>
                                        <th>ຊື່ຮ້ານ</th>
                                        <th>ລາຍການສິນຄ້າ</th>
                                        <th>ຍອດສັ່ງ</th>
                                        <th>ສະກຸນເງິນ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີ</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $day_name = date('D');
                                    $stmt4 = $conn->prepare("
                                    select sbo_number,a.sbo_id,c_shop_name,c.cus_code,count(item_name) as item_group,a.date_register,sum(item_total_price) as item_total_price,
                                    sbo_ccy, (case when sbo_status = 1 then 'ເງິນສົດ' else 'ຕິດໜີ້' end ) sbo_status
                                    from tbl_shell_bill_order a
                                    left join tbl_shell_sale_order b on a.sbo_id = b.sbo_id 
                                    left join tbl_visit_dairy c on a.cus_code = c.vd_id  
                                    where a.order_by = '$id_users' and a.cus_code = '$vd_id'
                                    group by b.sbo_id    ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                            $sbo_id = $row4['sbo_id'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $cus_code = $row4['cus_code'];
                                            $item_group = $row4['item_group'];
                                            $date_register = $row4['date_register'];
                                            $sbo_number = $row4['sbo_number'];
                                            $item_total_price = $row4['item_total_price'];
                                            $sbo_ccy = $row4['sbo_ccy'];
                                            $sbo_status = $row4['sbo_status'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$sbo_number"; ?></td>
                                                <td><?php echo "$cus_code"; ?></td>
                                                <td><?php echo "$c_shop_name"; ?></td>
                                                <td><?php echo "$item_group"; ?></td>
                                                <td>
                                                    <?php
                                                    echo number_format($item_total_price);
                                                    ?>
                                                </td>
                                                <td><?php echo "$sbo_ccy"; ?></td>
                                                <td><?php echo "$sbo_status"; ?></td>
                                                <td><?php echo "$date_register"; ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-customer-latlong-order.php?order_id=<?php echo "$sbo_id"; ?>&&cus_id=<?php echo "$cus_code"; ?>">ສະແດງຂໍ້ມູນ</a>
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
        // check in out customer
        $(document).on("submit", "#checkinfrm", function() {
            $.post("../query/add-check-in-visit.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຢ້ຽມຢາມສຳເລັດ',
                        'success'
                    )

                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
                } else if (data.res == "already") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ມີການຢ້ຽມຢາມແລ້ວ',
                        'error'
                    )
                } else if (data.res == "NoType") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ເລືອກປະເພດຢ້ຽມຢາມ',
                        'error'
                    )
                } else if (data.res == "nocheckin") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ບໍ່ພົບຂໍ້ມູນເຂົ້າຢ້ຽມ',
                        'error'
                    )
                } else if (data.res == "successcomment") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ລົງຄຳເຫັນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1500);
                } else if (data.res == "successout") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ອອກຈາກຮ້ານສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1500);
                }
            }, 'json')
            return false;
        });

        // add order customer
        $(document).on("submit", "#additemorder", function() {
            $.post("../query/add-shell-sale-order.php", $(this).serialize(), function(data) {
                if (data.res == "novalue") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ລາຍການທີ' + data.list_value.toUpperCase() + 'ມີຂໍ້ມູນວ່າງ',
                        'error'
                    )
                } else if (data.res == "nopaytype") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາເລືອກການຊຳລະ',
                        'error'
                    )
                } else if (data.res == "nocashtype") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາເລືອກປະເພດການຊຳລະ',
                        'error'
                    )
                } else if (data.res == "noccy") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາເລືອກສະກຸນເງິນ',
                        'error'
                    )
                } else if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ອອກບິນສັ່ງຊື້ສຳເລັດ',
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

        function addRow() {
            $("#addRowBtn").button("loading");

            var tableLength = $("#productTable tbody tr").length;

            var tableRow;
            var arrayNumber;
            var count;

            if (tableLength > 0) {
                tableRow = $("#productTable tbody tr:last").attr('id');
                arrayNumber = $("#productTable tbody tr:last").attr('class');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }

            $.ajax({
                url: '../query/dropdown/dropdown_item_list.php',
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $("#addRowBtn").button("reset");



                    var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +


                        '<td>' +
                        '<div class="form-group">ລາຍການທີ: ' + count +
                        '<div class="row p-2">' +

                        '<div class="col-lg-5">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ຊື່ສິນຄ້າ</label>' +


                        '<select class="form-control" name="item_name[]" id="item_name' + count + '" >' +
                        '<option value="">ເລືອກສິນຄ້າ</option>';
                    $.each(response, function(index, value) {
                        tr += '<option value="' + value[0] + '">' + value[0] + '</option>';
                    });
                    tr += '</select>' +

                        '</div>' +
                        '</div>' +



                        '<div class="form-group  col-lg-2">' +
                        '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                        '<div class="form-group">' +
                        '<input type="number" name="item_value[]" id="item_value' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +

                        '<div class="form-group  col-lg-2">' +
                        '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                        '<div class="form-group">' +
                        '<input type="number" name="total_price[]" id="total_price' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +



                        '<div class="col-lg-3">' +

                        '<div class="form-group p-6">' +
                        '<button type="button" class="btn btn-primary btn-flat removeProductRowBtn"   onclick="addRow(' + count + ')"> <i class="mdi mdi-briefcase-plus"></i></button>' +

                        '<button type="button" class="btn btn-danger removeProductRowBtn ml-1" type="button" onclick="removeProductRow(' + count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +

                        '</div>' +
                        '</div>' +




                        '</div>' +
                        '</div>' +




                        '</td>' +


                        '</tr>';
                    if (tableLength > 0) {
                        $("#productTable tbody tr:last").after(tr);
                    } else {
                        $("#productTable tbody").append(tr);
                    }

                } // /success
            }); // get the product data

        } // /add row

        function removeProductRow(row = null) {
            if (row) {
                $("#row" + row).remove();


                subAmount();
            } else {
                alert('error! Refresh the page again');
            }
        }
    </script>



</body>

</html>