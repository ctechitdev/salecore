<?php

include("../setting/conn.php");

$cus_id = 34;


?>

 
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>
  <?php include "callcss.php"; ?>

  <!-- GOOGLE FONTS -->




  <link href="images/favicon.png" rel="shortcut icon" />


  <script src="plugins/nprogress/nprogress.js"></script>
</head>

<script type="text/javascript" src="js/jquery.min.js"></script> <!-- jQuery -->
<script>
  $(function() {



    $('#pv_id').change(function() {
      var pv_id = $('#pv_id').val();
      $.post('function/dynamic_dropdown/get_district_name.php', {
          pv_id: pv_id
        },
        function(output) {
          $('#dis_id').html(output).show();
        });
    });




  });
</script>


<body class="navbar-fixed sidebar-fixed font" id="body">




  <div class="wrapper">

    <?php include "menu.php"; ?>

    <div class="page-wrapper">

      <?php
      $header_name = "Preview Customer";
      include "header.php";
      ?>
      <div class="content-wrapper">
        <div class="content">
          <div class="email-wrapper rounded border bg-white">
            <div class="row no-gutters justify-content-center">
              <div class="email-body-head  p-4  text-center">
                <h4 class="text-dark"> ຟອມລູກຄ້າ </h4>
              </div>





              <div class="col-lg-12 col-xl-12 col-xxl-10">
                <div class="  email-body p-4 p-xl-5">

                  <form method="post" id="editcutomerFrm">

                    <?php

                    // echo"$cus_id";

                    for ($x = 0; $x < count($_POST['check_box']); $x++) {
                      $check_box = $_POST['check_box'][$x];
                      // echo"$check_box";



                      $cusrows = $conn->query("SELECT  * FROM tbl_customer where c_id = '$check_box' ")->fetch(PDO::FETCH_ASSOC);
                      $c_code = $cusrows['c_code'];
                      $c_shop_name = $cusrows['c_shop_name'];
                      $gender = $cusrows['gender'];
                      $c_name = $cusrows['c_name'];
                      $c_eng_name = $cusrows['c_eng_name'];
                      $provinces = $cusrows['provinces'];
                      $district = $cusrows['district'];
                      $village = $cusrows['village'];
                      $street = $cusrows['street'];
                      $h_unit = $cusrows['h_unit'];
                      $h_number = $cusrows['h_number'];
                      $identfy_number = $cusrows['identfy_number'];
                      $location_des = $cusrows['location_des'];
                      $phone1 = $cusrows['phone1'];
                      $phone2 = $cusrows['phone2'];
                      $fax = $cusrows['fax'];
                      $payment_type = $cusrows['payment_type'];
                      $credit_values = $cusrows['credit_values'];
                      $payment_term = $cusrows['payment_term'];
                      $contact_by = $cusrows['contact_by'];
                      $contact_phone = $cusrows['contact_phone'];
                      $staff_contact = $cusrows['staff_contact'];
                      $shop_type = $cusrows['shop_type'];
                      $service_type = $cusrows['service_type'];
                      $visit_days = $cusrows['visit_days'];

                      // echo "$provinces";
                    ?>



                      <div class="row text-center email-details-content border mb-5">

                        <div class="email-body-head mb-5 text-center col-lg-12">
                          <h4 class="text-dark"> <?php echo "$c_code"; ?> </h4>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ຊື່ຮ້ານ: <?php echo "$c_shop_name" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ຊື່ເຈົ້າຂອງກິດຈະການ: <?php echo "$gender $c_name" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ຊື່ພາສາອັງກິດ: <?php echo "$c_eng_name" ?></label>
                          </div>
                        </div>


                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ຖະນົນ: <?php echo "$street" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ບ້ານ: <?php echo "$village" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ໜ່ວຍ: <?php echo "$h_unit" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ເລກທີ: <?php echo "$h_number" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ເມືອງ: <?php echo "$district" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ແຂວງ: <?php echo "$provinces" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="firstName">ທີ່ຕັ້ງ: <?php echo "$location_des" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ເບີໂທ1: <?php echo "$phone1" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ເບີໂທ2: <?php echo "$phone2" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ແຟັກ: <?php echo "$fax" ?></label>
                          </div>
                        </div>








                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ປະເພດຊຳລະ: <?php echo "$payment_type" ?></label>
                          </div>
                        </div>


                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ວົງເງິນຕິດໜີ້: <?php echo "$credit_values" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="firstName">ວັນຕິດໜີ້: <?php echo "$payment_term" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-8">
                          <div class="form-group">
                            <label for="firstName">ເລກປະຈຳຕົວຜູ້ເສຍອາກອນ: <?php echo "$identfy_number" ?></label>
                          </div>
                        </div>


                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="firstName">ຊື່ຜູ້ຕິດຕໍ່: <?php echo "$contact_by" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="firstName">ເບີໂທຜູ້ຕິດຕໍ່: <?php echo "$contact_phone" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ລະຫັດພະນັກງານ: <?php echo "$staff_contact" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">ປະເພດລູກຄ້າ: <?php echo "$shop_type" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">service type: <?php echo "$service_type" ?></label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                            <label for="firstName">visit days: <?php echo "$visit_days" ?></label>
                          </div>
                        </div>





                      </div>
                    <?php

                    }

                    ?>


                    <div class="d-flex justify-content-end mt-6">
                      <button type="submit" class="btn btn-primary mb-2 btn-pill">Download</button>
                    </div>

                  </form>


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



  <!--  -->


</body>

</html>