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



        $('#province_id').change(function() {
            var pv_id = $('#province_id').val();
            $.post('../function/dynamic_dropdown/get_district_name.php', {
                    pv_id: pv_id
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



                            <div class="    ">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 text-center ">
                                        <h2 class="text-dark">ຂື້ນຖະບຽນຜູ້ຂາຍ</h2>
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
                                                                            <select class=" form-control font" name="Acc_id" >
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
                                                                            <input type="text" class="form-control"  name="shopname" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">ເລກທະບຽນບໍລິສັດ</label>
                                                                            <input type="text" class="form-control"  name="company_reg_number" required>
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
                                                                            <input type="text" class="form-control"   name="contact_name" required>
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
                                                                            <select class=" form-control font" name="province_id" id ="province_id" >
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

                                                                    <div class="form-group col-lg-4">
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
                                                                                                <select class=" form-control font" name="ccy" id="ccy">
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
                                                                                                <select class=" form-control font" name="bank_code" id="bank_code">
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
                                                                                                <input type="text" step="any" name="itemcode[]" id="itemcode<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group  col-lg-9">
                                                                                            <label class="text-dark font-weight-medium">ເລກບັນຊີ</label>
                                                                                            <div class="form-group">
                                                                                                <input type="text" step="any" name="itemcode[]" id="itemcode<?php echo $x; ?>" autocomplete="off" class="form-control" />
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
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມລະຫັດສິນຄ້າ</button>
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
                                        <th>ເລກເອກະສານ</th>
                                        <th>ກຸ່ມສິນຄ້າ</th>
                                        <th>ລາຍການຂໍ</th>
                                        <th>ສະກຸນເງິນ</th>

                                        <th>ປະເພດລາຄາ(ຮ້ານ)</th>
                                        <th>ວັນທີນຳໃຊ້</th>
                                        <th>ວັງທີລົງທະບຽນ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare(" 

									SELECT count(icl_id) as count_list,a.it_id,b.date_register as date_register,ccy,name_company,pricelist_name,date_use
									FROM tbl_item_code_list a 
									left join tbl_item_code b on a.it_id = b.it_id 
									left join tbl_item_company_code c on b.icc_id = c.icc_id 
									left join tbl_price_list d on b.pl_id = d.pl_id
									where add_by ='$id_users'
									group by a.it_id ");
                                    $stmt4->execute();

                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $name_company = $row4['name_company'];
                                            $date_use = $row4['date_use'];
                                            $count_list = $row4['count_list'];
                                            $it_id = $row4['it_id'];
                                            $ccy = $row4['ccy'];
                                            $pricelist_name = $row4['pricelist_name'];
                                            $date_register = $row4['date_register'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$it_id"; ?></td>
                                                <td><?php echo "$name_company"; ?></td>
                                                <td><?php echo "$count_list"; ?></td>
                                                <td><?php echo "$ccy"; ?></td>
                                                <td><?php echo "$pricelist_name"; ?></td>
                                                <td><?php echo "$date_use"; ?></td>
                                                <td><?php echo "$date_register"; ?></td>




                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-item.php?item_id=<?php echo "$it_id"; ?>">ແກ້ໄຂ</a>

                                                            <a class="dropdown-item" type="button" id="deleteitem" data-id='<?php echo $row4['it_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
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
                                window.location.href = 'items.php';
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
                        '<select class=" form-control font" name="itemcode[]" id="itemcode' + count + '">' +
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


                        '<select class="form-control" name="sale_unit[]" id="sale_unit' + count + '" >' +
                        '<option value="">ເລືອກທະນາຄານ</option>';
                    $.each(response, function(index, value) {
                        tr += '<option value="' + value[1] + '">' + value[1] + '</option>';
                    });
                    tr += '</select>' +

                        '</div>' +
                        '</div>' +

                        '<div class="col-lg-5">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ຊື່ບັນຊີ</label>' +
                        '<input type="number" name="pack[]" id="pack' + count + '" autocomplete="off" class="form-control" />' +
                        '</div>' +
                        '</div>' +

                        '<div class="col-lg-9">' +
                        '<div class="form-group">' +
                        '<label for="firstName">ເລກບັນຊີ</label>' +
                        '<input type="text" name="weight[]" id="weight' + count + '" autocomplete="off" class="form-control" />' +
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