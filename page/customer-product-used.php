<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຜູກສິນຄ້າກັບລູກຄ້າ";
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


    <script src="../plugins/nprogress/nprogress.js"></script>
</head>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(function() {



        $('#customer_user_id').change(function() {
            var customer_user_id = $('#customer_user_id').val();
            $.post('../function/dynamic_dropdown/customer_get_product_item.php', {
                    customer_user_id: customer_user_id
                },
                function(output) {
                    $('#list_product_group').html(output).show();
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
            <div class="content-wrapper">
                <div class="content">
                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">



                            <div class="  col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <form method="post" id="adddpitem">

                                        <div class="form-footer  d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-pill" formaction="list-add-price.php">ຈັດການ</button>
                                        </div><br>

                                        <div class="row">
                                            <div class="form-group  col-lg-12">
                                                <label class="text-dark font-weight-medium">ພະແນກ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="customer_user_id" id="customer_user_id">
                                                        <option value=""> ເລຶອກພະແນກ </option>
                                                        <?php
                                                        $stmt = $conn->prepare("
                                                        SELECT  customer_user_id,customer_name 
                                                        FROM tbl_customer_user 
                                                        WHERE customer_status = '1' ");
                                                        $stmt->execute();
                                                        if ($stmt->rowCount() > 0) {
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row['customer_user_id']; ?>"> <?php echo $row['customer_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row" id="list_product_group">




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
        // join staff and company code
        $(document).on("submit", "#adddpitem", function() {
            $.post("../query/add-customer-product-used.php", $(this).serialize(), function(data) {
                if (data.res == "exist") {
                    Swal.fire(
                        'ບໍ່ສາມາດຜູກໄດ້',
                        'ຢູສເຊີ້ ແລະ ລະຫັດແມ່ນຖືກຜູກແລ້ວ',
                        'error'
                    )
                } else if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ຜູກສຳເລັດ',
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