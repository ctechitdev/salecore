<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປະເມິນຜູ້ສະໜອງ";
$header_click = "1";
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


    <script src="../plugins/nprogress/nprogress.js"></script>
</head>



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



                            <div class="  col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <form method="post">





                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ກຸ່ມສິນຄ້າ</th>
                                                    <th>ລະຫັດລູກຄ້າ</th>
                                                    <th>ຊື່ຮ້ານ</th>
                                                    <th>ຊື່ຜູ້ສະໜອງ</th>
                                                    <th>ເບີໂທ</th>
                                                    <th>ເລກທະບຽນ</th>
                                                    <th>ວັນລົງທະບຽນ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php






                                                $stmt4 = $conn->prepare("select  a.vendor_id,acc_name,vendor_name,vendor_shop_name,a.vendor_code,
                                                phone_office,company_register_code,register_date
                                                from tbl_vendor a
                                                left join tbl_account_company b on a.acc_code = b.company_code
                                                left join tbl_vendor_evaluated c on a.vendor_id = c.vendor_id
                                                where c.vendor_id is null ");


                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $vendor_id = $row4['vendor_id'];
                                                        $vendor_code = $row4['vendor_code'];
                                                        $vendor_shop_name = $row4['vendor_shop_name'];
                                                        $vendor_name = $row4['vendor_name'];
                                                        $acc_name = $row4['acc_name'];
                                                        $phone_office = $row4['phone_office'];
                                                        $company_register_code = $row4['company_register_code'];
                                                        $register_date = $row4['register_date'];


                                                ?>



                                                        <tr>
                                                            <td><?php echo "$acc_name"; ?></td>
                                                            <td><?php echo "$vendor_code"; ?></td>
                                                            <td><?php echo "$vendor_shop_name"; ?></td>
                                                            <td><?php echo "$vendor_name"; ?></td>
                                                            <td><?php echo "$phone_office"; ?></td>
                                                            <td><?php echo "$company_register_code"; ?></td>
                                                            <td><?php echo "$register_date"; ?></td>


                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="vendor-evaluate-form.php?vendor_id=<?php echo "$vendor_id"; ?>">ສະແດງຂໍ້ມູນ</a>
                                                                        <a class="dropdown-item" type="button" id="delchecklocate" data-id='<?php echo $row4['vendor_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກລາຍການ</a>

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
        // Delete Customer
        $(document).on("click", "#delchecklocate", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-check-in-location.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ຍົກເລີກລາຍການຢ້ຽມຢາມສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'visit-customer-location.php';
                            }, 1000);

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