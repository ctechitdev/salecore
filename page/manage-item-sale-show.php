<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຈັດການສິນຄ້າຂາຍ";
$header_click = "2";

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


        $('#com_code').change(function() {
            var com_code = $('#com_code').val();
            $.post('../function/dynamic_dropdown/list_item_table.php', {
                    com_code: com_code
                },
                function(output) {
                    $('#dis_id').html(output).show();
                });
        });




    });

    $(document).on("click", "#editmodal", function(e) {
        e.preventDefault();
        var item_list_id = $(this).data("item_list_id");

        $.post('../function/modal/item-data-sale-show-status.php', {
                item_list_id: item_list_id
            },
            function(output) {
                $('.show_data_edit').html(output).show();
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

                            <div class="  col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <form>


                                        <div class="form-group  col-lg-12">
                                            <label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
                                            <div class="form-group">
                                                <select class=" form-control font" name="com_code" id="com_code">
                                                    <option value=""> ເລຶອກລະຫັດກຸ່ມສິນຄ້າ </option>
                                                    <?php
                                                    $stmt = $conn->prepare(" select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
													from tbl_item_company_code a
													left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id'   ");
                                                    $stmt->execute();
                                                    if ($stmt->rowCount() > 0) {
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    ?> <option value="<?php echo $row['icc_id']; ?>"> <?php echo $row['item_group_code']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <table id="productsTable" class="table table-hover table-product" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ລຳດັບ</th>
                                                    <th>ລະຫັດສິນຄ້າ</th>
                                                    <th>ຊື່ສິນຄ້າ</th>
                                                    <th>ລາຄາ</th>
                                                    <th>ພະນັກງານ</th>
                                                    <th>ຮ້ານຄ້າ</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="dis_id">


                                                <?php
                                                $i = 1;
                                                $stmt4 = $conn->prepare(" SELECT full_code,name_company,icl_id,item_code,item_name,item_price,
                                                (case when show_staff_status_id = 1  then 'ເປີດ' else 'ປິດ' end) as show_staff_status_id,
                                                (case when show_customer_status_id  = 1  then 'ເປີດ' else 'ປິດ' end) as show_customer_status_id
												FROM tbl_item_code_list a
												left join tbl_item_company_code b on a.com_code = icc_id
                                                left join tbl_staff_item_code c on b.icc_id =c.icc_id
												where use_by  = '$depart_id' ");
                                                $stmt4->execute();
                                                if ($stmt4->rowCount() > 0) {
                                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                        $icl_id = $row4['icl_id'];
                                                        $full_code = $row4['full_code'];
                                                        $item_name = $row4['item_name'];
                                                        $item_price = $row4['item_price'];

                                                ?>



                                                        <tr>
                                                            <td><?php echo "$i"; ?></td>
                                                            <td><?php echo "$full_code"; ?></td>
                                                            <td><?php echo "$item_name"; ?></td>
                                                            <td><?php echo "$item_price"; ?></td>
                                                            <td><?php echo  $row4['show_staff_status_id']; ?></td>
                                                            <td><?php echo  $row4['show_customer_status_id']; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                        <a href="javascript:0" class="dropdown-item" id="editmodal" data-item_list_id='<?php echo $row4['icl_id']; ?>' data-toggle="modal" data-target="#modal-edit">ສະແດງ</a>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                <?php

                                                        $i++;
                                                    }
                                                }
                                                ?>








                                            </tbody>
                                        </table>


                                    </form>

                                    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-end border-bottom-0">


                                                    <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </div>

                                                <div class="show_data_edit">



                                                </div>


                                            </div>
                                        </div>
                                    </div>

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
        $(document).on("submit", "#update-modal", function() {
            $.post("../query/update-show-item-sale.php", $(this).serialize(), function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ແກ້ໄຂຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.reload();
                        }, 1000);
                } else if (data.res == "unitexist") {
                    Swal.fire(
                        'ແຈ້ງເຕືອນ',
                        'ສິນຄ້າມີຫົວໜ່ວຍຫຼັກແລ້ວ',
                        'error'
                    )
                }

            }, 'json')
            return false;
        });
    </script>


</body>

</html>