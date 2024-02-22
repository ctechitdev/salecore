<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຈັດສະແດງສິນຄ້າ";
$header_click = "5";

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
<script type="text/javascript" src="../js/jquery.min.js"></script>

<script>
    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();
        var item_post_id = $(this).data("item_post_id");

        $.post('../function/modal/get_item_post_info.php', {
                item_post_id: item_post_id
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
                                        <h4 class="text-dark"> ຈັດການສິນຄ້າສະແດງ</h4>
                                        <?php

                                        //   echo "$date_view and $id_staff";
                                        ?>


                                    </div>

                                    <form id="addform" enctype="multipart/form-data">

                                        <div class="row">


                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="modal-body pt-0">
                                                                <div class="row no-gutters">




                                                                    <div class="col-md-5">
                                                                        <div class="profile-content-left px-4">
                                                                            <div class="card text-center px-0 border-0">
                                                                                <div class="card-img mx-auto">

                                                                                    <img src="../images/ic_launcher.png" alt="user image" width="77%" />
                                                                                    <input type="file" class="form-control mt-5" name="pic_item" id="pic_item" multiple>

                                                                                </div>



                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-7">
                                                                        <div class="contact-info px-4">
                                                                            <h4 class="mb-1">ຂໍ້ມູນສິນຄ້າ</h4>
                                                                            <div class="row">
                                                                                <div class="form-group  col-lg-12">
                                                                                    <label class="text-dark font-weight-medium">ຊື່ສິນຄ້າ</label>
                                                                                    <div class="form-group">
                                                                                        <select class=" form-control font" name="item_id">
                                                                                            <option value=""> ເລືອກສິນຄ້າ </option>

                                                                                            <?php


                                                                                            $stmt1 = $conn->prepare(" SELECT  icl_id,concat( item_name, ' (', full_code ,')' ) as item_name
                                                                                                    from tbl_item_code_list a
                                                                                                    left join tbl_staff_item_code b on a.com_code = b.icc_id
                                                                                                    where use_by = '$depart_id' and item_price > 0
                                                                                                    order by item_name");
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

                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label for="firstName">ຫົວໜ່ວຍ</label>
                                                                                        <select class="form-control" name="sale_unit">
                                                                                            <option value="">ຫົວໜ່ວຍ</option>
                                                                                            <?php
                                                                                            $stmt3 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name ");
                                                                                            $stmt3->execute();
                                                                                            if ($stmt3->rowCount() > 0) {
                                                                                                while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                                                                            ?> <option value="<?php echo $row3['cat_name']; ?>"> <?php echo $row3['cat_name']; ?></option>
                                                                                            <?php
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group  col-lg-12">
                                                                                    <label class="text-dark font-weight-medium">ລາຄາຂາຍ</label>
                                                                                    <div class="form-group">
                                                                                        <input type="number" name="item_price" autocomplete="off" class="form-control" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
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
                                        <th>ເລກທີ</th>
                                        <th>B1 Code</th>
                                        <th>ຊື່ສິນຄ້າ</th>
                                        <th>ຫົວໜ່ວຍ</th>
                                        <th>ລາຄາຂາຍ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນລົງທະບຽນ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $day_name = date('D');
                                    $stmt4 = $conn->prepare("SELECT item_post_customer_id, full_code,item_name,item_pack_sale,item_price,add_date,
                                    (case when item_status_sale = '1' then 'ເປີດຂາຍ' else 'ປິດຂາຍ' end) as item_status_sale 
                                    FROM tbl_item_post_customer WHERE add_by ='$id_users' ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                    ?>


                                            <tr>
                                                <td><?php echo  $row4['item_post_customer_id']; ?></td>
                                                <td><?php echo  $row4['full_code']; ?></td>
                                                <td><?php echo  $row4['item_name']; ?></td>
                                                <td><?php echo  $row4['item_pack_sale']; ?></td>
                                                <td><?php echo  number_format($row4['item_price']); ?></td>
                                                <td><?php echo  $row4['item_status_sale']; ?></td>
                                                <td><?php echo  $row4['add_date']; ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-item_post_id='<?php echo $row4['item_post_customer_id']; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="delete_item_post" data-item_post_id='<?php echo $row4['item_post_customer_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
        $('#addform').submit(function(e) {
            e.preventDefault();

            var form = new FormData($(this)[0]);
            $.ajax({
                url: "../query/add-item-post-customer.php",
                method: "POST",
                dataType: 'json',
                data: form,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ເພິ່ມຂໍ້ມູນສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (result.res == "exist") {
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



        // delete 
        $(document).on("click", "#delete_item_post", function(e) {
            e.preventDefault();
            var item_post_id = $(this).data("item_post_id");
            $.ajax({
                type: "post",
                url: "../query/delete-item-post.php",
                dataType: "json",
                data: {
                    item_post_id: item_post_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລືບສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (data.res == "exist") {
                        Swal.fire(
                            'ຜິດພາດ',
                            'ບໍ່ສາມາດລຶບຂໍ້ມູນໄດ້ເນື່ອງຈາກມີການນຳໃຊ້ຂໍ້ມູນແລ້ວ',
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


</body>

</html>