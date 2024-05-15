<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ໂປຣໂມຊັ້ນ";
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
        var promotion_id = $(this).data("promotion_id");

        $.post('../function/modal/show-item-upload-promotion.php', {
                promotion_id: promotion_id
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


                                    <form id="add-promotion" method="post" enctype="multipart/form-data">

                                        <div class="row">
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



                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ໄຟຣໂປຣ</label>
                                                    <input type="file" class="form-control" name="excel" required value="">

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
                                        <th>ໂຄດໂປຣ</th>
                                        <th>ຈຳນວນລາຍການ</th>
                                        <th>ສະຖານະ</th>
                                        <th>ວັນທີເລິ່ມ</th>
                                        <th>ເຖິງວັນທີ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php



                                    $stmt4 = $conn->prepare(" select a.promotion_id,promotion_title,count(promotion_detail_id) as item_count,active_status_name,a.active_date,a.expire_date
                                    from tbl_promotion_detail a
                                    left join tbl_promotion b on a.promotion_id = b.promotion_id
                                    left join tbl_active_status c on b.active_status_id = c.active_status_id
                                     group by a.promotion_id,promotion_title,a.active_date,a.expire_date,active_status_name ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                            <tr>
                                                <td><?php echo $row4['promotion_id']; ?></td>
                                                <td><?php echo $row4['promotion_title']; ?></td>
                                                <td><?php echo number_format($row4['item_count']); ?></td>
                                                <td><?php echo $row4['active_status_name']; ?></td>
                                                <td><?php echo $row4['active_date']; ?></td>
                                                <td><?php echo $row4['expire_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-promotion_id='<?php echo $row4['promotion_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສະແດງ</a>
                                                            <a class="dropdown-item" type="button" id="delete_upload" data-promotion_id='<?php echo $row4['promotion_id']; ?>' class="btn btn-danger btn-sm">ລືບ</a>

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
        // ເພີ່ມຂໍ້ມູນ
        $("#add-promotion").on("submit", function(e) {
            e.preventDefault();
            Notiflix.Loading.hourglass();
            var formData = new FormData(this);
            $.ajax({
                url: "../query/add-upload-promotion.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#process').css('display', 'block');
                },
                success: function(dataResult) {
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == "success") {
                        Notiflix.Loading.remove();
                        document.getElementById("add-promotion").reset();
                        Notiflix.Notify.success('ອັຟໂຫລດລາຍການສຳເລັດ');

                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (dataResult.statusCode == "fail") {
                        Notiflix.Loading.remove();
                        Swal.fire(
                            'ບັນທືກບໍ່ສຳເລັດ',
                            'ບໍສາມາດອັຟໂຫລດໄດ້',
                            'error'
                        )
                    } else {
                        Notiflix.Loading.remove();
                        Swal.fire(
                            'ບັນທືກບໍ່ສຳເລັດ',
                            'ກາລູນາກວດສອບຂໍ້ມູນ',
                            'error'
                        )
                    }

                },
                error: function(xhr, resp, text) {

                    console.log(xhr, resp, text);
                }
            });
        });

        $(document).on("submit", "#update-modal", function() {
            $.post("../query/confirm-upload-promotion.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຢືນຢັນນຳໃຊ້ໂປຣໂມຊັ້ນສຳເລັດ',
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


        $(document).on("click", "#delete_upload", function(e) {
            e.preventDefault();
            var promotion_id = $(this).data("promotion_id");
            $.ajax({
                type: "post",
                url: "../query/delete-upload-promotion.php",
                dataType: "json",
                data: {
                    promotion_id: promotion_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);

                    } else if (data.res == "used") {
                        Swal.fire(
                            'ບໍ່ສາມາດລຶບໄດ້',
                            'ມີການກວດສອບແລະອານຸມັດແລ້ວ',
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