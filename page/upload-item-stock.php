<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອັບໂຫລດເຄື່ອງເຂົ້າສາງ";
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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(function() {
        $('#company_id').change(function() {
            var company_id = $('#company_id').val();
            $.post('../function/dynamic_dropdown/get_depart.php', {
                    company_id: company_id
                },
                function(output) {
                    $('#depart_id').html(output).show();
                });
        });


    });


    $(function() {
        $('#depart_id').change(function() {
            var depart_id = $('#depart_id').val();
            $.post('../function/dynamic_dropdown/get_position.php', {
                    depart_id: depart_id
                },
                function(output) {
                    $('#position_id').html(output).show();
                });
        });


    });

    $(function() {
        $('#province_id').change(function() {
            var province_id = $('#province_id').val();
            $.post('../function/dynamic_dropdown/get_district.php', {
                    province_id: province_id
                },
                function(output) {
                    $('#districts_id').html(output).show();
                });
        });
    });


    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();
        var staff_id = $(this).data("staff_id");

        $.post('../function/modal/get_staff_info.php', {
                staff_id: staff_id
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
                                                    <label for="firstName">ໄຟຣໂອນ</label>
                                                    <input type="file" class="form-control" name="profile_pic" id="profile_pic" multiple>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card text-center px-0 border-0">


                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ອອກບິນ</button>
                                            </div>
                                        </div>




                                    </form>


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
                url: "../query/add-upload-item-stock.php",
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
                        Notiflix.Notify.success('ອອກບິນສຳເລັດ ລໍຖ້າໂຫຼດຄືນ');

                        setTimeout(
                            function() {
                                location.reload();
                            }, 1000);
                    } else if (dataResult.statusCode == "overstock") {
                        Notiflix.Loading.remove();
                        Swal.fire(
                            'ບັນທືກບໍ່ສຳເລັດ',
                            'ມີສິນຄ້າເບີກເກີນ',
                            'error'
                        )
                    } else if (dataResult.statusCode == "overpack") {
                        Notiflix.Loading.remove();
                        Swal.fire(
                            'ບັນທືກບໍ່ສຳເລັດ',
                            'ມີສິນຄ້າເກີນແພັກ',
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
    </script>


    <!--  -->


</body>

</html>