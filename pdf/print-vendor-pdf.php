<!DOCTYPE html>
<html lang="en">
<?php

include("../setting/checksession.php");
include("../setting/conn.php");

$date_report = date("d/m/Y");
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="main-css-href" rel="stylesheet" href="../css/style-pdf-customer.css" />
</head>

<?php

include("../setting/callcss.php");

?>

<style>
    .table-list {
        text-align: center;
        border-collapse: collapse;
        width: 100%;
        font-size: 23px;
    }

    .td-list,
    .th-list {
        border: 1px solid black;
        color: black;
    }

    .tr-list {
        outline: solid black;
    }



    .td-list-left {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
    }
</style>

<body onload="printdiv('divname')">
    <!-- <div class="page-wrapper"> -->
    <div class="row" id="divname" style="font-family: phetsarath OT;">
        <div class="col-12">


            <?php

            $i = 1;
            $all_page = count($_POST['check_box']);
            for ($x = 0; $x < count($_POST['check_box']); $x++) {
                $check_box = $_POST['check_box'][$x];
                // echo"$check_box";



                $vender_row = $conn->query(" SELECT  vendor_shop_name,vendor_code,company_register_code,vat_register_code,vendor_name,phone_office,phone_mobile,email,village,district_name,province_name,
                contact_type, DATE_FORMAT(contact_expire_date, '%d/%m/%Y') AS contact_expire_date,cash_type,term_payment,service_type,
                DATE_FORMAT(register_date, '%d/%m/%Y') AS register_date
                
                FROM tbl_vendor 
                where vendor_id = '$check_box' ")->fetch(PDO::FETCH_ASSOC);






            ?>

                <div>
                    <table width="100%" style="border:none;">

                        <tr>

                            <td align="left" width="10%"> <img src='../images/kpicon.png' width='175px' height='175px'></td>

                            <td align="center" class="h2">
                                <b> ໃບຂື້ນຖະບຽນຜູ້ຂາຍ
                                    <br> (Vender Registration Form)
                                </b>
                            </td>

                        </tr>

                    </table>
                </div>

                <div class="row">
                    <table class="table-list mr-4 ml-4 text-left">


                        <tr class="">
                            <td class="td-list text-center" colspan="4">ລາຍລະອຽດຜູ້ສະໜອງສິນຄ້າ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ຊື່ຮ້ານ / ບໍລິສັດ </p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['vendor_shop_name']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ເລກທະບຽນບໍລິສັດ</p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['company_register_code']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ເລກອາກອນຜູ້ເສຍພາສີ</p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['vat_register_code']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ຜູ້ຕິດຕໍ່ / ຊື່ຜູ້ມີອຳນາດສະເໜີຂາຍສິນຄ້າ</p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['vendor_name']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ເບີຕິດຕໍ່</p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php if ($vender_row['phone_office'] != '') {
                                                                echo "phone: " .    $vender_row['phone_office'];
                                                            } ?> <?php if ($vender_row['phone_mobile'] != '') {
                                                                        echo "mobile: " .    $vender_row['phone_mobile'];
                                                                    } ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Email</td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['email']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ທີ່ຢູ່ຮ້່ານ / ບໍລິສັດ</td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo "ບ້ານ " . $vender_row['village'] . "ເມືອງ " . $vender_row['district_name'] . "ແຂວງ " . $vender_row['province_name']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ສັນຍາຊື້ຂາຍ</p></td>
                            <td class="td-list" colspan="3">

                                <div class="custom-control custom-radio d-inline-block ml-3 ">
                                    <input type="radio" id="noncontact" name="contactRadio" value="non-contacted" class="custom-control-input" <?php if ($vender_row['contact_type'] == 'non-contacted') {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                    <label class="custom-control-label" for="noncontact">ບໍ່ມີສັນຍາ</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block ">
                                    <input type="radio" id="iscontact" name="contactRadio" value="contacted" class="custom-control-input" <?php if ($vender_row['contact_type'] == 'contacted') {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    <label class="custom-control-label" for="iscontact">ມີສັນຍາ ກຳນົດໄລຍະເວລາ</label>
                                </div>

                                <label for="firstName">ໝົດອາຍຸວັນທີ່ <?php echo  $vender_row['contact_expire_date']; ?></label>

                            </td>
                        </tr>
                        <tr class="">
                            <td class="td-list text-center" colspan="4">ລາຍລະອຽດຊຳລະເງິນ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list" rowspan="2"><p class="h4 ml-4">ປະເພດຊຳລະ</p></td>
                            <td class="td-list" colspan="3">
                                <div class="custom-control custom-radio d-inline-block ml-3">
                                    <input type="radio" id="cash" name="cashRadio" value="cash" class="custom-control-input" <?php if ($vender_row['cash_type'] == 'cash') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="custom-control-label" for="cash">ເງິນສົດ</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="td-list" colspan="3">
                                <div class="custom-control custom-radio d-inline-block ml-3">
                                    <input type="radio" id="queck" name="cashRadio" value="queck" class="custom-control-input" <?php if ($vender_row['cash_type'] == 'queck') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="custom-control-label" for="queck">ແຊັກຈ່າຍໃນນາມ</label>
                                </div>
                            </td>
                        </tr>

                        <tr class="">
                            <td class="td-list" rowspan="10"><p class="h4 ml-4">ໂອນຊຳລະເງິນ</p></td>
                        </tr>

                        <?php

                        $lak_row = $conn->query(" 
                        select * from tbl_vendor_bank_account
                        where vendor_id = '$check_box' and account_currency ='lak' ")->fetch(PDO::FETCH_ASSOC);


                        if (empty($lak_row['bank_name'])) {
                            $lak_bank_name = "";
                        } else {
                            $lak_bank_name = $lak_row['bank_name'];
                        }

                        if (empty($lak_row['bank_account_name'])) {
                            $lak_bank_account_name = "";
                        } else {
                            $lak_bank_account_name = $lak_row['bank_account_name'];
                        }


                        if (empty($lak_row['bank_account_number'])) {
                            $lak_bank_account_number = "";
                        } else {
                            $lak_bank_account_number = $lak_row['bank_account_number'];
                        }


                        ?>
                        <tr class="">
                            <td class="td-list" rowspan="3"><p class="h4 ml-3">KIP</p></td>
                            <td class="td-list"><p class="h4 ml-4">Bank Name</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$lak_bank_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account Name</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$lak_bank_account_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account NO</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$lak_bank_account_number"; ?></p></td>
                        </tr>



                        <?php

                        $thb_row = $conn->query(" 
                        select * from tbl_vendor_bank_account
                        where vendor_id = '$check_box' and account_currency ='thb' ")->fetch(PDO::FETCH_ASSOC);


                        if (empty($thb_row['bank_name'])) {
                            $thb_bank_name = "";
                        } else {
                            $thb_bank_name = $thb_row['bank_name'];
                        }

                        if (empty($thb_row['bank_account_name'])) {
                            $thb_bank_account_name = "";
                        } else {
                            $thb_bank_account_name = $thb_row['bank_account_name'];
                        }


                        if (empty($thb_row['bank_account_number'])) {
                            $thb_bank_account_number = "";
                        } else {
                            $thb_bank_account_number = $thb_row['bank_account_number'];
                        }


                        ?>
                        <tr class="">
                            <td class="td-list" rowspan="3"><p class="h4 ml-3">THB</p></td>
                            <td class="td-list"><p class="h4 ml-4">Bank Name</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$thb_bank_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account Name</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$thb_bank_account_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account NO</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$thb_bank_account_number"; ?></p></td>
                        </tr>


                        <?php

                        $usd_row = $conn->query(" 
                        select * from tbl_vendor_bank_account
                        where vendor_id = '$check_box' and account_currency ='usd' ")->fetch(PDO::FETCH_ASSOC);


                        if (empty($usd_row['bank_name'])) {
                            $usd_bank_name = "";
                        } else {
                            $usd_bank_name = $usd_row['bank_name'];
                        }

                        if (empty($usd_row['bank_account_name'])) {
                            $usd_bank_account_name = "";
                        } else {
                            $usd_bank_account_name = $usd_row['bank_account_name'];
                        }


                        if (empty($usd_row['bank_account_number'])) {
                            $usd_bank_account_number = "";
                        } else {
                            $usd_bank_account_number = $usd_row['bank_account_number'];
                        }


                        ?>
                        <tr class="">
                            <td class="td-list" rowspan="3"><p class="h4 ml-3">USD</p></td>
                            <td class="td-list"><p class="h4 ml-4">Bank Name</p></td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$usd_bank_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account Name</td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$usd_bank_account_name"; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">Account NO</td>
                            <td class="td-list"><p class="h4 ml-4"><?php echo "$usd_bank_account_number"; ?></p></td>
                        </tr>




                        <tr class="">
                            <td class="td-list"><p class="h4 ml-4">ເງື່ອນໄຂການໃຫ້ເຄຣດິດ (ຕິດໜີ້)</p></td>
                            <td class="td-list" colspan="3"><p class="h4 ml-4"><?php echo $vender_row['term_payment']; ?></p></td>
                        </tr>
                        <tr class="">
                            <td class="td-list text-center" colspan="4">ລາຍລະອຽດຜູ້ສະໜອງສິນຄ້າ ແລະ ບໍລິການ</td>
                        </tr>

                        <tr class="">
                            <td class="td-list">

                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="sale" name="cashRadio" value="sale" class="custom-control-input" <?php if ($vender_row['service_type'] == "sale") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                    <label class="custom-control-label" for="sale">ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ</label>
                                </div>

                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="office" name="cashRadio" value="office" class="custom-control-input" <?php if ($vender_row['service_type'] == "office") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                    <label class="custom-control-label" for="office">ເຄື່ອງໃຊ້ສຳນັກງານ</label>
                                </div>

                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="market" name="cashRadio" value="market" class="custom-control-input" <?php if ($vender_row['service_type'] == "market") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                    <label class="custom-control-label" for="market">ການວ່າຈ້າງເພື່ອການຕະຫຼາດ</label>
                                </div>



                            </td>
                            <td class="td-list " colspan="3">

                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="furniture" name="cashRadio" value="furniture" class="custom-control-input" <?php if ($vender_row['service_type'] == "furniture") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                                    <label class="custom-control-label" for="furniture">Furniture ແລະ ອຸປະກອນຕົກແຕ່ງ</label>
                                </div>


                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="electronic" name="cashRadio" value="electronic" class="custom-control-input" <?php if ($vender_row['service_type'] == "electronic") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    <label class="custom-control-label" for="electronic">ອຸປະກອນອິເລັກໂທນິກ</label>
                                </div>


                                <div class="custom-control custom-radio ml-3">
                                    <input type="radio" id="contractor" name="cashRadio" value="contractor" class="custom-control-input" <?php if ($vender_row['service_type'] == "contractor") {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?>>
                                    <label class="custom-control-label" for="contractor">ການວ່າຈ້າງ ແລະ ຮັບເໝົາ </label>
                                </div>


                            </td>
                        </tr>


                    </table>
                    <table class="table-list   mr-4 ml-4 text-center">
                        <tr class="">
                            <td class="td-list" width="25%">
                                Prepared <br>
                                ໜ່ວຍງານຈັດຊື້ຕົ້ນສັງກັດ
                            </td>
                            <td class="td-list" width="25%">
                                Checked by <br>
                                ໜ່ວຍງານຈັດຊື້ກາງ
                            </td>
                            <td class="td-list" width="25%">
                                Approved <br>
                                GM / VP / SVP / EVP
                            </td>
                            <td class="td-list" width="25%">
                                Acknowledge <br>
                                Account
                            </td>
                        </tr>
                        <tr class="">
                            <td class="td-list"><br><br><br></td>
                            <td class="td-list"></td>
                            <td class="td-list"></td>
                            <td class="td-list"></td>
                        </tr>

                    </table>
                </div>

                <br>
                <table width="100% ">
                    <tr class="h4">
                        <td class="td-list" width="20%"><p class="h4 ml-4">ໜ່ວຍງານ ICT</p></td>
                        <td class="td-list" width="30%"> <p class="h4 ml-4">ລະຫັດຜູ້ຂາຍ <?php echo $vender_row['vendor_code'];?></p></td>
                        <td class="td-list" width="30%"><p class="h4 ml-4">ລາຍເຊັນ</p></td>
                        <td class="td-list" width="20%"><p class="h4 ml-4">ວັນທີ <?php echo $vender_row['register_date'];?></p></td>
                    </tr>

                </table>
                <br><br>
                <table width="100%" style="border:none;">
                    <tr>

                        <td align="right">
                            <p align="right" class="h2"> FM-GA-HR-PC-01-07<br>19/07/17-00</p>
                        </td>
                </table>

            <?php
                $i++;
            }

            ?>



            <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>

    <!-- /row -->
    <!-- </div> -->
    <!-- </div> -->
    <script type="text/javascript">
        // window.print();
        function printdiv(divname) {
            var printContents = document.getElementById('divname').innerHTML;
            var roiginalContents = document.body.innerHTML;
            setTimeout(function() {
                this.close();
            }, 1000);

            window.print();
            document.body.innerHTML = roiginalContents;
        }
    </script>
    <!-- <script>
		
		 window.close()
		 
	</script> -->
</body>

</html>