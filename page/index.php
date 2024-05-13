<?php
include("../setting/checksession.php");
include("../setting/conn.php");

if($user_type_id == 2){
  header("Location:order-customer.php");
}

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
    $(document).on("click", "#editmodal", function(e) {
      e.preventDefault();
      var item_post_id = $(this).data("item_post_id");

      $.post('../function/modal/get_item_order_list_dashboard.php', {
          item_post_id: item_post_id
        },
        function(output) {
          $('.show_data_edit').html(output).show();
        });
    });
  </script>

</head>


<body class="navbar-fixed sidebar-fixed" id="body">




  <div class="wrapper">



    <?php include "menu.php"; ?>


    <div class="page-wrapper">

      <?php
      $header_name = "Dashboard";
      include "header.php";
      ?>
      

      <div class="content-wrapper">
        <div class="content">


          <div class="row">

            <div class="col-xl-12">
              <div class="card card-default">
                <div class="card-header">
                  <h2>ສັງລວມການສັ່ງ</h2>
                </div>
                <div class="card-body py-0">
                  <div class="row pb-4">

                    <div class="col-lg-8 border-right-lg">
                      <div class="card card-default">

                        <div class="card-body">
                          <table id="productsTable2" class="table table-hover table-product" style="width:100%">
                            <thead>
                              <tr>
                                <th>ຊື່ສິນຄ້າ</th>
                                <th>ຍອດສັ່ງ</th>
                                <th>ສັງແລ້ວ</th>
                                <th>ສັງລວມຮ້ານ</th>
                                <th>ມູນຄ່າຍອດສັ່ງ</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                              $stmt = $conn->prepare(" call stp_dash_board_sale();");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              ?>

                                  <tr> 
                                    <td><?php echo $row['item_name']; ?></td> 
                                    <td><?php echo number_format($row['ordered_values']); ?></td>
                                    <td><?php echo number_format($row['customer_order_values']); ?></td>
                                    <td><?php echo number_format($row['count_shop']); ?></td>
                                    <td><?php echo number_format($row['total_price_order'],2); ?></td>
                               

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


                    <div class="col-lg-4">
                      <div class="chart-wrapper">
                        <div class="card-body">
                          <table class="table table-borderless table-thead-border">
                            <thead>
                              <tr>
                                <th>ຊື່ຮ້ານ</th>
                                <th class="text-right">ຍອດສັ່ງ</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php


                              $stmt1 = $conn->prepare(" select  customer_name,sum(total_price) as total_price
                              from tbl_customer_order a
                              left join tbl_customer_user b on a.order_by = b.customer_user_id
                              group by customer_name ");
                              $stmt1->execute();
                              if ($stmt1->rowCount() > 0) {
                                while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                  <tr>
                                    <td class="text-dark font-weight-bold"><?php echo $row1['customer_name']; ?></td>
                                    <td class="text-right"><?php echo number_format($row1['total_price']); ?></td>
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

                </div>
              </div>
            </div>
          </div>


        </div>

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



      <?php include "footer.php"; ?>

    </div>
  </div>

  <?php include("../setting/calljs.php"); ?>


</body>

</html>