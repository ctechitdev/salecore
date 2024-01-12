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
    $(document).on("click", "#cart-show", function(e) {
        e.preventDefault();

        $.post('../function/modal/show-cart-customer.php',
            function(output) {
                $('.show_cart_data').html(output).show();
            });
    });


    $(document).on("click", "#bill-show", function(e) {
        e.preventDefault();

        $.post('../function/modal/show-order-customer.php',
            function(output) {
                $('.show_order_bill').html(output).show();
            });
    });

    $(document).on("click", "#item-modal", function(e) {
        e.preventDefault();
        var item_post_id = $(this).data("item_post_id");

        $.post('../function/modal/show-item-detail.php', {
                item_post_id: item_post_id
            },
            function(output) {
                $('.show_item_detail').html(output).show();
            });
    });

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


                    <div class="card-body px-3 px-md-5">
                        <div class="row">

                            <?php

                            $stmt = $conn->prepare(" 
                            SELECT item_post_pic,item_name,item_pack_sale,item_price,item_post_customer_id
                            from tbl_item_post_customer a
                            left join tbl_customer_product_used b on a.item_company_code_id = b.item_company_code_id
                            where item_status_sale = '1' and b.customer_user_id = '$id_users' ");
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="card card-default p-4">

                                            <div class="media">
                                                <img src='../images/item_post/<?php echo $row['item_post_pic']; ?>' width="20%" class="mr-3 img-fluid rounded" alt="Avatar Image" />

                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-2 text-dark"><?php echo $row['item_name']; ?></h5>
                                                    <ul class="list-unstyled h4">
                                                        <li class="d-flex p-1">
                                                            <i class="mdi mdi-package mr-1"></i>
                                                            <span><?php echo $row['item_pack_sale']; ?></span>
                                                        </li>
                                                        <li class="d-flex p-1">
                                                            <i class="mdi mdi-cash mr-1 "></i>
                                                            <span><?php echo number_format($row['item_price']); ?></span>
                                                        </li>


                                                    </ul>
                                                    <div class="d-flex justify-content-center ">
                                                        <a href="javascript:0" class="btn btn-info btn-pill" id="item-modal" data-item_post_id='<?php echo $row['item_post_customer_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສັງສິນຄ້າ</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                            <?php
                                }
                            }
                            ?>




                        </div>
                    </div>






                </div>
            </div>


            <div class="card card-offcanvas" id="cart-buy">
                <div class="card-header">
                    <h2>ລາຍການກຽມອອກບິນ</h2>
                </div>
                <div class="show_cart_data">

                </div>

            </div>


            <div class="card card-offcanvas" id="sale-list">
                <div class="card-header">
                    <h2>ປະຫວັດສັ່ງສິນຄ້າ</h2>
                </div>
                <div class="show_order_bill">


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





        $(document).on("submit", "#add-bill", function() {
            $.post("../query/add-bill-order.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
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
                                    }, 1000);

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
 
    </script>




</body>

</html>