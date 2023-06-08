<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ກຸ່ມສິນຄ້າ";
$header_click = "4";


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

            <?php

            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">

                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">




                            <div class=" email-body p-4 p-xl-5">
                                <div class="email-body-head mb-6 ">
                                    <h4 class="text-dark">ຈັດການລະຫັດບັນຊີ</h4>




                                </div>
                                <form method="post" id="updateitemcode">







                                    <div class="row">



                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-title">

                                                </div>
                                                <div id="add-brand-messages"></div>
                                                <div class="card-body">
                                                    <div class="input-states">

                                                        <table class="table" id="productTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>ບໍລິສັດ</th>
                                                                    <th>ເລກກຸ່ມ</th>
                                                                    <th>ກຸ່ມລູກຄ້າB1</th>
                                                                    <th>ກຸ່ມສິນຄ້າ</th>
                                                                    <th>ໂຄດຊື້</th>
                                                                    <th>ໂຄດຂາຍ</th>
                                                                    <th>ໂຄດບໍລິສັດ</th>
                                                                    <th>ປະເພດໂຄດ</th>
                                                                    <th>ເລກລຳດັບ</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $stmt = $conn->prepare("select * from tbl_item_company_code ");
                                                                $stmt->execute();
                                                                if ($stmt->rowCount() > 0) {
                                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                        $icc_id = $row['icc_id'];
                                                                        $name_company = $row['name_company'];
                                                                        $item_company_code = $row['item_company_code'];
                                                                        $item_group_code_b1 = $row['item_group_code_b1'];
                                                                        $customer_item_code = $row['customer_item_code'];
                                                                        $purchase_tax_code = $row['purchase_tax_code'];
                                                                        $sale_tax_code = $row['sale_tax_code'];
                                                                        $company_code = $row['company_code'];
                                                                        $gen_style = $row['gen_style'];
                                                                        $apc_style = $row['apc_style'];


                                                                ?>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="icc_id[]" id="icc_id<?php echo $x; ?>" value='<?php echo "$icc_id"; ?>' autocomplete="off" class="form-control" />
                                                                                    <input type="text" name="name_company[]" id="name_company<?php echo $x; ?>" value='<?php echo "$name_company"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="item_company_code[]" id="item_company_code<?php echo $x; ?>" value='<?php echo "$item_company_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>



                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="item_group_code_b1[]" id="item_group_code_b1<?php echo $x; ?>" value='<?php echo "$item_group_code_b1"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="customer_item_code[]" id="customer_item_code<?php echo $x; ?>" value='<?php echo "$customer_item_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="purchase_tax_code[]" id="purchase_tax_code<?php echo $x; ?>" value='<?php echo "$purchase_tax_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="sale_tax_code[]" id="sale_tax_code<?php echo $x; ?>" value='<?php echo "$sale_tax_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="company_code[]" id="company_code<?php echo $x; ?>" value='<?php echo "$company_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="gen_style[]" id="gen_style<?php echo $x; ?>" value='<?php echo "$gen_style"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="apc_style[]" id="apc_style<?php echo $x; ?>" value='<?php echo "$apc_style"; ?>' autocomplete="off" class="form-control" />
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
                                            <div class="d-flex justify-content-end mt-6">
                                                <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
                                            </div>
                                        </div>

                                    </div>





                                </form>


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
        $(document).on("submit", "#updateitemcode", function() {
            $.post("../query/update-item-com.php", $(this).serialize(), function(data) {
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