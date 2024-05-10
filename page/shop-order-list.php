<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ອໍເດີ້ຈາກຮ້ານຄ້າ";
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
<script type="text/javascript" src="../js/jquery.min.js"></script> <!-- jQuery -->
<script>
    $(document).on("click", "#show-bill", function(e) {
        e.preventDefault();
        var customer_order_id = $(this).data("customer_order_id");

        $.post('../function/modal/show-customer-order-detail.php', {
                customer_order_id: customer_order_id
            },
            function(output) {
                $('.show_item_detail').html(output).show();
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

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>ລຳດັບ</th>
                                        <th>ຊື່ຮ້ານ</th>
                                        <th>ເລກອໍເດີ້</th>
                                        <th>ສະຖານະ</th>
                                        <th>ມູນຄ່າສັ່ງຊື້</th>
                                        <th>ວັນທີ່ສັງ</th>
                                        <th>ວັນທີ່ຮັບ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;

                                    $stmt4 = $conn->prepare("   
                                    select distinct customer_order_id,customer_name,
                                    customer_order_bill,customer_order_status_name,total_price,order_date,recieve_order_date 
                                    from tbl_customer_order a
                                    left join tbl_customer_order_status b on a.order_status = b.customer_order_status_id
                                    left join tbl_customer_product_used c on a.order_by = c.customer_user_id
                                    left join tbl_staff_item_code d on c.item_company_code_id = d.icc_id
                                    left join tbl_customer_user e on a.order_by = e.customer_user_id 
                                    order by customer_order_id asc ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {




                                    ?>



                                            <tr>
                                                <td><?php echo  $i; ?></td>
                                                <td><?php echo  $row4['customer_name']; ?></td>
                                                <td><?php echo  $row4['customer_order_bill']; ?></td>
                                                <td><?php echo  $row4['customer_order_status_name']; ?></td>
                                                <td><?php echo number_format($row4['total_price']); ?></td>
                                                <td><?php echo  $row4['order_date']; ?></td>
                                                <td><?php echo  $row4['recieve_order_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a href="javascript:0" class="dropdown-item" id="show-bill" data-customer_order_id='<?php echo $row4['customer_order_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສະແດງ</a>


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

                                <div class="show_item_detail">



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
        // update
        $(document).on("submit", "#accept-order", function() {
            $.post("../query/../query/accept-order-customer.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຮັບລາຍການສຳເລັດ',
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