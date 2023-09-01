<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ປະເມິນຜູ້ສະໜອງ";
$header_click = "1";

$vendor_evaluated_id = $_GET['vendor_evaluated_id'];


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



<body class="navbar-fixed sidebar-fixed" id="body" onload="getLocation()">




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



                            <div class="col-lg-12 col-xl-12 col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h1 class="text-dark text-center"> ປະເມິນຜູ້ສະໜອງ</h1>
                                        <?php

                                        //   echo "$date_view and $id_staff";
                                        ?>


                                    </div>
                                    <form method="post" id="editform">



                                        <?php

                                        $cusrows = $conn->query(" 
                                        SELECT vendor_evaluated_id,vendor_name,vendor_shop_name,acc_name,commend_from_evaluator,a.vendor_id,
                                        DATE_FORMAT(evaluated_date, '%d / %m / %y') as evaluated_date,
                                        DATE_FORMAT(evaluated_month, '%Y-%m') as evaluated_month
                                        FROM  tbl_vendor a
                                        left join tbl_account_company b on a.acc_code = b.company_code
                                        left join tbl_vendor_evaluated c on a.vendor_id = c.vendor_id
                                        WHERE vendor_evaluated_id ='$vendor_evaluated_id' ")->fetch(PDO::FETCH_ASSOC);

                                        $vendor_evaluated_id = $cusrows['vendor_evaluated_id'];
                                        $vendor_name = $cusrows['vendor_name'];
                                        $vendor_shop_name = $cusrows['vendor_shop_name'];
                                        $acc_name = $cusrows['acc_name'];
                                        $evaluated_date = $cusrows['evaluated_date'];
                                        $evaluated_month = $cusrows['evaluated_month'];
                                        $commend_from_evaluator = $cusrows['commend_from_evaluator'];
                                        $vendor_id = $cusrows['vendor_id'];

                                        
                                        ?>

                                        <input type="hidden" class="form-control" name="vendor_evaluated_id" id="vendor_evaluated_id" value='<?php echo "$vendor_evaluated_id" ?>' required>
                                     
                                        <div class="row text-center">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4>ຊື່ຜູ້ຂາຍ: <?php echo "$vendor_shop_name ($vendor_name)"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4>ປະເພດສິນຄ້າ: <?php echo "$acc_name"; ?></h4>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ວັນທີ່ປະເມີນ </h4>
                                                    </label>
                                                    <h4> <?php echo "$evaluated_date"; ?> </h4>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <h4> ຊ່ວງປໃນການປະເມີນ </h4>
                                                    </label>
                                                    <input type="month" class="form-control" name="evaluated_month" value='<?php echo "$evaluated_month"; ?>'>
                                                </div>
                                            </div>

                                        </div>




                                        <div class="row">


                                            <div class="col-lg-12">
                                                <div class="card">

                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="form-group">
                                                                <div class="row">

                                                                    <?php

                                                                    $i = 1;
                                                                    $stmt1 = $conn->prepare("select evaluation_score, a.evaluation_question_id,evaluation_question_title,evaluation_question_data,evaluation_point
                                                                    from tbl_vendor_evaluated_detail a
                                                                    left join tbl_evaluation_question b on a.evaluation_question_id = b.evaluation_question_id
                                                                    where vendor_evaluated_id = '$vendor_evaluated_id' ");
                                                                    $stmt1->execute();
                                                                    if ($stmt1->rowCount() > 0) {
                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>

                                                                            <input type="hidden" class="form-control" name="evaluation_question_id[]" value='<?php echo $row1['evaluation_question_id']; ?>' required>


                                                                            <div class="form-group  col-lg-7">
                                                                                <label class="text-dark font-weight-medium"><?php echo "$i. " . $row1['evaluation_question_title']; ?></label>
                                                                                <div class="form-group">
                                                                                    <label class="text-dark font-weight-medium"><?php echo $row1['evaluation_question_data']; ?></label>
                                                                                    <input type="hidden" class="form-control" name="score_multi[]" value='<?php echo $row1['evaluation_point']; ?>' required>

                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-5 text-center">

                                                                                <label for="firstName">ລະດັບຄະແນນ </label><br>

                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score1_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="1" <?php if ($row1['evaluation_score'] == 1) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score1_<?php echo "$i"; ?>'>1</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score2_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="2" <?php if ($row1['evaluation_score'] == 2) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score2_<?php echo "$i"; ?>'>2</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score3_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="3" <?php if ($row1['evaluation_score'] == 3) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score3_<?php echo "$i"; ?>'>3</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score4_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="4" <?php if ($row1['evaluation_score'] == 4) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score4_<?php echo "$i"; ?>'>4</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                    <input type="radio" id='score5_<?php echo "$i"; ?>' name='score_<?php echo "$i"; ?>' value="5" <?php if ($row1['evaluation_score'] == 5) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> class="custom-control-input">
                                                                                    <label class="custom-control-label" for='score5_<?php echo "$i"; ?>'>5</label>
                                                                                </div>

                                                                            </div>



                                                                    <?php
                                                                            $i++;
                                                                        }
                                                                    }

                                                                    ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="firstName">
                                                                                <h4> ຂໍ້ສະເໜີແນະ </h4>
                                                                            </label>
                                                                            <textarea class="form-control" name="commend_from_evaluator"><?php echo "$commend_from_evaluator"; ?></textarea>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
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
                                                $stmt4 = $conn->prepare("select vendor_evaluated_id, a.vendor_id,acc_name,vendor_name,vendor_shop_name,a.vendor_code,
                                                phone_office,company_register_code,register_date,
                                                (case when c.vendor_id is null then 'ລໍຖ້າປະເມີນ' else 'ປະເມີນແລ້ວ' end) as status_evaluate
                                                from tbl_vendor a
                                                left join tbl_account_company b on a.acc_code = b.company_code
                                                left join tbl_vendor_evaluated c on a.vendor_id = c.vendor_id
                                                 ");


                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $vendor_id = $row4['vendor_id'];
                                                        $vendor_code = $row4['vendor_code'];
                                                        $vendor_shop_name = $row4['vendor_shop_name'];
                                                        $vendor_name = $row4['vendor_name'];
                                                        $acc_name = $row4['acc_name'];
                                                        $phone_office = $row4['phone_office'];
                                                        $vendor_evaluated_id = $row4['vendor_evaluated_id'];
                                                        $register_date = $row4['register_date'];
                                                        $status_evaluate = $row4['status_evaluate'];


                                                ?>



                                                        <tr>
                                                            <td><?php echo "$acc_name"; ?></td>
                                                            <td><?php echo "$vendor_code"; ?></td>
                                                            <td><?php echo "$vendor_shop_name"; ?></td>
                                                            <td><?php echo "$vendor_name"; ?></td>
                                                            <td><?php echo "$phone_office"; ?></td>
                                                            <td><?php echo "$status_evaluate"; ?></td>
                                                            <td><?php echo "$register_date"; ?></td>


                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <?php
                                                                        if ($status_evaluate == 'ປະເມີນແລ້ວ') {
                                                                        ?>
                                                                            <a class="dropdown-item" href="edit-vendor-evaluate-form.php?vendor_evaluated_id=<?php echo $row4['vendor_evaluated_id']; ?>">ແກ້ໄຂ</a>
                                                                            <a class="dropdown-item" type="button" id="delchecklocate" data-id='<?php echo $row4['vendor_id']; ?>' class="btn btn-danger btn-sm">ຍົກເລີກລາຍການ</a>

                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <a class="dropdown-item" href="vendor-evaluate-form.php?vendor_id=<?php echo "$vendor_id"; ?>">ສະແດງຂໍ້ມູນ</a>
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
        // check in out customer
        $(document).on("submit", "#editform", function() {
            $.post("../query/edit-evaluate.php", $(this).serialize(), function(data) {
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
                                location.reload();
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