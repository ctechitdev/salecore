<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ບັນຊີບໍລິສັດ";
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
                                <form method="post" id="updateacccode">







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
                                                                    <th>ເລກບັນຊີ</th>
                                                                    <th>ພະແນກ</th>
                                                                    <th>ໂຄດບັນຊີ</th>
                                                                    <th>ໂຄດບໍລິສັດ</th>
                                                                    <th>ປະເພດໂຄດ</th>
                                                                    <th>ປະເພດລຳດັບ</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $stmt = $conn->prepare("select * from tbl_account_company ");
                                                                $stmt->execute();
                                                                if ($stmt->rowCount() > 0) {
                                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                        $ac_ic = $row['ac_ic'];
                                                                        $acc_number = $row['acc_number'];
                                                                        $acc_name = $row['acc_name'];
                                                                        $acc_code = $row['acc_code'];
                                                                        $company_code = $row['company_code'];
                                                                        $code_type = $row['code_type'];
                                                                        $code_lenght = $row['code_lenght'];


                                                                ?>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="hidden" name="ac_ic[]" id="ac_ic<?php echo $x; ?>" value='<?php echo "$ac_ic"; ?>' autocomplete="off" class="form-control" />
                                                                                    <input type="text" name="acc_number[]" id="acc_number<?php echo $x; ?>" value='<?php echo "$acc_number"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="acc_name[]" id="acc_name<?php echo $x; ?>" value='<?php echo "$acc_name"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>



                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="acc_code[]" id="acc_code<?php echo $x; ?>" value='<?php echo "$acc_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="company_code[]" id="company_code<?php echo $x; ?>" value='<?php echo "$company_code"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="code_type[]" id="code_type<?php echo $x; ?>" value='<?php echo "$code_type"; ?>' autocomplete="off" class="form-control" />
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" name="code_lenght[]" id="code_lenght<?php echo $x; ?>" value='<?php echo "$code_lenght"; ?>' autocomplete="off" class="form-control" />
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
        $(document).on("submit", "#updateacccode", function() {
            $.post("../query/update-account-com.php", $(this).serialize(), function(data) {
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