<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຕິດຕາມອໍເດີ້";
$header_click = "5";

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
                                    select staff_name,sbo_number,a.sbo_id,c_shop_name,c.cus_code,vd_id,count(item_name) as item_group,a.date_register,sbo_price,
                                    (case when sbo_b1_status = 1 then 'ອອກບິນແລ້ວ' else 'ລໍຖ້າອອກບິນ' end) as sbo_b1_status
                                    from tbl_shell_bill_order a
                                    left join tbl_shell_sale_order b on a.sbo_id = b.sbo_id
                                    left join tbl_visit_dairy c on a.cus_code = c.vd_id 
                                    left join tbl_staff_sale d on a.order_by = d.user_ids
                                    group by b.sbo_id ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                            $sbo_id = $row4['sbo_id'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $cus_code = $row4['cus_code'];
                                            $vd_id = $row4['vd_id'];
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
                                                            <a class="dropdown-item" href="shell_view_order_detail.php?order_id=<?php echo "$sbo_id"; ?>&&vd_id=<?php echo "$vd_id"; ?>">ສະແດງຂໍ້ມູນ</a>


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
                } else if (data.res == "successout") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ອອກຈາກຮ້ານສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
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

                        '<div class="col-lg-6">' +
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



                        '<div class="form-group  col-lg-3">' +
                        '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                        '<div class="form-group">' +
                        '<input type="number" name="item_value[]" id="item_value' + count + '" autocomplete="off" class="form-control" />' +
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