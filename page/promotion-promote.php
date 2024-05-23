<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ໂປຣໂໝດໂປໂມຊັ້ນ";
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
    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();

        var promotion_promote_id = $(this).data("promotion_promote_id");


        $.post('../function/modal/get_promotion_promote.php', {
                promotion_promote_id: promotion_promote_id
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
                                    <div class="email-body-head text-center text-dark h2 mb-3"><?php echo "$header_name"; ?></div>


                                    <form id="add-form" method="post" enctype="multipart/form-data">



                                        <div class="row">

                                            <div class="form-group  col-lg-6">
                                                <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="item_group_code" id="item_group_code">
                                                        <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>
                                                        <?php
                                                        $stmt1 = $conn->prepare(" 
																				select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
																				from tbl_item_company_code a
																				left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id' ");
                                                        $stmt1->execute();
                                                        if ($stmt1->rowCount() > 0) {
                                                            while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row1['icc_id']; ?>"> <?php echo $row1['item_group_code']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">ຮູບພາບ</label>
                                                    <input type="file" class="form-control" name="profile_pic" id="profile_pic" required value="">

                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">ວັນທີເລິ່ມ</label>
                                                    <input type="date" class="form-control" name="active_date" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">ເຖິງວັນທີ</label>
                                                    <input type="date" class="form-control" name="expire_date" required>
                                                </div>
                                            </div>







                                        </div>
                                        <div class="card text-center px-0 border-0">


                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ອັບໂຫລດ</button>
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

                            <table id="productsTable3" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ກຸ່ມສິນຄ້າ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີເລິ່ມ</th>
                                        <th>ເຖິງວັນທີ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php



                                    $stmt4 = $conn->prepare(" 
                                    SELECT promotion_promote_id,name_company,d.active_status_name,active_date,expire_date
                                    FROM tbl_promotion_promote a
                                    left join tbl_staff_item_code b on a.item_company_code_id = b.icc_id
                                    left join tbl_item_company_code c on a.item_company_code_id = c.icc_id
                                    left join tbl_active_status d on a.active_status_id = d.active_status_id
                                    where use_by = '$depart_id' ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                            <tr>
                                                <td><?php echo $row4['promotion_promote_id']; ?></td>
                                                <td><?php echo $row4['name_company']; ?></td>
                                                <td><?php echo $row4['active_status_name']; ?></td>
                                                <td><?php echo $row4['active_date']; ?></td>
                                                <td><?php echo $row4['expire_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-promotion_promote_id='<?php echo $row4['promotion_promote_id']; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="delete_upload" data-promotion_promote_id='<?php echo $row4['promotion_promote_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
        $('#add-form').submit(function(e) {
            e.preventDefault();

            var form = new FormData($(this)[0]);
            $.ajax({
                url: "../query/add-promotion-promote.php",
                method: "POST",
                dataType: 'json',
                data: form,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ແກ້ໄຂສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (result.res == "nopic") {
                        Swal.fire(
                            'ຜິດພາດ',
                            'ມີຊື່ນີ້ແລ້ວ',
                            'error'
                        )
                    }
                },
                error: function(er) {}
            });
        });
    </script>

</body>

</html>