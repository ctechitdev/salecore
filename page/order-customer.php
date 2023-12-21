<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ສັ່ງສິນຄ້າ";
$header_click = "2";



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

<script>
    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();
        var customer_order_id = $(this).data("customer_order_id");

        $.post('../function/modal/customer-bill-order-detial.php', {
                customer_order_id: customer_order_id
            },
            function(output) {
                $('.show_data_edit').html(output).show();
            });
    });
</script>

<body class="navbar-fixed sidebar-fixed">




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





                                    <form method="post" id="order-from">

                                        <div class="row">


                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">

                                                            <table class="table" id="productTable">

                                                                <tbody>
                                                                    <?php
                                                                    $arrayNumber = 0;
                                                                    for ($x = 1; $x < 2; $x++) { ?>

                                                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

                                                                            <td>

                                                                                <div class="form-group "> <?php echo "ລາຍການທີ: $x"; ?> <br>
                                                                                    <div class="row p-2">
                                                                                        <div class="form-group  col-lg-6">
                                                                                            <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                                                                                            <div class="form-group">
                                                                                                <select class=" form-control font" name="item_id[]" id="item_id<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກສິນຄ້າ </option>

                                                                                                    <?php


                                                                                                    $stmt1 = $conn->prepare(" 
                                                                                                    select icl_id, concat(item_name, ' ລາຄາ ', item_price) as item_name
                                                                                                    from tbl_customer_product_used a
                                                                                                    left join tbl_item_code_list b on a.item_company_code_id = b.com_code
                                                                                                    where customer_user_id = '$id_users' and show_customer_status_id ='1'
                                                                                                     order by item_name  ");
                                                                                                    $stmt1->execute();
                                                                                                    if ($stmt1->rowCount() > 0) {
                                                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                    ?> <option value="<?php echo $row1['icl_id']; ?>"> <?php echo $row1['item_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }



                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="form-group  col-lg-3">
                                                                                            <label class="text-dark font-weight-medium">ຈຳນວນ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="number" name="item_value[]" id="item_value<?php echo $x; ?>" autocomplete="off" class="form-control" />
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
                                        <th>ເລກທີສັ່ງ</th>
                                        <th>ເລກບິນ</th>
                                        <th>ມູນຄ່າ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີ່ສັ່ງ</th>
                                        <th>ວັນທີ່ຮັບ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $stmt4 = $conn->prepare("select customer_order_id,customer_order_bill,total_price,customer_order_status_name,order_date,recieve_order_date
                                    from tbl_customer_order a
                                    left join tbl_customer_order_status b on a.order_status = b.customer_order_status_id
                                    where order_by = '$id_users' 
                                    order by customer_order_id desc
									");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                            <tr>
                                                <td><?php echo $row4['customer_order_id']; ?></td>
                                                <td><?php echo $row4['customer_order_bill']; ?></td>
                                                <td><?php echo number_format($row4['total_price'], 4); ?></td>
                                                <td><?php echo $row4['customer_order_status_name']; ?></td>
                                                <td><?php echo $row4['order_date']; ?></td>
                                                <td><?php echo $row4['recieve_order_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-customer_order_id='<?php echo $row4['customer_order_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສະແດງ</a>

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
                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header justify-content-end border-bottom-0">


                                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>

                                <div class="show_data_edit">



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
        $(document).on("submit", "#order-from", function() {
            $.post("../query/add-customer-order.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂສຳເລັດ',
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
            $.post("../query/add-customer-order.php", $(this).serialize(), function(data) {
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
                url: '../query/dropdown/get_item_list_customer.php',
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


                        '<select class="form-control" name="item_id[]" id="item_id' + count + '" >' +
                        '<option value="">ເລືອກສິນຄ້າ</option>';
                    $.each(response, function(index, value) {
                        tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
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