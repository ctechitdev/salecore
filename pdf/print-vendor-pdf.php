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

    }

    .tr-list {
        outline: thin solid;
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



                $vender_row = $conn->query(" SELECT  * FROM tbl_vendor where vendor_id = '$check_box' ")->fetch(PDO::FETCH_ASSOC);



                $vendor_shop_name = $vender_row['vendor_shop_name'];



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
                    <table class="table-list text-center m-5">


                        <tr class="">
                            <td class="td-list" colspan="4">ລາຍລະອຽດຜູ້ສະໜອງສິນຄ້າ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ຊື່ຮ້ານ / ບໍລິສັດ</td>
                            <td class="td-list" colspan="3">ຊື່ຮ້ານ / ບໍລິສັດ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ເລກທະບຽນບໍລິສັດ</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ເລກອາກອນຜູ້ເສຍພາສີ</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ຜູ້ຕິດຕໍ່ / ຊື່ຜູ້ມີອຳນາດສະເໜີຂາຍສິນຄ້າ</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ເບີຕິດຕໍ່</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ທີ່ຢູ່ຮ້່ານ / ບໍລິສັດ</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list">ສັນຍາຊື້ຂາຍ</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list" colspan="4">ລາຍລະອຽດຜູ້ສະໜອງສິນຄ້າ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list" rowspan="2">ຜູ້ປະເມີນ</td>
                            <td class="td-list" colspan="3"> ເງີນສົດ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list" colspan="3">ເຊັກສັ່ງຈ່າຍໃນນາມ</td>
                        </tr>

                        <tr class="">
                            <td class="td-list" rowspan="10">ໂອນຊຳລະເງິນ</td>
                        </tr>

                        <tr class="">
                            <td class="td-list" rowspan="3"> KIP</td>
                            <td class="td-list"> Bank Name</td>
                            <td class="td-list"> ທະນາຄານ </td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account Name</td>
                            <td class="td-list"> ຊີ່ບັນຊີ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account NO</td>
                            <td class="td-list"> ເລກບັນຊີ </td>
                        </tr>

                        <tr class="">
                            <td class="td-list" rowspan="3"> THB</td>
                            <td class="td-list"> Bank Name</td>
                            <td class="td-list"> ທະນາຄານ </td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account Name</td>
                            <td class="td-list"> ຊີ່ບັນຊີ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account NO</td>
                            <td class="td-list"> ເລກບັນຊີ </td>
                        </tr>

                        <tr class="">
                            <td class="td-list" rowspan="3"> USD </td>
                            <td class="td-list"> Bank Name</td>
                            <td class="td-list"> ທະນາຄານ </td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account Name</td>
                            <td class="td-list"> ຊີ່ບັນຊີ</td>
                        </tr>
                        <tr class="">
                            <td class="td-list">Account NO</td>
                            <td class="td-list"> ເລກບັນຊີ </td>
                        </tr>

                        <tr class="">
                            <td class="td-list"> ເງື່ອນໄຂການໃຫ້ເຄຣດິດ (ຕິດໜີ້)</td>
                            <td class="td-list" colspan="3"></td>
                        </tr>
                        <tr class="">
                            <td class="td-list" colspan="4">ລາຍລະອຽດຜູ້ສະໜອງສິນຄ້າ ແລະ ບໍລິການ</td>
                        </tr>

                        <tr class="tr-list">
                            <td class="">
                                ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ <br>
                                ເຄື່ອງໃຊ້ສຳນັກງານ <br>
                                ການວ່າຈ້າງເພື່ອການຕະຫຼາດ <br>
                                ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ <br>
                            </td>
                            <td class="" colspan="3">
                                Furniture ແລະ ອຸປະກອນຕົກແຕ່ງ <br>
                                ອຸປະກອນອິເລັກໂທນິກ <br>
                                ການວ່າຈ້າງ ແລະ ຮັບເໝົາ <br>
                            </td>
                        </tr>
                        <tr class="tr-list">
                            <td class="">
                                ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ <br>
                                ເຄື່ອງໃຊ້ສຳນັກງານ <br>
                                ການວ່າຈ້າງເພື່ອການຕະຫຼາດ <br>
                                ສິນຄ້າທີ່ຊື້ມາເພືື່ອຈັດຈຳໜ່າຍ <br>
                            </td>
                            <td class="" colspan="3">
                                Furniture ແລະ ອຸປະກອນຕົກແຕ່ງ <br>
                                ອຸປະກອນອິເລັກໂທນິກ <br>
                                ການວ່າຈ້າງ ແລະ ຮັບເໝົາ <br>
                            </td>
                        </tr>




                    </table>

                </div>
                <br>
                <div class="row mt-1 h2">
                    <table width="100%">

                        <tr>
                            <td align="left">ຂໍ້ສະເໜີ: <?php echo "$commend_from_evaluator"; ?></td>

                        </tr>

                    </table>
                </div>
                <br><br><br>


                <br><br>
                <table width="100%" style="border:none;">
                    <tr>

                        <td align="right">
                            <p align="right" class="h2"> FM-GA-HR-PC-01-07<br>19/07/17-00</p>
                        </td>
                </table>
                <br><br>

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