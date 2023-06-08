<?php
include("../setting/checksession.php");
include("../setting/conn.php");


$header_name = "ດັດແກ້ສິນຄ້າ";
$header_click = "2";

$ie_id = $_GET['ie_id'];

?>

<!DOCTYPE html>



<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <link href="../images/iconmenu.png" rel="shortcut icon" />
    <?php

    include("../setting/callcss.php");

    ?>

    <script src="../plugins/nprogress/nprogress.js"></script>
</head>


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
                        <div class=" ">



                            <div class="email-body p-4 p-xl-5">
                                <div class="email-body-head mb-6 ">
                                    <h4 class="text-dark">ດັດແກ້ສິນຄ້າ</h4>
                                </div>
                                <form method="post" id="additemdate">
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

                                                                <input type="hidden" class="form-control" name="ie_id" id="ie_id" value='<?php echo "$ie_id" ?>' required>

                                                                <table class="table" id="productTable">

                                                                    <tbody>
                                                                        <?php

                                                                        $arrayNumber = 0;
                                                                        $x = 1;



                                                                        $stmt3 = $conn->prepare("
                                                                            
                                                                            SELECT full_code,a.item_name,a.buy_unit,a.sale_unit,a.pack,a.weight,a.brand_name,item_id
                                                                            FROM tbl_item_edit_detail_list a
                                                                            left join tbl_item_code_list b on a.item_id = b.icl_id
                                                                            where ie_id ='$ie_id' ");
                                                                        $stmt3->execute();

                                                                        if ($stmt3->rowCount() > 0) {
                                                                            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {


                                                                        ?>
                                                                                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">



                                                                                    <td>
                                                                                        <input type="text" name="itemid[]" id="itemid<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_id']; ?>" readonly />

                                                                                        <div class="form-group "> <?php echo "ລາຍການທີ: $x"; ?> <br>
                                                                                            <div class="row p-2">


                                                                                                <div class="form-group  col-lg-4">
                                                                                                    <label class="text-dark font-weight-medium">ລະຫັດສິນຄ້າ</label>
                                                                                                    <div class="form-group">
                                                                                                        <input type="text" step="any" name="itemcode[]" id="itemcode<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['full_code']; ?>" readonly />
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div class="col-lg-8">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ຊື່ສິນຄ້າ</label>
                                                                                                        <input type="text" step="any" name="itemname[]" id="itemname<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_name']; ?>" />
                                                                                                    </div>
                                                                                                </div>



                                                                                                <div class="col-lg-3">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ຫົວໜ່ວຍໃຫຍ່</label>
                                                                                                        <select class="form-control" name="buy_unit[]" id="buy_unit<?php echo $x; ?>">
                                                                                                            <option value="">ຫົວໜ່ວຍ</option>
                                                                                                            <?php
                                                                                                            $stmt4 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name  ");
                                                                                                            $stmt4->execute();
                                                                                                            if ($stmt4->rowCount() > 0) {
                                                                                                                while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                    $edit_buy_unit = $row4["cat_name"];
                                                                                                            ?> <option value="<?php echo $row4['cat_name']; ?>" <?php if ($row3['buy_unit'] == "$edit_buy_unit") {
                                                                                                                                                                    echo "selected";
                                                                                                                                                                } ?>> <?php echo $row4['cat_name']; ?></option>
                                                                                                            <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-3">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ຫົວໜ່ວຍນ້ອຍ</label>
                                                                                                        <select class="form-control" name="sale_unit[]" id="sale_unit<?php echo $x; ?>">
                                                                                                            <option value="">ຫົວໜ່ວຍ</option>
                                                                                                            <?php
                                                                                                            $stmt5 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name  ");
                                                                                                            $stmt5->execute();
                                                                                                            if ($stmt5->rowCount() > 0) {
                                                                                                                while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                                                                                    $edit_sale_unit = $row5["cat_name"];
                                                                                                            ?> <option value="<?php echo $row5['cat_name']; ?>" <?php if ($row3['sale_unit'] == "$edit_sale_unit") {
                                                                                                                                                                    echo "selected";
                                                                                                                                                                } ?>> <?php echo $row5['cat_name']; ?></option>
                                                                                                            <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>

                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-2">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ປະລິມານ</label>
                                                                                                        <input type="number" step="any" name="pack[]" id="pack<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['pack']; ?>" />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-2">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ຫໍ່ຫຸ້ມ</label>
                                                                                                        <input type="text" step="any" name="weight[]" id="weight<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['weight']; ?>" />
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-lg-2">
                                                                                                    <div class="form-group">
                                                                                                        <label for="firstName">ຍິຫໍ້</label>
                                                                                                        <input type="text" step="any" name="brand_name[]" id="brand_name<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['brand_name']; ?>" />
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
                                                                        }

                                                                        ?>



                                                                    </tbody>
                                                                </table>












                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>



                                    <div class="d-flex justify-content-end mt-6">
                                        <button type="submit" class="btn btn-primary mb-2 btn-pill">ດັດແກ້</button>
                                    </div>

                                </form>


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
                                        <th>ຈຳນວນລາຍການ</th>
                                        <th>ກຸ່ມສິນຄ້າ</th>
                                        <th>ວັງທີລົງທະບຽນ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $stmt4 = $conn->prepare("

                                    SELECT  a.ie_id,count(b.iedl_id) as count_list,a.date_register
                                    FROM tbl_item_edit a
                                    left join tbl_item_edit_detail_list b on a.ie_id = b.ie_id
                                    where add_by = '$id_users'
                                    group by b.ie_id 
                                    order by a.ie_id desc ");
                                    $stmt4->execute();

                                    if ($stmt4->rowCount() > 0) {
                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                            $ie_id = $row4['ie_id'];
                                            $count_list = $row4['count_list'];
                                            $date_register = $row4['date_register'];

                                    ?>



                                            <tr>
                                                <td><?php echo "$ie_id"; ?></td>
                                                <td><?php echo "$count_list"; ?></td>


                                                <td>
                                                    <?php

                                                    $stmt5 = $conn->prepare("
                                                select name_company 
                                                from tbl_item_edit_detail_list a
                                                left join tbl_item_code_list b on a.item_id = b.icl_id
                                                left join tbl_item_company_code c on b.item_header_code = c.item_company_code
                                                where ie_id = '$ie_id'
                                                group by name_company  ");
                                                    $stmt5->execute();

                                                    if ($stmt5->rowCount() > 0) {
                                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                            $name_company = $row5['name_company'];
                                                            echo "$name_company ";
                                                        }
                                                    }

                                                    ?>
                                                </td>
                                                <td><?php echo "$date_register"; ?></td>




                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="edit-customer.php?item_id=<?php echo "$ie_id"; ?>">ແກ້ໄຂ</a>

                                                            <a class="dropdown-item" type="button" id="deleteitemedit" data-id='<?php echo $row4['ie_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>

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
        $(document).on("submit", "#additemdate", function() {
            $.post("../query/edit-item-update.php", $(this).serialize(), function(data) {
                if (data.res == "invalid") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ກະລຸນາຕື່ມຂໍ້ມູນໄຫ້ຄົບຖ້ວນ',
                        'error'
                    )
                } else if (data.res == "success") {

                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂຂໍ້ມູນດັດແກ້ສິນຄ້າສຳເລັດ',
                        'success'
                    )

                    setTimeout(
                        function() {

                            window.location.href = 'item-update.php';
                        }, 1000);

                }
            }, 'json');

            return false;
        });
        $(document).on("click", "#deleteitemedit", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax({
                type: "post",
                url: "../query/delete-item-update.php",
                dataType: "json",
                data: {
                    id: id
                },
                cache: false,
                success: function(data) {
                    if (data.res == "success") {
                        Swal.fire(
                            'ສຳເລັດ',
                            'ລຶບຂໍ້ມູນດັດແກ້ສິນຄ້າສຳເລັດ',
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

    <!--  -->


</body>

</html>