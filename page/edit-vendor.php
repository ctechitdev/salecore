<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$vendor_id = $_GET['vendor_id'];


$header_name = "ຜູ້ສະໜອງ";
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
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script>
        $(function() {

            $('#province_name').change(function() {
                var province_name = $('#province_name').val();
                $.post('../function/dynamic_dropdown/get_district_name_by_name.php', {
                        province_name: province_name
                    },
                    function(output) {
                        $('#district_name').html(output).show();
                    });
            });


        });
    </script>
</head>


<body class="navbar-fixed sidebar-fixed" id="body">




    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php
            $header_name = "ລະຫັດສິນຄ້າ";
            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">

                    <div class="email-wrapper rounded border bg-white">
                        <div class="row no-gutters justify-content-center">



                            <div class="    ">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-6 ">
                                        <h4 class="text-dark">ເພິ່ມລະຫັດສິນຄ້າ</h4>

                                    </div>
                                    <form method="post" id="edititemfrm">

                                        <div class="row">



                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-title">

                                                    </div>
                                                    <div id="add-brand-messages"></div>
                                                    <div class="card-body">
                                                        <div class="input-states">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <?php

                                                                    $vender_row = $conn->query("SELECT  * FROM tbl_vendor where vendor_id = '$vendor_id' ")->fetch(PDO::FETCH_ASSOC);
                                                                    $acc_code = $vender_row['acc_code'];
                                                                    $province_name = $vender_row['province_name'];
                                                                    $district_name = $vender_row['district_name'];
                                                                    ?>

                                                                    <input type="hidden" class="form-control" id="vendor_id" name="vendor_id" autocomplete="off" value="<?php echo $vendor_id ?>" />

                                                                    <div class="form-group  col-lg-12 text-center">
                                                                        <label class="text-dark font-weight-medium">
                                                                            <h2> ລະຫັດຜູ້ສະໜອງ: <?php echo $vender_row['vendor_code'];; ?></h2>
                                                                        </label>

                                                                    </div>



                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</label>
                                                                            <input type="text" class="form-control" name="shopname" value='<?php echo $vender_row['vendor_shop_name']; ?>' required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເລກທະບຽນບໍລິສັດ</label>
                                                                            <input type="text" class="form-control" name="company_reg_number" value='<?php echo $vender_row['company_register_code']; ?>' required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເລກອາກອນຜູ້ເສບພາສີ</label>
                                                                            <input type="text" class="form-control" name="vat_reg_number" value='<?php echo $vender_row['vat_register_code']; ?>' required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ຜູ້ຕິດຕໍ່</label>
                                                                            <input type="text" class="form-control" name="contact_name" value='<?php echo $vender_row['vendor_name']; ?>' required>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເບີຕິດຕໍ່ (Office)</label>
                                                                            <input type="text" class="form-control" name="phone_office" value='<?php echo $vender_row['phone_office']; ?>'>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເບີຕິດຕໍ່ (Mobile)</label>
                                                                            <input type="text" class="form-control" name="phone_mobile" value='<?php echo $vender_row['phone_mobile']; ?>'>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">Email</label>
                                                                            <input type="text" class="form-control" name="email" value='<?php echo $vender_row['email']; ?>'>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group  col-lg-4">
                                                                        <label class="text-dark font-weight-medium">ແຂວງ</label>
                                                                        <div class="form-group">
                                                                            <select class=" form-control font" name="province_name" id="province_name">
                                                                                <option value=""> ເລືອກແຂວງ </option>
                                                                                <?php
                                                                                $stmt = $conn->prepare(" SELECT pv_id,pv_name FROM tbl_provinces order by pv_name");
                                                                                $stmt->execute();
                                                                                if ($stmt->rowCount() > 0) {
                                                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                                ?> <option value="<?php echo $row['pv_name']; ?>" <?php if ($row['pv_name'] ==  $province_name) {
                                                                                                                                    echo "selected";
                                                                                                                                } ?>> <?php echo $row['pv_name']; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-lg-4">
                                                                        <label class="text-dark font-weight-medium">ເມືອງ</label>
                                                                        <div class="form-group">

                                                                            <select class="form-control  font" name="district_name" id="district_name">
                                                                                <option value=""> ເລືອກເມືອງ </option>
                                                                                <?php
                                                                                $stmt2 = $conn->prepare("SELECT dis_id,distict_name
                                                                                FROM tbl_districts a
                                                                                left join tbl_provinces b on a.pv_id = b.pv_id
                                                                                where pv_name  = '$province_name' order by distict_name  ");
                                                                                $stmt2->execute();
                                                                                if ($stmt2->rowCount() > 0) {

                                                                                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                                                        $edit_dt_id = $row2["distict_name"];
                                                                                ?> <option value='<?php echo $row2["dis_id"];  ?>' <?php if ($district_name == "$edit_dt_id") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>> <?php echo $row2['distict_name'];  ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName"> ບ້ານ </label>
                                                                            <input type="text" class="form-control" name="village_name" value='<?php echo $vender_row['village']; ?>'>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <label for="firstName">ສັນຍາການຊື້ຂາຍ</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="noncontact" name="contactRadio" value="non-contacted" class="custom-control-input" <?php if ($vender_row['contact_type'] == "non-contacted") {
                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                            } ?>>
                                                                                <label class="custom-control-label" for="noncontact">ບໍ່ມີສັນຍາ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <label for="firstName">ສັນຍາການຊື້ຂາຍ</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="iscontact" name="contactRadio" value="contacted" class="custom-control-input" <?php if ($vender_row['contact_type'] == "contacted") {
                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                        } ?>>
                                                                                <label class="custom-control-label" for="iscontact">ມີສັນຍາ ກຳນົດໄລຍະເວລາ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ໝົດອາຍຸວັນທີ່</label>
                                                                            <input type="date" class="form-control" id="contact_expire_date" name="contact_expire_date" value='<?php echo $vender_row['contact_expire_date']; ?>'>
                                                                        </div>
                                                                    </div>






                                                                </div>

                                                                <div class="row text-center mt-5">


                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="cash" name="cashRadio" value="cash" class="custom-control-input" <?php if ($vender_row['cash_type'] == "cash") {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                                <label class="custom-control-label" for="cash">ເງິນສົດ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="queck" name="cashRadio" value="queck" class="custom-control-input" <?php if ($vender_row['cash_type'] == "queck") {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?>>
                                                                                <label class="custom-control-label" for="queck">ແຊັກ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <table class="table" id="productTable">

                                                            <tbody>
                                                                <?php
                                                                $arrayNumber = 0;

                                                                $stmt3 = $conn->prepare(" SELECT * FROM tbl_vendor_bank_account where vendor_id ='$vendor_id' ");
                                                                $stmt3->execute();
                                                                $x = 1;
                                                                if ($stmt3->rowCount() > 0) {
                                                                    while ($row_list = $stmt3->fetch(PDO::FETCH_ASSOC)) {


                                                                ?>


                                                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

                                                                            <td>

                                                                                <div class="form-group "><?php echo "ບັນຊີທີ: $x"; ?> <br>
                                                                                    <div class="row p-2">

                                                                                        <div class="form-group  col-lg-3">
                                                                                            <label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
                                                                                            <div class="form-group">
                                                                                                <select class=" form-control font" name="ccy[]" id="ccy<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກສະກຸນເງິນ </option>
                                                                                                    <option value="kip" <?php if ($row_list['account_currency'] == "kip") {
                                                                                                                            echo "selected";
                                                                                                                        } ?>> KIP </option>
                                                                                                    <option value="thb" <?php if ($row_list['account_currency'] == "thb") {
                                                                                                                            echo "selected";
                                                                                                                        } ?>> THB </option>
                                                                                                    <option value="usd" <?php if ($row_list['account_currency'] == "usd") {
                                                                                                                            echo "selected";
                                                                                                                        } ?>> USD </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-lg-4">
                                                                                            <div class="form-group">
                                                                                                <label for="firstName">ທະນາຄານ</label>
                                                                                                <select class=" form-control font" name="bank_code[]" id="bank_code<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກທະນາຄານ </option>

                                                                                                    <?php

                                                                                                    $stmt1 = $conn->prepare("  select * from tbl_bank_code ");
                                                                                                    $stmt1->execute();
                                                                                                    if ($stmt1->rowCount() > 0) {
                                                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                    ?> <option value="<?php echo $row1['bc_code']; ?>" <?php if ($row1['bc_code'] == $row_list['bank_name']) {
                                                                                                                                                            echo "selected";
                                                                                                                                                        } ?>> <?php echo $row1['bc_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }

                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-5">
                                                                                            <label class="text-dark font-weight-medium">ຊື່ບັນຊີ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" step="any" name="bank_account_name[]" id="bank_account_name<?php echo $x; ?>" autocomplete="off" class="form-control" value='<?php echo $row_list['bank_account_name']; ?>' />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-9">
                                                                                            <label class="text-dark font-weight-medium">ເລກບັນຊີ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" step="any" name="bank_account_number[]" id="bank_account_number<?php echo $x; ?>" autocomplete="off" class="form-control" value='<?php echo $row_list['bank_account_number']; ?>' />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end mt-2 ">

                                                                                            <div class="form-group p-4">
                                                                                                <button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading...">
                                                                                                    <i class="mdi mdi-briefcase-plus"></i>
                                                                                                </button>
                                                                                            </div>


                                                                                            <div class="form-group p-4">
                                                                                                <button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)">
                                                                                                    <i class="mdi mdi-briefcase-remove"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $arrayNumber++;
                                                                        $x++;
                                                                    }
                                                                } else {

                                                                    $arrayNumber = 0;
                                                                    for ($x = 1; $x < 2; $x++) { ?>
                                                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

                                                                            <td>

                                                                                <div class="form-group "><?php echo "ບັນຊີທີ: $x"; ?> <br>
                                                                                    <div class="row p-2">

                                                                                        <div class="form-group  col-lg-3">
                                                                                            <label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
                                                                                            <div class="form-group">
                                                                                                <select class=" form-control font" name="ccy[]" id="ccy<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກສະກຸນເງິນ </option>
                                                                                                    <option value="kip"> KIP </option>
                                                                                                    <option value="thb"> THB </option>
                                                                                                    <option value="usd"> USD </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-lg-4">
                                                                                            <div class="form-group">
                                                                                                <label for="firstName">ທະນາຄານ</label>
                                                                                                <select class=" form-control font" name="bank_code[]" id="bank_code<?php echo $x; ?>">
                                                                                                    <option value=""> ເລືອກທະນາຄານ </option>

                                                                                                    <?php

                                                                                                    $stmt1 = $conn->prepare("  select * from tbl_bank_code ");
                                                                                                    $stmt1->execute();
                                                                                                    if ($stmt1->rowCount() > 0) {
                                                                                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                                                                                    ?> <option value="<?php echo $row1['bc_code']; ?>"> <?php echo $row1['bc_name']; ?></option>
                                                                                                    <?php
                                                                                                        }
                                                                                                    }

                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-5">
                                                                                            <label class="text-dark font-weight-medium">ຊື່ບັນຊີ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" step="any" name="bank_account_name[]" id="bank_account_name<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-9">
                                                                                            <label class="text-dark font-weight-medium">ເລກບັນຊີ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" step="any" name="bank_account_number[]" id="bank_account_number<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end mt-2 ">

                                                                                            <div class="form-group p-4">
                                                                                                <button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading...">
                                                                                                    <i class="mdi mdi-briefcase-plus"></i>
                                                                                                </button>
                                                                                            </div>


                                                                                            <div class="form-group p-4">
                                                                                                <button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)">
                                                                                                    <i class="mdi mdi-briefcase-remove"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>




                                                                                </div>




                                                                            </td>
                                                                        </tr>

                                                                <?php
                                                                        $arrayNumber++;
                                                                    }
                                                                }
                                                                ?>



                                                            </tbody>
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂຂໍ້ມູນ</button>
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
                                        <th>ເລກທີ</th>
                                        <th>ລະຫັດຜູ້ສະໜອງ</th>
                                        <th>ຊື່ຜູ້ສະໜອງ</th>
                                        <th>ຊື່ຮ້ານ</th>
                                        <th>ເບີຕິດຕໍ່</th>
                                        <th>ກຸ່ມສິນຄ້າ</th>
                                        <th>ວັນລົງທະບຽນ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare(" 

									SELECT vendor_id,a.vendor_code,vendor_name,vendor_shop_name,phone_office,register_date,acc_name
                                    FROM tbl_vendor a
                                    left join tbl_account_company b on a.acc_code = b.company_code
                                    where add_by = '$id_users'
									order by vendor_id desc  ");
                                    $stmt4->execute();

                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $vendor_id = $row4['vendor_id'];
                                            $vendor_code = $row4['vendor_code'];
                                            $vendor_name = $row4['vendor_name'];
                                            $vendor_shop_name = $row4['vendor_shop_name'];
                                            $phone_office = $row4['phone_office'];
                                            $acc_name = $row4['acc_name'];
                                            $register_date = $row4['register_date'];


                                    ?>



                                            <tr>
                                                <td><?php echo "$vendor_id"; ?></td>
                                                <td><?php echo "$vendor_code"; ?></td>
                                                <td><?php echo "$vendor_name"; ?></td>
                                                <td><?php echo "$vendor_shop_name"; ?></td>
                                                <td><?php echo "$phone_office"; ?></td>
                                                <td><?php echo "$acc_name"; ?></td>
                                                <td><?php echo "$register_date"; ?></td>




                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-vendor.php?vendor_id=<?php echo "$vendor_id"; ?>">ແກ້ໄຂ</a>

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
        $(document).on("submit", "#edititemfrm", function() {
            $.post("../query/edit-vendor.php", $(this).serialize(), function(data) {
                if (data.res == "invalid") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາຕື່ມຂໍ້ມູນໄຫ້ຄົບຖ້ວນ',
                        'error'
                    )
                } else if (data.res == "success") {

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
            }, 'json');

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
                url: '../query/dropdown/bank_drop_down.php',
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $("#addRowBtn").button("reset");



                    var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +


                        '<td>' +







                        '<div class="form-group">ບັນຊີທີ: ' + count +
                        '<div class="row p-2">' +
                        '<div class="form-group  col-lg-3">' +
                        '<label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>' +
                        '<div class="form-group">' +
                        '<select class=" form-control font" name="ccy[]" id="ccy' + count + '">' +
                        '<option value=""> ເລືອກສະກຸນເງິນ </option>' +
                        '<option value="kip"> KIP </option>' +
                        '<option value="thb"> THB </option>' +
                        '<option value="usd"> USD </option>' +
                        '</select>' +
                        '</div>' +
                        '</div>' +


                        '<div class="col-lg-4">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ເລືອກທະນາຄານ</label>' +


                        '<select class="form-control" name="bank_code[]" id="bank_code' + count + '" >' +
                        '<option value="">ເລືອກທະນາຄານ</option>';
                    $.each(response, function(index, value) {
                        tr += '<option value="' + value[2] + '">' + value[1] + '</option>';
                    });
                    tr += '</select>' +

                        '</div>' +
                        '</div>' +

                        '<div class="col-lg-5">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ຊື່ບັນຊີ</label>' +
                        '<input type="text" name="bank_account_name[]" id="bank_account_name' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-lg-9">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ເລກບັນຊີ</label>' +
                        '<input type="text" name="bank_account_number[]" id="bank_account_number' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +


                        '<div class="d-flex justify-content-end mt-2 ">' +

                        '<div class="form-group p-4">' +
                        '<button class="btn btn-primary removeProductRowBtn" type="button" onclick="addRow(' + count + ')"><i class="mdi mdi-briefcase-plus"></i></button>' +
                        '</div>' +


                        '<div class="form-group p-4">' +
                        '<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +

                        '</div>' +
                        '</div>' +




                        '</div>' +
                        '</div>' +



                        '</td>' +


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