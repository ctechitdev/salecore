<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອອກບິນສິນຄ້າ";
$header_click = "5";

?>

<?php

if (empty($_GET['wh_id'])) {
    $page_status = "add";
} else {
    $page_status = "edit";

    $id_wh = $_GET['wh_id'];
}

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
    $(function() {



        $('#pv_id').change(function() {
            var pv_id = $('#pv_id').val();
            $.post('../function/dynamic_dropdown/get_district.php', {
                    pv_id: pv_id
                },
                function(output) {
                    $('#dis_id').html(output).show();
                });
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

            <?php
            include "../service/warehouse_system/setting/connect_warehouse_system.php";

            if ($conn_warehouse_system == true) {
                if ($page_status == "add") {
                    include "../service/warehouse_system/page/warehouse-data.php";
                } else {
                    include "../service/warehouse_system/page/edit-warehouse-data.php";
                }
            } else {

                include "../service/warehouse_system/page/maintenance-alert.php";
            }
            ?>






            <?php include "footer.php"; ?>
        </div>
    </div>
    <?php include("../setting/calljs.php"); ?>

    <script>
        $(document).on("submit", "#addwhfrm", function() {
            $.post("../service/warehouse_system/query/add-warehouse.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ລະຫັດສາງຖືກລົງທະບຽນແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພີ່ມຂໍ້ມູນສຳເລັດ',
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

        $(document).on("submit", "#editwhfrm", function() {
            $.post("../service/warehouse_system/query/edit-warehouse.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ລະຫັດສາງຖືກລົງທະບຽນແລ້ວ',
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
            }, 'json')
            return false;
        });

        $(document).on("click", "#deletewarehouse", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../service/warehouse_system/query/delete-warehouse.php",
                dataType: "json",
                data: {
                    id: id
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
                                window.location.href = 'warehouse-online.php';
                            }, 1000);

                    } else if (data.res == "used") {
                        Swal.fire(
                            'ນຳໃຊ້ແລ້ວ',
                            'ບໍ່ສາມາດລຶບໄດ້ເນື່ອງຈາກນຳໃຊ້ໄປແລ້ວ',
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