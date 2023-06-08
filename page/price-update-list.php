<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍການປ່ຽນລາຄາ";
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

<body class="navbar-fixed sidebar-fixed" id="body">


    <div class="wrapper">

        <?php include "menu.php"; ?>



        <div class="page-wrapper">

            <?php include "header.php"; ?>


            <div class="content-wrapper">
                <div class="content">
                    <div class="card card-default">


                        <form method="post" id="additempricefrm">
                            <div class="card-header align-items-center px-3 px-md-5">
                                <h2>ລາຍການປ່ຽນລາຄາ</h2>

                                </button>


                            </div>

                            <div class="card-body px-3 px-md-5">
                                <div class="row">

                                    <div class="card-body">
                                        <div class="input-states">

                                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ເລກເອກະສານ</th>
                                                        <th>ລາຍການຂໍ</th>
                                                        <th>ສະກຸນເງິນ</th>

                                                        <th>ປະເພດລາຄາ(ຮ້ານ)</th>
                                                        <th>ກຸ່ມສິນຄ້າ</th>
                                                        <th>ວັນທີນຳໃຊ້</th>

                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php

                                                    if ($role_id == 1) {
                                                        $syntax = "where add_by !='0'";
                                                    } else {
                                                        $s = "where add_by ='$id_users'";
                                                    }

                                                    $stmt4 = $conn->prepare(" 
                                                    SELECT count(pul_id) as count_pul_id,a.pu_id as pu_id,date_use, ccy, pricelist_name,name_company
                                                    FROM tbl_price_update_list a
                                                    left join tbl_price_update b on a.pu_id = b.pu_id
                                                    left join tbl_price_list c on b.pl_id = c.pl_id 
                                                    left join tbl_item_company_code d on b.com_code = d.company_code
                                                    $syntax
                                                    group by a.pu_id  ");
                                                    $stmt4->execute();

                                                    if ($stmt4->rowCount() > 0) {
                                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

                                                            $date_use = $row4['date_use'];
                                                            $count_pul_id = $row4['count_pul_id'];
                                                            $pu_id = $row4['pu_id'];
                                                            $ccy = $row4['ccy'];
                                                            $pricelist_name = $row4['pricelist_name'];
                                                            $name_company = $row4['name_company'];

                                                    ?>



                                                            <tr>
                                                                <td><?php echo "$pu_id"; ?></td>
                                                                <td><?php echo "$count_pul_id"; ?></td>
                                                                <td><?php echo "$ccy"; ?></td>
                                                                <td><?php echo "$pricelist_name"; ?></td>
                                                                <td><?php echo "$name_company"; ?></td>
                                                                <td><?php echo "$date_use"; ?></td>




                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                        </a>

                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                            <a class="dropdown-item" href="edit-price-update.php?pu_id=<?php echo "$pu_id"; ?>">ແກ້ໄຂ</a>
                                                                            <a class="dropdown-item" type="button" id="deleteprice" data-id='<?php echo $row4['pu_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
                                                                            <a class="dropdown-item" href="../pdf/print-add-price-pdf.php?pu_id=<?php echo "$pu_id"; ?>" target="_blank">ພິນລະລາຍການ</a>

                                                                            <?php
                                                                            if ($role_id == 1) {
                                                                            ?>
                                                                                <a class="dropdown-item" href="../export/export-price-update-data.php?pu_id=<?php echo "$pu_id"; ?>">ດາວໂຫລດ</a>

                                                                            <?php
                                                                            }
                                                                            ?>
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

                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>
    <?php include("../setting/calljs.php"); ?>
    <script>
        // Delete item
        $(document).on("click", "#deleteprice", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/deleteprice.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນລາຄາສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'price-update-list.php';
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