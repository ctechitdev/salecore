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
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    //ສະແດງ cart ສິນຄ້າ
    $(document).on("click", "#cart-show", function(e) {
        e.preventDefault();

        $.post('../function/modal/show-cart-customer.php',
            function(output) {
                $('.show_item_detail').html(output).show();
            });
    });

    // ສະແດງລາຍການປະຫວັດບິນ
    $(document).on("click", "#bill-show", function(e) {
        e.preventDefault();

        $.post('../function/modal/show-order-customer.php',
            function(output) {
                $('.show_order_bill').html(output).show();
            });
    });

    // ສະແດງລາຍລະສິນຄ້າທີ່ຄິກ
    $(document).on("click", "#item-modal", function(e) {
        e.preventDefault();
        var item_code = $(this).data("item_code");
        var pack_type_name = $(this).data("pack_type_name");
        $.post('../function/modal/show-item-detail.php', {
                item_code: item_code,
                pack_type_name: pack_type_name
            },
            function(output) {
                $('.show_item_detail').html(output).show();
            });
    });

    //ສະແດງເນື້ອໃນປະຫວັດບິນ
    $(document).on("click", "#show-bill", function(e) {
        e.preventDefault();
        var customer_order_id = $(this).data("customer_order_id");

        $.post('../function/modal/show-order-bill-list.php', {
                customer_order_id: customer_order_id
            },
            function(output) {
                $('.show_item_detail').html(output).show();
            });
    });
</script>

<body class="navbar-fixed sidebar-fixed" id="body">

    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php include "header-sale-lottery.php"; ?>

            <div class="content-wrapper">
                <div class="content">





                    <div class="card-body  ">

                        <form action="" method="post">
                            <div class="input-group  ">
                                <input type="text" autocomplete="off" name="search_key" class="form-control" placeholder="ຄຳຄົ້ນຫາ..." />
                                <div class="input-group-append">
                                    <button type="submit" name="btn_search" class="btn btn-primary">ຄົ້ນຫາ</button>
                                </div>
                            </div>
                        </form>

                        <div class="row mt-2">

                            <?php

                            // echo "$depart_id";

                            if (isset($_POST['btn_search'])) {
                                $search_key = $_POST['search_key'];
                            } else {
                                $search_key = "";
                            }

                            $stmt = $conn->prepare(" call stp_show_item_data_remain('$search_key','$depart_id');");
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                    if ($row['remain'] != 0) {
                                        $remain = "ມີສິນຄ້າ";
                                        $remain_color = "blue";
                                    } else {
                                        $remain = "ສິນຄ້າໝົດ";
                                        $remain_color = "red";
                                    }


                            ?>
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card card-default p-4">

                                            <div class="media">

                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-2 text-dark"><?php echo $row['item_name']; ?> (<?php echo $row['pack_type_name']; ?> <?php echo $row['weight']; ?>)
                                                        <span style='color:#07ed4c'>
                                                            <?php
                                                            if ($row['promotion_status'] == 1) {
                                                                echo " (ມີໂປຣໂມຊັ້ນ)";
                                                            }

                                                            ?>
                                                        </span>
                                                    </h5>
                                                    <ul class="list-unstyled h4">

                                                        <li class="d-flex p-1">
                                                            <i class="mdi mdi-cash mr-1 "></i>
                                                            <span>ລາຄາ:<?php echo number_format($row['sale_price']); ?></span>


                                                        </li>
                                                        <li class="d-flex p-1">
                                                            <i class="mdi mdi-store mr-1 "></i>
                                                            <span style='color:<?php echo "$remain_color"; ?>'><?php echo $remain; ?></span>





                                                        </li>


                                                    </ul>
                                                    <div class="d-flex justify-content-center ">
                                                        <a href="javascript:0" class="btn btn-info btn-pill" id="item-modal" data-item_code='<?php echo $row['item_code']; ?>' data-pack_type_name='<?php echo $row['pack_type_name']; ?>' data-toggle="modal" data-target="#modal-edit">ສັງສິນຄ້າ</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                }
                            } else {
                                ?>
                                <div class="container d-flex align-items-center justify-content-center">
                                    <div class="row justify-content-center mt-5">
                                        <div class="col-md-12">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">

                                                        <img src="../images/ic_launcher.png" width="30%" height="100%" alt="Mono">


                                                    </div>
                                                </div>
                                                <div class="card-body p-7 text-center">

                                                    <h3 class="text-dark mb-6 ">ບໍ່ພົບລາຍການຄົ້ນຫາສິນຄ້າ</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>




                        </div>
                    </div>






                </div>
            </div>



            <div class="card card-offcanvas" id="sale-list">
                <div class="card-header">
                    <h2>ປະຫວັດສັ່ງສິນຄ້າ</h2>
                </div>
                <div class="show_order_bill">


                </div>


            </div>


            <div class="modal fade" id="cart-buy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header justify-content-end border-bottom-0">


                            <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>

                        <div class="show_cart_data">



                        </div>


                    </div>
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

                        <div class="show_item_detail">



                        </div>


                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>


        </div>
    </div>



    <?php include("../setting/calljs.php"); ?>

    <script>
        $(document).on("submit", "#add-cart", function(event) {
            $.post("../query/add-cart-customer.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພິ່ມລາຍການສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 500);
                } else if (data.res == "over") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ບໍ່ສາມາດສັ່ງເກີນໄດ້',
                        'error'
                    )
                } else if (data.res == "nozero") {
                    Swal.fire(
                        'ລົງທະບຽນຊ້ຳ',
                        'ກະລຸນາໃສ່ຈຳນວນຈິງ',
                        'error'
                    )
                }
            }, 'json')
            return false;
        });



        // delete 
        $(document).on("click", "#delete-cart", function(e) {
            e.preventDefault();
            var cart_id = $(this).data("cart_id");
            Swal.fire({
                title: 'ແຈ້ງເຕືອນ',
                text: "ແນ່ໃນຈະລົບລາຍຫຼືບໍ່",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ລົບ',
                cancelButtonText: 'ຍົກເລີກ'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "post",
                        url: "../query/delete-bill-cart-item.php",
                        dataType: "json",
                        data: {
                            cart_id: cart_id
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
                                    }, 500);

                            }
                        },
                        error: function(xhr, ErrorStatus, error) {
                            console.log(status.error);
                        }

                    });
                }
            });





            return false;
        });

        // update
        $(document).on("submit", "#cancel-bill", function() {
            $.post("../query/../query/cancle-order-customer.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຍົກເລີກສຳເລັດ',
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
    </script>




</body>

</html>