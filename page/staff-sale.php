<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພະນັກງານຂາຍ";
$header_click = "3";

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
    $(function() {



        $('#group_id').change(function() {
            var group_id = $('#group_id').val();
            $.post('../function/dynamic_dropdown/get_depart.php', {
                    group_id: group_id
                },
                function(output) {
                    $('#dp_id').html(output).show();
                });
        });

        $('#dp_id').change(function() {
            var dp_id = $('#dp_id').val();
            $.post('../function/dynamic_dropdown/get_staff_sale.php', {
                    dp_id: dp_id
                },
                function(output) {
                    $('#us_id').html(output).show();
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


                            <div class="col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ຈັດການຂໍ້ພະນັກງານຂາຍ</h4>



                                    </div>
                                    <form method="post" id="addstaffsale">


                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="lastName">ຊື່ພະນັກງານຂາຍ</label>
                                                    <input type="text" class="form-control" id="ss_name" name="ss_name">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="lastName">ໂຄດພະນັກງານ</label>
                                                    <input type="number" class="form-control" id="ss_code" name="ss_code">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="lastName">ເລກຊີພີ</label>
                                                    <input type="text" class="form-control" id="ss_cp" name="ss_cp">
                                                </div>
                                            </div>

                                            <div class="form-group  col-lg-4">
                                                <label class="text-dark font-weight-medium">ກຸ່ມບໍລິສັດ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="group_id" id="group_id">
                                                        <option value=""> ເລືອກກຸ່ມບໍລິສັດ </option>
                                                        <?php
                                                        $stmt6 = $conn->prepare(" SELECT * FROM tbl_group_company ");
                                                        $stmt6->execute();
                                                        if ($stmt6->rowCount() > 0) {
                                                            while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row6['gc_id']; ?>"> <?php echo $row6['gc_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label class="text-dark font-weight-medium">ພະແນກ</label>
                                                <div class="form-group">

                                                    <select class="form-control  font" name="dp_id" id="dp_id">
                                                        <option value=""> ເລືອກພະແນກ </option>
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="form-group  col-lg-4">
                                                <label class="text-dark font-weight-medium">ຊື່ຜູ້ໃຊ້</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="us_id" id="us_id">
                                                        <option value=""> ເລືອກຊື່ຜູ້ໃຊ້ </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ຜູກຜູ້ໃຊ້ກັບພະນັກງານຂາຍ</button>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-wrapper">
                <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">

                            <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກລຳດັບ</th>
                                        <th>ຊື່ພະນັກງານຂາຍ</th>
                                        <th>ລະຫັດB1</th>
                                        <th>ລະຫັດCP</th>
                                        <th>ຢູສເຊີ້</th>
                                        <th>ສະຖານະ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("  
                                    select ss_id,staff_code,user_ids,staff_cp,staff_name,user_name,
                                    (case when user_ids is null then 'ວ່າງ' else 'ຜູ້ສຳເລັດ' end) as user_status
                                    from tbl_staff_sale a
                                    left join tbl_user_staff b on a.user_ids = b.usid ");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ss_id = $row4['ss_id'];
                                            $staff_code = $row4['staff_code'];
                                            $staff_name = $row4['staff_name'];
                                            $staff_cp = $row4['staff_cp'];
                                            $staff_id = $row4['user_ids'];
                                            $user_status = $row4['user_status'];
                                            $user_name = $row4['user_name'];


                                    ?>



                                            <tr>
                                                <td><?php echo "$ss_id"; ?></td>
                                                <td><?php echo "$staff_name"; ?></td>
                                                <td><?php echo "$staff_code"; ?></td>
                                                <td><?php echo "$staff_cp"; ?></td>
                                                <td><?php echo "$user_name"; ?></td>
                                                <td>
                                                    <span class="badge 
                                                <?php
                                                if (empty($staff_id)) {
                                                    echo "badge-secondary";
                                                } else {
                                                    echo "badge-success";
                                                }

                                                ?>">
                                                        <?php echo "$user_status"; ?>
                                                    </span>
                                                </td>



                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-sale-staff.php?ss_id=<?php echo "$ss_id"; ?>">ແກ້ໄຂ</a>
                                                            <a class="dropdown-item" type="button" id="canceljoin" data-id='<?php echo $row4['ss_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກ</a>
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

            <?php include "footer.php"; ?>
        </div>
    </div>


    <?php include("../setting/calljs.php"); ?>

    <script>
        // Add staff user 
        $(document).on("submit", "#addstaffsale", function() {
            $.post("../query/add-staff-sale.php", $(this).serialize(), function(data) {
                if (data.res == "failed") {
                    Swal.fire(
                        'ບໍສຳເລັດ',
                        'ບໍ່ສາມາດລົງທະບຽນໄດ້',
                        'error'
                    )
                } else if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ເພິ່ມຜູ້ໃຊ້ສຳເລັດ',
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


        // active user
        $(document).on("click", "#canceljoin", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/cancel-join-staff.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ຍົກເລີກ ສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'staff-sale.php';
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

    <!--  -->


</body>

</html>