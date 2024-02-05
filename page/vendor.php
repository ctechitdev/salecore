<?php
include("../setting/checksession.php");
include("../setting/conn.php");

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


</head>
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



                            <div class="    ">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 text-center ">
                                        <h2 class="text-dark">ໃບຂື້ນຖະບຽນຜູ້ຂາຍ</h2>
                                    </div>
                                    <form method="post" id="addvendorform">
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


                                                                    <div class="form-group  col-lg-12">
                                                                        <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມລູກຄ້າ</label>
                                                                        <div class="form-group">
                                                                            <select class=" form-control font" name="Acc_id">
                                                                                <option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>

                                                                                <?php


                                                                                $stmt1 = $conn->prepare(" SELECT company_code ,concat(acc_name ,' (',vendor_code, ') ') as full_code 
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



                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</label>
                                                                            <input type="text" class="form-control" name="shopname" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເລກທະບຽນບໍລິສັດ</label>
                                                                            <input type="text" class="form-control" name="company_reg_number" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເລກອາກອນຜູ້ເສບພາສີ</label>
                                                                            <input type="text" class="form-control" name="vat_reg_number" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ຜູ້ຕິດຕໍ່</label>
                                                                            <input type="text" class="form-control" name="contact_name" required>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເບີຕິດຕໍ່ (Office)</label>
                                                                            <input type="text" class="form-control" name="phone_office">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເບີຕິດຕໍ່ (Mobile)</label>
                                                                            <input type="text" class="form-control" name="phone_mobile">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">Email</label>
                                                                            <input type="text" class="form-control" name="email">
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
                                                                                ?> <option value="<?php echo $row['pv_name']; ?>"> <?php echo $row['pv_name']; ?></option>
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
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName"> ບ້ານ </label>
                                                                            <input type="text" class="form-control" name="village_name">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <label for="firstName">ສັນຍາການຊື້ຂາຍ</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="noncontact" name="contactRadio" value="non-contacted" class="custom-control-input">
                                                                                <label class="custom-control-label" for="noncontact">ບໍ່ມີສັນຍາ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-4">
                                                                        <label for="firstName">ສັນຍາການຊື້ຂາຍ</label>
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="iscontact" name="contactRadio" value="contacted" class="custom-control-input">
                                                                                <label class="custom-control-label" for="iscontact">ມີສັນຍາ ກຳນົດໄລຍະເວລາ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ໝົດອາຍຸວັນທີ່</label>
                                                                            <input type="date" class="form-control" id="contact_expire_date" name="contact_expire_date">
                                                                        </div>
                                                                    </div>






                                                                </div>

                                                                <div class="row text-center mt-5">


                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="cash" name="cashRadio" value="cash" class="custom-control-input">
                                                                                <label class="custom-control-label" for="cash">ເງິນສົດ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-lg-5">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="queck" name="cashRadio" value="queck" class="custom-control-input">
                                                                                <label class="custom-control-label" for="queck">ແຊັກ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div class="col-lg-12">
                                                                    <label class="text-dark font-weight-medium">ຈຳນວນວັນຕິດໜີ້</label>
                                                                    <div class="form-group">
                                                                        <select class=" form-control font" name="payment_term"  >
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

                                                                <div class="col-lg-12 text-center">
                                                                    <div class="form-group">
                                                                        <label for="firstName">ລາຍລະອຽດຂອງສິນຄ້າ ແລະ ບໍລິການ</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row  ">



                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="sale" name="ServiceRadio" value="sale" class="custom-control-input">
                                                                                <label class="custom-control-label" for="sale">ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="office" name="ServiceRadio" value="office" class="custom-control-input">
                                                                                <label class="custom-control-label" for="office">ເຄື່ອງໃຊ້ສຳນັກງານ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="market" name="ServiceRadio" value="market" class="custom-control-input">
                                                                                <label class="custom-control-label" for="market">ການວ່າຈ້າງເພື່ອການຕະຫຼາດ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="furniture" name="ServiceRadio" value="furniture" class="custom-control-input">
                                                                                <label class="custom-control-label" for="furniture">Furniture ແລະ ອຸປະກອນຕົກແຕ່ງ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="electronic" name="ServiceRadio" value="electronic" class="custom-control-input">
                                                                                <label class="custom-control-label" for="electronic">ອຸປະກອນອິເລັກໂທນິກ</label>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                                                                <input type="radio" id="contractor" name="ServiceRadio" value="contractor" class="custom-control-input">
                                                                                <label class="custom-control-label" for="contractor">ການວ່າຈ້າງ ແລະ ຮັບເໝົາ </label>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="firstName">ກະລຸນາລະບຸລາຍລະອຽດຂອງສິນຄ້າ ແລະ ບໍລິການ</label>
                                                                        <textarea class="form-control" name="service_detail" cols="30" rows="3"></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="firstName">ການຈັດສົ່ງສິນຄ້າ</label>
                                                                        <textarea class="form-control" name="transport_detail"  cols="30" rows="3"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <table class="table" id="productTable">

                                                                <tbody>
                                                                    <?php
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
                                                                    } // /for
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end mt-6">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຂໍ້ມູນ</button>
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

                                                            <a class="dropdown-item" type="button" id="deleteitem" data-id='<?php echo $row4['vendor_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
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
        // add item Data 
        $(document).on("submit", "#addvendorform", function() {
            $.post("../query/add-vendor.php", $(this).serialize(), function(data) {
                if (data.res == "invalid") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາຕື່ມຂໍ້ມູນໄຫ້ຄົບຖ້ວນ',
                        'error'
                    )
                } else if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ລົງທະບຽນສຳເລັດ',
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
                url: "../query/delete-vendor.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລືຶບຂໍ້ມູນສຳເລັດ',
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