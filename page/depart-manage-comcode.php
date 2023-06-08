<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຈັດການກຸ່ມລູກຄ້າ";
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


    <script src="../plugins/nprogress/nprogress.js"></script>
</head>

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(function() {



        $('#dp_id').change(function() {
            var dp_id = $('#dp_id').val();
            $.post('../function/dynamic_dropdown/get_depart_accode.php', {
                    dp_id: dp_id
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
            <div class="content-wrapper">
                <div class="content">
                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">



                            <div class="  col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <form method="post" id="adddsac">

                                        <div class="form-footer  d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-pill" formaction="list-add-price.php">ຈັດການ</button>
                                        </div><br>

                                        <div class="row">
                                            <div class="form-group  col-lg-12">
                                                <label class="text-dark font-weight-medium">ພະແນກ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="dp_id" id="dp_id">
                                                        <option value=""> ເລຶອກພະແນກ </option>
                                                        <?php
                                                        $stmt = $conn->prepare(" select dp_id, concat(dp_name,' (', gc_name, ') ') as dp_name
                                                        from tbl_depart a
                                                        left join tbl_group_company b on a.group_id = b.gc_id order by gc_name ");
                                                        $stmt->execute();
                                                        if ($stmt->rowCount() > 0) {
                                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row['dp_id']; ?>"> <?php echo $row['dp_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row" id="dis_id">
                                      



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
        $(document).on("submit", "#adddsac", function() {
            $.post("../query/depart-manage-accode.php", $(this).serialize(), function(data) {
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