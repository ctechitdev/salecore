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



<style>
    .table-list {
        text-align: center;
        border-collapse: collapse;
        width: 100%;
    }

    .td-list,
    .th-list {
        border: 1px solid #dddddd;
 
    }

    .tr-list {
        background-color: #dddddd;
    }

    .td-list-left {
        border: 1px solid #dddddd;
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



                $cusrows = $conn->query(" 
				select vendor_shop_name,evaluated_date,acc_number,
				DATE_FORMAT(evaluated_month,'%m-%Y') as evaluated_month
				from tbl_vendor_evaluated a
				left join tbl_vendor b on a.vendor_id = b.vendor_id
				left join tbl_account_company c on b.acc_code = c.company_code
				where vendor_evaluated_id = '$check_box' ")->fetch(PDO::FETCH_ASSOC);

                $vendor_shop_name = $cusrows['vendor_shop_name'];
                $evaluated_date = $cusrows['evaluated_date'];
                $evaluated_month = $cusrows['evaluated_month'];
                $acc_number = $cusrows['acc_number'];




            ?>

                <div>
                    <table width="100%" style="border:none;">

                        <tr>

                            <td align="left"> <img src='../images/kpicon.png' width='100px' height='100px'></td>

                            <td align="left"><b>
                                    <h1> ໃບປະເມີນຜູ້ຂາຍ </h1>
                                </b>

                            </td>

                        </tr>



                    </table>
                </div>

                <div>
                    <table width="100%" style="border:none;">

                        <tr>
                            <td align="left">ຊື່ຜູ້ຂາຍ</td>
                            <td align="left">ວັນທີປະເມີນ</td>
                        </tr>
                        <tr>
                            <td align="left">ຊ່ວງໃນການປະເມີນ</td>
                            <td align="left">ປະເພດສິນຄ້າ</td>
                        </tr>

                    </table>
                </div>


                <div class="container ridge ">

                    <table class="table-list text-center">
                        <tr class="tr-list">
                            <th class="th-list" rowspan="2" width="5%">ລຳດັບ</th>
                            <th class="th-list" rowspan="2" width="45%">ຂໍ້ກຳນົດການປະເມີນ</th>
                            <th class="th-list" rowspan="2" width="13%">ນຳໜັກຄະແນນ</th>
                            <th class="th-list" colspan="5" width="25%">ລະດັບຄະແນນ</th>
                            <th class="th-list" rowspan="2" width="12%">ຄະແນນທີ່ໄດ້</th>
                        </tr>
                        <tr class="tr-list">

                            <th class="th-list" width="5%">1</th>
                            <th class="th-list" width="5%">2</th>
                            <th class="th-list" width="5%">3</th>
                            <th class="th-list" width="5%">4</th>
                            <th class="th-list" width="5%">5</th>
                        </tr>


                        <?php

                        $question_total_point = 0;
                        $evaluate_total_point = 0;

                        $i = 1;
                        $stmt4 = $conn->prepare("select evaluation_score, a.evaluation_question_id,evaluation_question_title,evaluation_question_data,
                        evaluation_point,evaluation_multi_score
                        from tbl_vendor_evaluated_detail a
                        left join tbl_evaluation_question b on a.evaluation_question_id = b.evaluation_question_id
                        where vendor_evaluated_id = '$check_box' ");
                        $stmt4->execute();
                        if ($stmt4->rowCount() > 0) {
                            while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {


                                $evaluation_question_title = $row4['evaluation_question_title'];
                                $evaluation_question_data = $row4['evaluation_question_data'];
                                $evaluation_point = $row4['evaluation_point'];
                                $evaluation_score = $row4['evaluation_score'];
                                $evaluation_multi_score = $row4['evaluation_multi_score'];


                        ?>

                                <tr class="tr-list">
                                    <td class="td-list"><?php echo "$i"; ?></td>
                                    <td class="td-list-left">
                                        <b><?php echo "$evaluation_question_title"; ?></b><br>
                                        <?php echo "$evaluation_question_data"; ?><br>
                                    </td>
                                    <td class="td-list"><?php echo "$evaluation_point"; ?></td>
                                    <td class="td-list"><?php if ($evaluation_score == 1) { ?> <input type="checkbox" checked /> <?php } ?></td>
                                    <td class="td-list"><?php if ($evaluation_score == 2) { ?> <input type="checkbox" checked /> <?php } ?></td>
                                    <td class="td-list"><?php if ($evaluation_score == 3) { ?> <input type="checkbox" checked /> <?php } ?></td>
                                    <td class="td-list"><?php if ($evaluation_score == 4) { ?> <input type="checkbox" checked /> <?php } ?></td>
                                    <td class="td-list"><?php if ($evaluation_score == 5) { ?> <input type="checkbox" checked /> <?php } ?></td>
                                    <td class="td-list"><?php echo "$evaluation_multi_score"; ?></td>
                                </tr>

                        <?php

                                $question_total_point += $evaluation_point;
                                $evaluate_total_point += $evaluation_multi_score;
                                $i++;
                            }
                        }


                        ?>
                        <tr class="tr-list">
                            <td class="td-list" colspan="2"></td>
                            <td class="td-list"><?php echo "$question_total_point"; ?></td>
                            <td class="td-list" colspan="5"></td>
                            <td class="td-list"><?php echo "$evaluate_total_point"; ?></td>
                        </tr>


                    </table>


                </div>
                <br>

                <div>
                    <table width="100%" style="border:none;">

                        <tr>
                            <td align="left">ຂໍ້ສະເໜີ:</td>

                        </tr>

                    </table>
                </div>

                <div class="row">
                    <table width="50%" style="border:none;">
                        <tr>
                            <td align="left"><b>
                                    <p align="center"> ຜູ້ສະເໜີ </p>
                                </b>

                            </td>
                    </table>

                    <table width="50%" style="border:none;">
                        <tr>
                            <td align="left"><b>
                                    <p align="center"> ຜູ້ສະເໜີ </p>
                                </b>

                            </td>
                    </table>
                </div>

                <table width="100%" style="border:none;">
                    <tr>
                      
                        <td align="right"> 
                                <p align="right"> FM-GA-HR-PC-01-07<br>19/07/17-00</p>
                        </td>
                </table>

                <div>
                    <table width="100%" style="border:none;">

                        <tr>

                            <td align="left"> <img src='../images/kpicon.png' width='100px' height='100px'></td>

                            <td align="left">
                                <h3>ສະຫຼຸບການປະເມີນຜູ້ຂາຍປະຈຳປີ 555 (ເດຶອນ 555) </h3>
                            </td>

                        </tr>



                    </table>
                </div>
 

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