<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຈັດການສິນຄ້າຂາຍ";
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
    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();

        var item_code = $(this).data("item_code");
        var pack_type_name = $(this).data("pack_type_name");

        $.post('../function/modal/get_item_info.php', {
                item_code: item_code,
                pack_type_name: pack_type_name
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
                    <!-- For Components documentaion -->


                    <div class="card card-default">


                        <div class="card-body">

                            <div class="email-body-head mb-5 ">
                                <h4 class="text-dark"> ຈັດການສິນຄ້າສະແດງ</h4>
                                <?php

                                //   echo "$date_view and $id_staff";
                                ?>


                            </div>

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>B1 Code</th>
                                        <th>ຊື່ສິນຄ້າ</th>
                                        <th>ຫົວໜ່ວຍ</th>
                                        <th>ລາຄາຂາຍ</th>
                                        <th>ກຸ່ມສິນຄ້າ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $stmt4 = $conn->prepare("select a.item_code, item_name,pack_type_name,sale_price,date_add,name_company
                                    from tbl_item_price_sale a
                                    left join tbl_item_code_list b on a.item_code = b.full_code 
                                    left join tbl_item_company_code c on b.com_code = c.icc_id
                                    left join tbl_staff_item_code d on b.com_code = d.icc_id
                                    where use_by = '$depart_id'
                                    order by item_name asc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                    ?>


                                            <tr>
                                                <td><?php echo  $i; ?></td>
                                                <td><?php echo  $row4['item_name']; ?></td>
                                                <td><?php echo  $row4['item_code']; ?></td>
                                                <td><?php echo  $row4['pack_type_name']; ?></td>
                                                <td><?php echo  number_format($row4['sale_price'], 2); ?></td>
                                                <td><?php echo  $row4['name_company']; ?></td>


                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="editmodal" data-item_code='<?php echo $row4['item_code']; ?>' data-pack_type_name='<?php echo $row4['pack_type_name']; ?>' data-toggle="modal" data-target="#modal-edit">ແກ້ໄຂ</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                    <?php

                                            $i++;
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