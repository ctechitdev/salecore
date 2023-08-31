<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປະເມິນຜູ້ສະໜອງ";
$header_click = "1";

$vendor_id = $_GET['vendor_id'];


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
                                        <h1 class="text-dark text-center"> ປະເມິນຜູ້ສະໜອງ</h1>
                                        <?php

                                        //   echo "$date_view and $id_staff";
                                        ?>


                                    </div>
                                    <form method="post" id="addform">



                                        <?php




                                        $cusrows = $conn->query(" 
                                        SELECT vendor_id,vendor_name,vendor_shop_name,acc_name
                                        FROM  tbl_vendor a
                                        left join tbl_account_company b on a.acc_code = b.company_code
                                        WHERE vendor_id ='$vendor_id' ")->fetch(PDO::FETCH_ASSOC);

                                        $vendor_id = $cusrows['vendor_id'];
                                        $vendor_name = $cusrows['vendor_name'];
                                        $vendor_shop_name = $cusrows['vendor_shop_name'];
                                        $acc_name = $cusrows['acc_name'];


                                        ?>

                                        <input type="hidden" class="form-control" name="vendor_id" id="vendor_id" value='<?php echo "$vendor_id" ?>' required>

                                        <div class="row text-center">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4>ຊື່ຜູ້ຂາຍ: <?php echo "$vendor_shop_name ($vendor_name)"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4>ປະເພດສິນຄ້າ: <?php echo "$acc_name"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ວັນທີ່ປະເມີນ </h4>
                                                    </label>
                                                    <h4> <?php echo date("d / m / Y"); ?> </h4>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ຊ່ວງປໃນການປະເມີນ </h4>
                                                    </label>
                                                    <input type="month" class="form-control" name="evaluated_month">
                                                </div>
                                            </div>

                                        </div>




                                        <div class="row">


                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <?php

                                                                    $i = 1;
                                                                    $stmt1 = $conn->prepare("SELECT * from tbl_evaluation_question ");
                                                                    $stmt1->execute();
                                                                    if ($stmt1->rowCount() > 0) {
                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>

                                                                            <input type="hidden" class="form-control" name="evaluation_question_id[]" value='<?php echo $row1['evaluation_question_id']; ?>' required>


                                                                            <div class="form-group  col-lg-7">
                                                                                <label class="text-dark font-weight-medium"><?php echo "$i. " . $row1['evaluation_question_title']; ?></label>
                                                                                <div class="form-group">
                                                                                    <label class="text-dark font-weight-medium"><?php echo $row1['evaluation_question_data']; ?></label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-5 text-center">

                                                                                <label for="firstName">ລະດັບຄະແນນ </label><br>

                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score1_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="1" class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score1_<?php echo "$i"; ?>'>1</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score2_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="2" class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score2_<?php echo "$i"; ?>'>2</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score3_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="3" class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score3_<?php echo "$i"; ?>'>3</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score4_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="4" class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score4_<?php echo "$i"; ?>'>4</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score5_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="5" class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score5_<?php echo "$i"; ?>'>5</label>
                                                                                </div>

                                                                            </div>



                                                                    <?php
                                                                            $i++;
                                                                        }
                                                                    }

                                                                    ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="firstName">
                                                                                <h4> ຂໍ້ສະເໜີແນະ </h4>
                                                                            </label>
                                                                            <textarea class="form-control" name="commend_from_evaluator"> </textarea>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຂໍ້ມູນ</button>
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
                                                            <a class="dropdown-item" href="edit-customer-latlong-order.php?order_id=<?php echo "$sbo_id"; ?>&&vd_id=<?php echo "$vd_id"; ?>">ສະແດງຂໍ້ມູນ</a>
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
        $(document).on("submit", "#addform", function() {
            $.post("../query/add-evaluate.php", $(this).serialize(), function(data) {
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
                } else if (data.res == "nocreditday") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາກວດສອບວັນຕິດໜີ້',
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

                        '<div class="col-lg-12">' +
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


                        '<div class="col-lg-3"> ' +
                        '<div class="form-group"> ' +
                        '<label for="firstName">ຫົວໜ່ວຍນ້ອຍ</label> ' +
                        '<select class="form-control" name="sale_unit[]" id="sale_unit' + count + '" >' +
                        '<option value="">ຫົວໜ່ວຍ</option> ' +
                        '<option value="Bottle">Bottle</option> ' +
                        '<option value="Case">Case</option> ' +
                        '<option value="Drum">Drum</option> ' +
                        '<option value="Ea">Ea</option> ' +
                        '<option value="KG">KG</option> ' +
                        '<option value="Pack">Pack</option> ' +
                        '<option value="Pail">Pail</option> ' +
                        '<option value="Pcs">Pcs</option> ' +
                        '<option value="Unit">Unit</option> ' +
                        '</select> ' +

                        '</div> ' +
                        '</div> ' +

                        '<div class="form-group  col-lg-3">' +
                        '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                        '<div class="form-group">' +
                        '<input type="number" name="item_value[]" id="item_value' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +

                        '<div class="form-group  col-lg-3">' +
                        '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                        '<div class="form-group">' +
                        '<input type="number" name="item_price[]" id="item_price' + count + '" autocomplete="off" class="form-control" />' +
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