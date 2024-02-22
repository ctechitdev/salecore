<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຂໍ້ມູນຜູ້ໃຊ້";

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

<body class="navbar-fixed sidebar-fixed" id="body">


  <div class="wrapper">

    <?php include "menu.php"; ?>
    <div class="page-wrapper">

      <?php include "header.php"; ?>

      <div class="content-wrapper">
        <div class="content">


          <div class="row">

            <div class="col-xl-12">
              <!-- Account Settings -->
              <div class="card card-default">
                <div class="card-header">
                  <h2 class="mb-5">ຂໍ້ມູນຜູ້ໃຊ້</h2>

                </div>

                <div class="card-body">

                  <?php
                  $edit_row = $conn->query("select * from tbl_user_staff where usid = '$id_users' ")->fetch(PDO::FETCH_ASSOC);

                  ?>

                  <form id="profile">
                    <div class="row mb-2">

                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="firstName">ຊື່ຜູ້ໃຊ້</label>
                          <input type="text" class="form-control" name="new_full_name" value='<?php echo $edit_row['full_name']; ?>'>
                        </div>
                      </div>



                      <div class="col-lg-12">
                        <div class="form-group mb-4">
                          <label for="userName">ຢູສເຊີ້</label>
                          <input type="text" class="form-control" id="userName" value='<?php echo $edit_row['user_name']; ?>' readonly>
                          <span class="d-block mt-1">ບໍ່ສາມາດປ່ຽນເອງໄດ້ຕ້ອງຕິດຕໍ່ຜູ້ດູແລລະບົບ</span>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div class="form-group mb-4">
                          <label for="userName">ລະຫັດຜ່ານໃໝ່</label>
                          <input type="text" class="form-control" name="user_password" >
                          <span class="d-block mt-1">ຖ້າຫາກຕ້ອງການປ່ຽນລະຫັດຜ່ານໃຫມ່ພິມລະຫັດຜ່ານໃຫມ່ແລ້ວກົດແກ້ໄຂ</span>
                        </div>

                      </div>

                    </div>


                    <div class="d-flex justify-content-end mt-6">
                      <button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂ</button>
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


  <script>
    $(document).on("submit", "#profile", function() {
      $.post("../query/update-profile.php", $(this).serialize(), function(data) {
        if (data.res == "success") {
          Swal.fire(
            'ສຳເລັດ',
            'ແກ້ໄຂສຳເລັດ',
            'success'
          )
          setTimeout(
            function() {
              location.reload();
            }, 1000);
        }
      }, 'json')
      return false;
    });
  </script>

</body>

</html>