<?php
include("../setting/checksession.php");
include("../setting/conn.php");


$header_name = "ເພີ່ມລູກຄ້າ";
$header_click = "1";

?>



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

        $('#Acc_id').change(function() {
            var Acc_id = $('#Acc_id').val();
            $.post('../function/dynamic_dropdown/get_team_provice_code.php', {
                    Acc_id: Acc_id
                },
                function(output) {
                    $('#tmpv_code').html(output).show();
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




                            <div class="">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark">ເພິ່ມລູກຄ້າ</h4>



                                    </div>
                                    <form method="post" id="addcutomerFrm">

                                        <div class="row">

                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label for="firstName">ປະເພດລູກຄ້າ</label>
                                                    <input type="text" class="form-control" id="custype" name="custype" required>
                                                </div>
                                            </div>



                                            <div class="form-group  col-lg-5">
                                                <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="Acc_id" id="Acc_id">
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
                                            </div>

                                            <div name="tmpv_code" id="tmpv_code" class="col-lg-5">

                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</label>
                                                    <input type="text" class="form-control" id="shopname" name="shopname" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ເລກທະບຽນບໍລິສັດ</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ເລກອາກອນຜູ້ເສຍພາສີ</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ຜູ້ຕິດຕໍ່ / ຊື່ຜູ້ມີອໍານາດສະເໜີຂາຍສິນຄ້າ</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ເບີຕິດຕໍ່ / Office </label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ເບີຕິດຕໍ່ / Mobile</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">Email</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ທີ່ຢູ່ຮ້ານ / ບໍລິສັດ</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>


                                        </div>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="firstName">ສັນຍາການຊື້-ຂາຍ</label>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderM" name="customRadio" value="M" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderM">ບໍ່ມີສັນຍາ</label>
                                                </div>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderF" name="customRadio" value="F" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderF">ມີສັນຍາ</label>
                                                </div>


                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ກໍານົດໄລຍະເວລາ</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">ໝົດອາຍຸວັນທີ</label>
                                                    <input type="date" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="firstName">ລາຍລະອຽດການຊໍາລະເງິນ</label>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderM" name="customRadio" value="M" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderM">ເງິນສົດ</label>
                                                </div>

                                                <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                    <input type="radio" id="genderF" name="customRadio" value="F" class="custom-control-input">
                                                    <label class="custom-control-label" for="genderF">ເຊັກສັ່ງຈ່າຍໃນນາມ</label>
                                                </div>


                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">Bank Name</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">Account Name</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="firstName">Account No.</label>
                                                    <input type="text" class="form-control" id="identid" name="identid">
                                                </div>
                                            </div>

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
                                                    <input type="number" class="form-control" id="creditvalues" step="any" name="creditvalues" value="0">
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






                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມລູກຄ້າ</button>
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
        // add Customer Data 
        $(document).on("submit", "#addcutomerFrm", function() {
            $.post("../query/addcutomer.php", $(this).serialize(), function(data) {
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
                        'ກະລຸນາເລືອກລະຫັດທີມ',
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
                                window.location.href = 'customer.php';
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