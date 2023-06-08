<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ເພີ່ມລູກຄ້າແບບຫລາຍລະຫັດ";
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


</head>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>


<body class="navbar-fixed sidebar-fixed" id="body">

    <script>
        $(function() {



            $('#pv_id').change(function() {
                var pv_id = $('#pv_id').val();
                $.post('../function/dynamic_dropdown/get_district_name.php', {
                        pv_id: pv_id
                    },
                    function(output) {
                        $('#dis_id').html(output).show();
                    });
            });






        });
    </script>


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



                            <div class="">
                                <div class="   email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-6 ">
                                        <h4 class="text-dark">ເພີ່ມລະຫັດສິນຄ້າ</h4>




                                    </div>
                                    <form method="post" id="additemfrm">







                                        <div class="row">




                                            <div class="card-body">




                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="firstName">ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</label>
                                                            <input type="text" class="form-control" id="shopname" name="shopname" required>
                                                        </div>
                                                    </div>




                                                </div>

                                                <label for="firstName">ເພດ</label>

                                                <br>



                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderM" name="customRadio" value="M" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderM">ຊາຍ</label>
                                                </div>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderF" name="customRadio" value="F" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderF">ຍິງ</label>
                                                </div>






                                                <div class="row">



                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="firstName">ຊື່ລູກຄ້າ</label>
                                                            <input type="text" class="form-control" name="customername" id="customername">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="lastName">ຊື່ພາສາອັງກິດ</label>
                                                            <input type="text" class="form-control" name="engname" id="engname">
                                                        </div>
                                                    </div>

                                                </div>



                                                <div class="row">
                                                    <div class="form-group  col-lg-6">
                                                        <label class="text-dark font-weight-medium">ແຂວງ</label>
                                                        <div class="form-group">
                                                            <select class=" form-control font" name="pv_id" id="pv_id">
                                                                <option value=""> ເລືອກແຂວງ </option>
                                                                <?php
                                                                $stmt = $conn->prepare(" SELECT pv_id,pv_name FROM tbl_provinces order by pv_name");
                                                                $stmt->execute();
                                                                if ($stmt->rowCount() > 0) {
                                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                ?> <option value="<?php echo $row['pv_id']; ?>"> <?php echo $row['pv_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-lg-6">
                                                        <label class="text-dark font-weight-medium">ເມືອງ</label>
                                                        <div class="form-group">

                                                            <select class="form-control  font" name="dis_id" id="dis_id">
                                                                <option value=""> ເລືອກເມືອງ </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="firstName"> ບ້ານ </label>
                                                            <input type="text" class="form-control" id="villagename" name="villagename">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="firstName"> ຖະໜົນ </label>
                                                            <input type="text" class="form-control" id="streetname" name="streetname">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="firstName"> ໜ່ວຍ </label>
                                                            <input type="text" class="form-control" id="houseunit" name="houseunit">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label for="firstName"> ເຮືອນເລກທີ </label>
                                                            <input type="text" class="form-control" id="housenumber" name="housenumber">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="firstName">ເລກບັດ/ເລກອາກອນ</label>
                                                            <input type="text" class="form-control" id="identid" name="identid">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <label for="firstName">ທີ່ຕັ້ງ</label>
                                                            <input type="text" class="form-control" id="locationdetail" name="locationdetail">
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">



                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="firstName">ເບີໂທ1</label>
                                                            <input type="text" class="form-control" id="phone1" name="phone1">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="lastName">ເບີໂທ2</label>
                                                            <input type="text" class="form-control" id="phone2" name="phone2">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="lastName">ແຟັກ</label>
                                                            <input type="text" class="form-control" id="fax" name="fax">
                                                        </div>
                                                    </div>

                                                </div>

                                                <label for="firstName">ປະເພດການຊຳລະ</label>




                                                <div class="row">



                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <br><br>

                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                <input type="radio" id="Cash" name="CashType" value="Cash" class="custom-control-input" checked>
                                                                <label class="custom-control-label" for="Cash">ຈ່າຍສົດ</label>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <br><br>
                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                <input type="radio" id="Credit" name="CashType" value="Credit" class="custom-control-input">
                                                                <label class="custom-control-label" for="Credit">ຕິດໜີ້</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="  col-lg-6">
                                                        <label class="text-dark font-weight-medium">ປະເພດລາຄາ</label>
                                                        <div class="form-group">
                                                            <select class=" form-control font" name="pricelist" id="pricelist">
                                                                <option value="0"> ເລືອກປະເພດລາຄາ </option>
                                                                <?php
                                                                $stmt6 = $conn->prepare(" SELECT pricelist_name,b1_code FROM tbl_price_list order by pricelist_name");
                                                                $stmt6->execute();
                                                                if ($stmt6->rowCount() > 0) {
                                                                    while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
                                                                ?> <option value="<?php echo $row6['b1_code']; ?>" <?php if ($row6['b1_code'] == 13) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>> <?php echo $row6['pricelist_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="lastName">ວົງເງິນຕິດໜີ້</label>
                                                            <input type="number" class="form-control" id="creditvalues" value="0" step="any" name="creditvalues">
                                                        </div>
                                                    </div>


                                                    <div class="  col-lg-6">
                                                        <label class="text-dark font-weight-medium">ຈຳນວນວັນຕິດໜີ້</label>
                                                        <div class="form-group">
                                                            <select class=" form-control font" name="paymentterm" id="paymentterm">
                                                                <option value="0"> ເລືອກວັນຕິດໜີ້ </option>
                                                                <?php
                                                                $stmt5 = $conn->prepare(" SELECT b1_number,pt_name FROM tbl_payment_term order by pt_name");
                                                                $stmt5->execute();
                                                                if ($stmt5->rowCount() > 0) {
                                                                    while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                                ?> <option value="<?php echo $row5['b1_number']; ?>"> <?php echo $row5['pt_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">



                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="firstName">ຊື່ຜູ້ຕິດຕໍ່</label>
                                                            <input type="text" class="form-control" id="contactby" name="contactby">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="lastName">ເບີໂທ</label>
                                                            <input type="text" class="form-control" id="contactphone" name="contactphone">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group  col-lg-6">
                                                        <label class="text-dark font-weight-medium">ພະນັກງານຕິດຕໍ່</label>
                                                        <div class="form-group">
                                                            <select class=" form-control font" name="ss_id" id="ss_id">
                                                                <option value="0"> ເລືອກພະນັກງານ </option>
                                                                <?php
                                                                $stmt3 = $conn->prepare("
														SELECT staff_code,concat(staff_cp,' ', staff_name) as st_name 
														FROM tbl_staff_sale a
														left join tbl_user_staff b on a.user_ids = b.usid
														where depart_id = '$depart_id'
														order by staff_cp 
														");
                                                                $stmt3->execute();
                                                                if ($stmt3->rowCount() > 0) {
                                                                    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                                                ?> <option value="<?php echo $row3['staff_code']; ?>"> <?php echo $row3['st_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="lastName">Shop Type</label>
                                                            <input type="text" class="form-control" id="shopttypecus" name="shopttypecus">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="lastName">Service Type</label>
                                                            <input type="text" class="form-control" id="servicetype" name="servicetype">
                                                        </div>
                                                    </div>


                                                    <div class="form-group  col-lg-6">
                                                        <label class="text-dark font-weight-medium">ວັນຢ້ຽມ</label>
                                                        <div class="form-group">
                                                            <select class=" form-control font" name="visitdays" id="visitdays">
                                                                <option value=""> ເລືອກວັນຢ້ຽມ </option>
                                                                <?php
                                                                $stmtv = $conn->prepare(" SELECT * FROM tbl_day_visit  ");
                                                                $stmtv->execute();
                                                                if ($stmtv->rowCount() > 0) {
                                                                    while ($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)) {
                                                                ?> <option value="<?php echo $rowv['dv_code']; ?>"> <?php echo $rowv['dv_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="firstName"> ເຂດລູກຄ້າ </label>
                                                            <input type="text" class="form-control" id="cuszone" name="cuszone">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="firstName"> ລະດັບລູກຄ້າ </label>
                                                            <input type="text" class="form-control" id="cusclass" name="cusclass">
                                                        </div>
                                                    </div>

                                                </div>


                                                <table class="table" id="productTable">
                                                    <thead>
                                                        <tr>
                                                            <th>ປະເພດລູກຄ້າ</th>
                                                            <th>ລະຫັດກຸ່ມສິນຄ້າ</th>
                                                            <th>ລະຫັດທີມ</th>
                                                            <th></th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $arrayNumber = 0;
                                                        for ($x = 1; $x < 2; $x++) { ?>
                                                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">



                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="text" name="custype[]" id="custype<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                    </div>
                                                                </td>

                                                                <td style="margin-left:10px;">
                                                                    <div class="form-group">

                                                                        <select class=" form-control font" name="Acc_id[]" id="Acc_id<?php echo $x; ?>">
                                                                            <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>

                                                                            <?php


                                                                            $stmt1 = $conn->prepare(" SELECT company_code ,concat(company_code ,' (',acc_name, ') ') as full_code 
                                                                                        from tbl_staff_company a
                                                                                        left join tbl_account_company b on a.company_id = b.ac_ic
                                                                                        where depart_id = '$depart_id'
                                                                                        order by company_code ");
                                                                            $stmt1->execute();
                                                                            if ($stmt1->rowCount() > 0) {
                                                                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                            ?> <option value="<?php echo $row1['company_code']; ?>"> <?php echo $row1['full_code']; ?></option>
                                                                            <?php
                                                                                }
                                                                            }



                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="form-group">

                                                                        <select class=" form-control font" name="pv_code[]" id="pv_code<?php echo $x; ?>">
                                                                            <option value=""> ເລືອກລະຫັດທີມ </option>

                                                                            <?php


                                                                            $stmt2 = $conn->prepare(" SELECT *from tbl_kptl_tcode");
                                                                            $stmt2->execute();
                                                                            if ($stmt2->rowCount() > 0) {
                                                                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                                            ?> <option value="<?php echo $row2['kt_name']; ?>"> <?php echo $row2['kt_name']; ?></option>
                                                                            <?php
                                                                                }
                                                                            }



                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </td>






                                                                <td>
                                                                    <div class="form-group"><button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="mdi mdi-briefcase-plus"></i></button></div>

                                                                </td>
                                                                <td>
                                                                    <div class="form-group"><button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="mdi mdi-briefcase-remove"></i></button></div>


                                                                </td>


                                                            </tr>
                                                        <?php
                                                            $arrayNumber++;
                                                        } // /for
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>




                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມລະຫັດສິນລູກ</button>
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
                                        <th>ລະຫັດລູກຄ້າ</th>
                                        <th>ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</th>
                                        <th>ຊື່ລູກຄ້າ</th>
                                        <th>ເບີໂທ</th>

                                        <th>ປະເພດຊຳລະ</th>
                                        <th>ພະນັກງານ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("  

				SELECT c_id,c_code,c_shop_name,c_name,payment_type,phone1,staff_name,ref_number
				FROM tbl_customer a
				left join tbl_staff_sale b on a.staff_contact = b.staff_code
				where add_by ='$id_users'
				order by c_id DESC

				");
                                    $stmt4->execute();
                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $c_id = $row4['c_id'];
                                            $c_code = $row4['c_code'];
                                            $c_shop_name = $row4['c_shop_name'];
                                            $c_name = $row4['c_name'];
                                            $phone1 = $row4['phone1'];
                                            $payment_type = $row4['payment_type'];
                                            $staff_contact = $row4['staff_name'];
                                            $ref_number = $row4['ref_number'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$ref_number"; ?></td>
                                                <td><?php echo "$c_code"; ?></td>
                                                <td><?php echo "$c_shop_name"; ?></td>
                                                <td><?php echo "$c_name"; ?></td>
                                                <td><?php echo "$phone1"; ?></td>
                                                <td><?php echo "$payment_type"; ?></td>
                                                <td><?php echo "$staff_contact"; ?></td>



                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-customer.php?cus_id=<?php echo "$c_id"; ?>">ແກ້ໄຂ</a>

                                                            <a class="dropdown-item" type="button" id="deletecustomer" data-id='<?php echo $row4['c_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
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
        // Delete Customer
        $(document).on("click", "#deletecustomer", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/deletecustomer.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນລູກຄ້າສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'customer-multi-code.php';
                            }, 1000);

                    }
                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });



            return false;
        });
        // add item Data 
        $(document).on("submit", "#additemfrm", function() {
            $.post("../query/add-multi-cuscode.php", $(this).serialize(), function(data) {
                if (data.res == "noCusGroup") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາເລືອກຂໍ້ມູນກຸ່ມສິນຄ້າ',
                        'error'
                    )
                } else if (data.res == "noPVCode") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາເລືອກລະຫັດແຂວງ',
                        'error'
                    )
                } else if (data.res == "NoTeam") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        data.show_pv_code.toUpperCase() + 'ກະລຸນາເລືອກລະຫັດທີມ',
                        'error'
                    )
                } else if (data.res == "invalid") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ບໍ່ສາມາດເພິ່ມຂໍ້ມູນໄດ້',
                        'error'
                    )
                } else if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ລົງທະບຽນລູກຄ້າສຳເລັດ',
                        'success'
                    )

                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);

                }
            }, 'json');

            return false;
        });


        // Delete item
        $(document).on("click", "#deleteitem", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/deleteitem.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນລະຫັດສິນຄ້າສຳເລັດ',
                            'success'
                        )
                        setTimeout(
                            function() {
                                window.location.href = 'customer-multi-code.php';
                            }, 1000);

                    }
                },
                error: function(xhr, ErrorStatus, error) {
                    console.log(status.error);
                }

            });



            return false;
        });



        function addRow() {
            $("#addRowBtn").button("loading");

            var tableLength = $("#productTable tbody tr").length;

            var tableRow;
            var arrayNumber;
            var count;

            if (tableLength > 0) {
                tableRow = $("#productTable tbody tr:last").attr('id');
                arrayNumber = $("#productTable tbody tr:last").attr('class');
                count = tableRow.substring(3);
                count = Number(count) + 1;
                arrayNumber = Number(arrayNumber) + 1;
            } else {
                // no table row
                count = 1;
                arrayNumber = 0;
            }

            $.ajax({
                url: '../query/fetch_acccode_data.php',
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $("#addRowBtn").button("reset");



                    var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +


                        '<td>  <div class="form-group">' +
                        '<input type="text" name="custype[]" id="custype' + count + '" autocomplete="off" class="form-control" />' +
                        '</div></td>' +



                        '<td>' +
                        '<div class="form-group">' +

                        '<select class="form-control" name="Acc_id[]" id="Acc_id' + count + '" >' +
                        '<option value="">ເລືອກລະຫັດກຸ່ມສິນຄ້າ</option>';
                    // console.log(response);
                    $.each(response, function(index, value) {
                        tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
                    });

                    tr += '</select>' +
                        '</div>' +
                        '</td>' +

                        '<td>' +
                        '<div class="form-group">' +

                        '<select class="form-control" name="pv_code[]" id="pv_code' + count + '" >' +
                        '<option value="">ເລືອກລະຫັດທີມ</option>' +
                        '<option value="001">001</option>' +
                        '<option value="002">002</option>' +
                        '<option value="003">003</option>' +
                        '<option value="004">004</option>' +
                        '<option value="005">005</option>' +
                        '<option value="006">006</option>' +
                        '<option value="007">007</option>' +
                        '<option value="008">008</option>' +
                        '<option value="009">009</option>' +
                        '<option value="010">010</option>' +
                        '<option value="011">011</option>' +
                        '<option value="012">012</option>';

                    tr += '</select>' +
                        '</div>' +
                        '</td>' +




                        '<td>  <div class="form-group">' +
                        '<button class="btn btn-primary removeProductRowBtn" type="button" onclick="addRow(' + count + ')"><i class="mdi mdi-briefcase-plus"></i></button>' +
                        '</div> </td> ' +
                        ' <td>  <div class="form-group">' +
                        '<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +
                        '</div></td>' +

                        '</tr>';
                    if (tableLength > 0) {
                        $("#productTable tbody tr:last").after(tr);
                    } else {
                        $("#productTable tbody").append(tr);
                    }

                } // /success
            }); // get the product data

        } // /add row

        function removeProductRow(row = null) {
            if (row) {
                $("#row" + row).remove();


                subAmount();
            } else {
                alert('error! Refresh the page again');
            }
        }
    </script>

    <!--  -->


</body>

</html>