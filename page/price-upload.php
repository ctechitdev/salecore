<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັບໂຫລດລາຄາ";
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
        var stock_bill_id = $(this).data("stock_bill_id");

        $.post('../function/modal/show-item-upload-stock.php', {
                stock_bill_id: stock_bill_id
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
                                    <form id="add-bill" method="post" enctype="multipart/form-data">

 

                                        <div class="input-states">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ໄຟຣລາຄາ</label>
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
        $("#add-bill").on("submit", function(e) {
            e.preventDefault();
            Notiflix.Loading.hourglass();
            var formData = new FormData(this);
            $.ajax({
                url: "../query/upload-price-sale-online.php",
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
                        document.getElementById("add-bill").reset();
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
            $.post("../query/confirm-upload-item-stock.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຢືນຢັນຮັບເຂົ້າສາງສຳເລັດ',
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
            var stock_bill_id = $(this).data("stock_bill_id");
            $.ajax({
                type: "post",
                url: "../query/delete-upload-item-stock.php",
                dataType: "json",
                data: {
                    stock_bill_id: stock_bill_id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບສິດສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);

                    } else if (data.res == "used") {
                        Swal.fire(
                            'ບໍ່ສາມາດລຶບໄດ້',
                            'ມີການຢຶນຢັນຮັບໄປແລ້ວ',
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