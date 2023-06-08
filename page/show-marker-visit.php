<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຕິດຕາມຢ້ຽມຢາມ";
$header_click = "6";




if (isset($_POST['btn_view'])) {

    $date_request = $_POST['date_request'];
    $request_date = str_replace('/', '-', $date_request);
    $date_view = date('Y-m-d', strtotime($request_date));

    $id_staff = $_POST['st_id'];
} else {
    $date_view = '';
    $id_staff = '0';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="IE=edge">

    <?php

    include("../setting/callcss.php");

    ?>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDiJeUXpsX4MAO18EwcOjhDfanuXUjEcE&callback=initMap"></script>

    <script>
        var marker;

        function initialize() {
            var infoWindow = new google.maps.InfoWindow;

            var mapOptions = {
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var bounds = new google.maps.LatLngBounds();

            // Retrieve data from database


            <?php
            $stmt5 = $conn->prepare(" select * from tbl_visited_customer  where check_by = '$id_staff' and date_check = '$date_view'");
            $stmt5->execute();
            if ($stmt5->rowCount() > 0) {
                while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {



                    $nama = $row5['cus_code'];
                    $lat = $row5['lat_in'];
                    $lon = $row5['lon_in'];

                    echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");
                }
            }
            ?>



            // Proses of making marker 
            function addMarker(lat, lng, info) {
                var lokasi = new google.maps.LatLng(lat, lng);
                bounds.extend(lokasi);
                var marker = new google.maps.Marker({
                    map: map,
                    position: lokasi
                });
                map.fitBounds(bounds);
                bindInfoWindow(marker, map, infoWindow, info);
            }

            // Displays information on markers that are clicked
            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }

        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>

<body class="navbar-fixed sidebar-fixed" id="body" onload="initialize()">




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



                            <div class="col-lg-12 col-xl-12 col-xxl-12">
                                <div class="email-right-column  email-body p-4 p-xl-5">
                                    <div class="email-body-head mb-5 ">
                                        <h4 class="text-dark"> ຕິດຕາມຢ້ຽມຢາມ</h4>
                                        <?php

                                        //   echo "$date_view and $id_staff";
                                        ?>


                                    </div>
                                    <form method="post">


                                        <div class="row">

                                            <div class="form-group  col-lg-6">
                                                <label class="text-dark font-weight-medium">ພະນັກງານຂາຍ</label>
                                                <div class="form-group">
                                                    <select class=" form-control font" name="st_id" id="st_id">
                                                        <option value=""> ເລືອກພະນັກງານຂາຍ </option>
                                                        <?php
                                                        $stmt5 = $conn->prepare(" SELECT concat(staff_cp,' ',staff_name) as staff_name,
                                                        user_ids
                                                        from tbl_staff_sale a
                                                        left join tbl_user_staff b on a.user_ids = b.usid
                                                        where depart_id = '$depart_id' ");
                                                        $stmt5->execute();
                                                        if ($stmt5->rowCount() > 0) {
                                                            while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                        ?> <option value="<?php echo $row5['user_ids']; ?>" <?php if ($id_staff == $row5['user_ids']) {
                                                                                                                echo "selected";
                                                                                                            } ?>> <?php echo $row5['staff_name']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="firstName"> ວັນທີ </label>
                                                    <input type="date" class="form-control" id="date_request" name="date_request" value='<?php echo "$date_view"; ?>'>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="d-flex justify-content-end mt-6">

                                            <button type="submit" name="btn_view" class="btn btn-primary mb-2 btn-pill"> ສະແດງລາຍງານ </button>
                                        </div>

                                        <div class="card-body">
                                            <div id="map-canvas" style="width: 100%; height: 600px;"></div>
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


                    </div>


                </div>

            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>
	<?php include("../setting/calljs.php"); ?>

</body>

</html>