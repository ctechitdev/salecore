<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");


?>


<form id="add-bill">
    <div class="modal-body ">
        <div class="row no-gutters">


            <div class="form-group col-lg-12 text-center ">
                <label class="text-dark font-weight-medium h3">ລາຍການເລືອກສິນຄ້າ</label><br>
            </div>




            <div class="col-md-12">
                <div class="card  ">

                    <div class="input-states">
                        <table class="table" id="tableEdit">
                            <thead>
                                <tr>

                                    <th>ສິນຄ້າ</th>
                                    <th>ຈຳນວນສັ່ງ</th>
                                    <th>ລາຄາລວມ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $total_sale_cart = 0;
                                $total_discount_list = 0;

                                $detail = $conn->prepare(" 
                                    select customer_order_cart_id,a.item_code,item_name,pack_type_name,sale_price,order_values,total_price_order,promotion_type_id,
                                    discount_price
                                    from tbl_customer_order_cart a
                                    left join tbl_item_code_list b on a.item_code = b.full_code
                                    where a.add_by = '$id_users'    ");
                                $detail->execute();
                                if ($detail->rowCount() > 0) {
                                    while ($detailrow = $detail->fetch(PDO::FETCH_ASSOC)) {



                                ?>



                                        <tr>
                                            <td><b><?php echo $detailrow['item_name']; ?> (<?php echo $detailrow['pack_type_name']; ?>) </td>
                                            <td><b><?php echo $detailrow['order_values']; ?></td>
                                            <td><b><?php echo number_format($detailrow['total_price_order']); ?></td>

                                            <td>
                                                <?php
                                                if ($detailrow['promotion_type_id'] == 1) {
                                                ?>
                                                    ສິນຄ້າແຖມ
                                                <?php
                                                } else {
                                                ?>

                                                    <a type="button" id="delete-cart" data-cart_id='<?php echo $detailrow['customer_order_cart_id']; ?>' class="btn btn-danger btn-pill  ">
                                                        ລົບ
                                                    </a>
                                                <?php
                                                }


                                                ?>

                                            </td>


                                        </tr>


                                <?php


                                        $total_sale_cart += $detailrow['total_price_order'];
                                        $total_discount_list += $detailrow['discount_price'];
                                    }
                                }
                                ?>

                        </table>
                    </div>

                    <?php

                    $total_bill = $total_sale_cart - $total_discount_list;

                    $bill_discount = $conn->query(" select billing_discount_id,billing_discount_values 
                    from tbl_billing_discount
                    where billing_buy_values = (select max(billing_buy_values) from tbl_billing_discount 
                    where billing_buy_values <= '$total_sale_cart' and  active_date <= CURDATE() and expire_date >= CURDATE()) ")->fetch(PDO::FETCH_ASSOC);

                    if (!empty($bill_discount['billing_discount_id'])) {
                       $price_bill_discount =  $bill_discount['billing_discount_values'];
                    }

                    $gran_total_price = $total_bill - $price_bill_discount;
                    ?>

                    <input type="hidden" name="total_sale_cart" value='<?php echo ($total_bill); ?>'>
                    <input type="hidden" name="total_discount_list" value='<?php echo ($total_discount_list); ?>'>
                    <input type="hidden" name="price_bill_discount" value='<?php echo ($price_bill_discount); ?>'>
                    <input type="hidden" name="gran_total_price" value='<?php echo ($gran_total_price); ?>'>



                    <div class="form-group col-lg-12 text-right mt-4 ">
                        <label class="text-dark font-weight-medium h3"> ມູນຄ່າ: <?php echo number_format($total_bill); ?> </label><br>
                    </div>
                    <div class="form-group col-lg-12 text-right">
                        <label class="text-dark font-weight-medium h3">ຫລຸດລາຄາ: <?php echo number_format($price_bill_discount); ?> </label><br>
                    </div>
                    <div class="form-group col-lg-12 text-right">
                        <label class="text-dark font-weight-medium h3"> ຈ່າຍໂຕຈິງ: <?php echo number_format($gran_total_price); ?> </label><br>
                    </div>

                </div>

                <div class="card text-center px-0 border-0">


                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-pill">ຢືນຢັນສັ່ງຊື້</button>
                    </div>
                </div>



            </div>




        </div>
    </div>
</form>

<script>
    $("#add-bill").on("submit", function(e) {
        e.preventDefault();
        Notiflix.Loading.hourglass();
        var formData = new FormData(this);
        $.ajax({
            url: "../query/add-bill-order.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#process').css('display', 'block');
            },
            success: function(dataResult) {
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == "success") {
                    Notiflix.Loading.remove();
                    document.getElementById("add-bill").reset();
                    Notiflix.Notify.success('ບັນທືກຂໍ້ມູນສຳເລັດ...');

                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);
                } else if (dataResult.statusCode == "nostock") {
                    Notiflix.Loading.remove();
                    Swal.fire(
                        'ບັນທືກບໍ່ສຳເລັດ',
                        'ກາລູນາກວດສອບຂໍ້ມູນ',
                        'error'
                    )
                } else {
                    Notiflix.Loading.remove();
                    Swal.fire(
                        'ບັນທືກບໍ່ສຳເລັດ',
                        'ກາລູນາກວດສອບຂໍ້ມູນ',
                        'error'
                    )
                }

            },
            error: function(xhr, resp, text) {

                console.log(xhr, resp, text);
            }
        });
    });
</script>