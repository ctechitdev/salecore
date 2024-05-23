<?php
include("../setting/checksession.php");
include("../setting/conn.php");


$header_name = "ໂປຣທ້າຍບິນ";
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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(document).on("click", "#edit-modal", function(e) {
        e.preventDefault();
        var billing_discount_id = $(this).data("billing_discount_id");

        $.post('../function/modal/billing-discount-edit.php', {
                billing_discount_id: billing_discount_id
            },
            function(output) {
                $('.show_data_edit').html(output).show();
            });
    });
</script>

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


                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ຈັດແພັກເກຈຫຼຸດລາຄາ</h4>



                                    </div>
                                    <form method="post" id="add-form">


                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class=" ">
                                                    <div class="card-title">

                                                    </div>
                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">


                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ຊື່ແພັກເກຈ</label>
                                                                            <input type="text" class="form-control" name="billing_discount_name" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ປະເພດຫຼຸດລາຄາ</label>
                                                                            <select class="form-control" name="promotion_type_id" required>
                                                                                <option value="">ເລືອກປະເພດຫຼຸດລາຄາ</option>
                                                                                <?php
                                                                                $stmt1 = $conn->prepare("select * from tbl_promotion_type  where promotion_type_id != 1");
                                                                                $stmt1->execute();
                                                                                if ($stmt1->rowCount() > 0) {
                                                                                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                                ?>
                                                                                        <option value="<?php echo $row1['promotion_type_id']; ?>"><?php echo $row1['promotion_type_name']; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group  col-lg-4">
                                                                        <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                                                                        <div class="form-group">
                                                                            <select class=" form-control font" name="item_group_code" id="item_group_code">
                                                                                <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>
                                                                                <?php
                                                                                $stmt2 = $conn->prepare(" 
																				select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
																				from tbl_item_company_code a
																				left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id' ");
                                                                                $stmt2->execute();
                                                                                if ($stmt2->rowCount() > 0) {
                                                                                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                                                ?> <option value="<?php echo $row2['icc_id']; ?>"> <?php echo $row2['item_group_code']; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ມູນຄ່າຊື້</label>
                                                                            <input type="number" class="form-control" name="billing_buy_values" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ມູນຄ່າຫຼຸດ</label>
                                                                            <input type="number" class="form-control" name="billing_discount_values" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ວັນທີ່ເລິ່ມ</label>
                                                                            <input type="date" class="form-control" name="active_date" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ວັນທີ່ສິ້ນສຸດ</label>
                                                                            <input type="date" class="form-control" name="expire_date" required>
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
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພິ່ມຂໍ້ມູນ</button>
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
                                        <th>ເລກລຳດັບ</th>
                                        <th>ຊື່ແພັກເກຈ</th>
                                        <th>ປະເພດຫຼຸດລາຄາ</th>
                                        <th>ມູນຄ່າຊື້</th>
                                        <th>ມູນຄ່າຫຼຸດ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີ່ເລິ່ມ</th>
                                        <th>ວັນທີ່ສິ້ນສຸດ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt4 = $conn->prepare("
                                    select billing_discount_id,billing_discount_name,promotion_type_name,billing_buy_values,billing_discount_values,
                                    active_status_name,active_date,expire_date,item_company_code_id
                                    from tbl_billing_discount a
                                    left join tbl_promotion_type b on a.promotion_type_id = b.promotion_type_id
                                    left join tbl_active_status c on a.active_status_id = c.active_status_id
                                    left join tbl_staff_item_code d on a.item_company_code_id = d.icc_id 
                                    where use_by = '$depart_id' ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {



                                    ?>

                                            <tr>
                                                <td><?php echo $row4['billing_discount_id']; ?></td>
                                                <td><?php echo $row4['billing_discount_name']; ?></td>
                                                <td><?php echo $row4['promotion_type_name']; ?></td>
                                                <td><?php echo number_format($row4['billing_buy_values']); ?></td>
                                                <td><?php echo number_format($row4['billing_discount_values']); ?></td>
                                                <td><?php echo $row4['active_status_name']; ?></td>
                                                <td><?php echo $row4['active_date']; ?></td>
                                                <td><?php echo $row4['expire_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                                                            <a href="javascript:0" class="dropdown-item" id="edit-modal" data-billing_discount_id='<?php echo  $row4['billing_discount_id']; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>


                                                            <a class="dropdown-item" type="button" id="deleteitem" data-billing_discount_id='<?php echo  $row4['billing_discount_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
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
        $(document).on("submit", "#add-form", function() {
            $.post("../query/add-billing-discount.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ມີແພັກເກຈແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພິ່ມຂໍ້ມູນສຳເລັດ',
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


        $(document).on("submit", "#update-modal", function() {
            $.post("../query/update-billing-discount.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ມີໂປໂມຊັ້ນນີ້ແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {

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
            }, 'json');

            return false;
        });

        $(document).on("click", "#deleteitem", function(e) {
            e.preventDefault();
            var billing_discount_id = $(this).data("billing_discount_id");
            $.ajax({
                type: "post",
                url: "../query/delete-billing-discount.php",
                dataType: "json",
                data: {
                    billing_discount_id: billing_discount_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (data.res == "used") {
                        Swal.fire(
                            'ບໍ່ສາມາດລຶບໄດ້',
                            'ຢູ່ໃນຊ່ວງນຳໃຊ້',
                            'error'
                        )
                    }

                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });
            return false;
        });
    </script>


    <!--  -->


</body>

</html>