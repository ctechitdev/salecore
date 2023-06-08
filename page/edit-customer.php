<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ເພີ່ມລູກຄ້າ";
$header_click = "1";

$cus_id = $_GET['cus_id'];


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
<script type="text/javascript" src="../js/jquery.min.js"></script> <!-- jQuery -->
<script>
	$(function() {



		$('#pv_id').change(function() {
			var pv_id = $('#pv_id').val();
			$.post('../function/dynamic_dropdown/get_district_name.php', {
					pv_id: pv_id
				},
				function(output) {
					$('#dis_id').html(output).show();
				});
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

							<?php




							$cusrows = $conn->query("SELECT  * FROM tbl_customer where c_id = '$cus_id' ")->fetch(PDO::FETCH_ASSOC);
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
							$staff_contact_get = $cusrows['staff_contact'];
							$shop_type = $cusrows['shop_type'];
							$service_type = $cusrows['service_type'];
							$visit_days = $cusrows['visit_days'];
							$c_zone = $cusrows['c_zone'];
							$c_class = $cusrows['c_class'];
							$pl_id = $cusrows['pl_id'];
							$acc_book = $cusrows['acc_book'];
							$bank_code = $cusrows['bank_code'];
							$ccy = $cusrows['ccy'];
							$acc_name = $cusrows['bank_acc_name'];

							// echo "$provinces";
							?>

							<div class="">
								<div class="email-right-column  email-body p-4 p-xl-5">
									<div class="email-body-head mb-5 text-center">
										<h4 class="text-dark"> <?php echo "$c_code ($c_shop_name)"; ?> </h4>
									</div>
									<form method="post" id="editcutomerFrm">


										<input type="hidden" class="form-control" name="cid" id="cid" value='<?php echo "$cus_id" ?>' required>

										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</label>
													<input type="text" class="form-control" id="shopname" name="shopname" value='<?php echo "$c_shop_name" ?>' required>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">ຊື່ບັນຊີ</label>
													<input type="text" class="form-control" id="acc_name" name="acc_name" value='<?php echo "$acc_name" ?>' required>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">ເລກບັນຊີ</label>
													<input type="text" class="form-control" id="acc_book" name="acc_book" value='<?php echo "$acc_book" ?>' required>
												</div>
											</div>

											<div class="col-lg-2">
												<div class="form-group">
													<label for="firstName">ທະນາຄານ</label>
													<select class=" form-control font" name="bank_code" id="bank_code">
														<option value=""> ເລືອກທະນາຄານ </option>

														<?php

														$stmt1 = $conn->prepare("  select * from tbl_bank_code ");
														$stmt1->execute();
														if ($stmt1->rowCount() > 0) {
															while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
														?> <option value="<?php echo $row1['bc_code']; ?>" <?php if ($bank_code == $row1['bc_code']) {
																												echo "selected";
																											} ?>> <?php echo $row1['bc_name']; ?></option>
														<?php
															}
														}

														?>
													</select>
												</div>
											</div>

											

											<div class="col-lg-2">
												<div class="form-group">
													<label for="firstName">ສະກຸນເງິນ</label>
													<select class=" form-control font" name="currency" id="currency">
														<option value=""> ເລືອກສະກຸນເງິນ </option>
														<option value="LAK" <?php if($ccy =="LAK"){echo "selected" ;}?> >LAK</option>
														<option value="THB" <?php if($ccy =="THB"){echo "selected" ;}?> >THB</option>
														<option value="USD" <?php if($ccy =="USD"){echo "selected" ;}?> >USD</option>
													</select>
												</div>
											</div>


										</div>

										<label for="firstName">ເພດ</label>

										<br>


										<?php
										if ($gender == "M") {
											$check_male = "checked";
											$check_female = "";
										} else if ($gender == "F") {
											$check_male = "";
											$check_female = "checked";
										} else {
											$check_male = "";
											$check_female = "";
										}

										?>
										<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
											<input type="radio" id="genderM" name="customRadio" value="M" <?php echo "$check_male "; ?> class="custom-control-input">
											<label class="custom-control-label" for="genderM">ຊາຍ</label>
										</div>

										<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
											<input type="radio" id="genderF" name="customRadio" value="F" <?php echo "$check_female "; ?> class="custom-control-input">
											<label class="custom-control-label" for="genderF">ຍິງ</label>
										</div>






										<div class="row">



											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">ຊື່ລູກຄ້າ</label>
													<input type="text" class="form-control" name="customername" id="customername" value='<?php echo "$c_name" ?>'>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">ຊື່ພາສາອັງກິດ</label>
													<input type="text" class="form-control" name="engname" id="engname" value='<?php echo "$c_eng_name" ?>'>
												</div>
											</div>

										</div>



										<div class="row">
											<div class="form-group  col-lg-6">
												<label class="text-dark font-weight-medium">ແຂວງ</label>
												<div class="form-group">
													<select class=" form-control font" name="pv_id" id="pv_id">
														<option value=""> ເລືອກແຂວງ </option>
														<?php
														$stmt = $conn->prepare(" SELECT pv_id,pv_name FROM tbl_provinces order by pv_name");
														$stmt->execute();
														if ($stmt->rowCount() > 0) {

															while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
																$edit_pv_id = $row["pv_id"];
														?> <option value='<?php echo $row["pv_id"];  ?>' <?php if ($provinces == "$edit_pv_id") {
																												echo "selected";
																											} ?>> <?php echo $row['pv_name'];  ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="form-group col-lg-6">
												<label class="text-dark font-weight-medium">ເມືອງ</label>
												<div class="form-group">

													<select class="form-control  font" name="dis_id" id="dis_id">
														<option value=""> ເລືອກເມືອງ </option>
														<?php
														$stmt2 = $conn->prepare(" SELECT dis_id,distict_name FROM tbl_districts where pv_id ='$provinces' ");
														$stmt2->execute();
														if ($stmt2->rowCount() > 0) {

															while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
																$edit_dt_id = $row2["dis_id"];
														?> <option value='<?php echo $row2["dis_id"];  ?>' <?php if ($district == "$edit_dt_id") {
																												echo "selected";
																											} ?>> <?php echo $row2['distict_name'];  ?></option>
														<?php
															}
														}
														?>
													</select>

													</select>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">ບ້ານ</label>
													<input type="text" class="form-control" id="villagename" name="villagename" value='<?php echo "$village" ?>'>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">ຖະໜົນ</label>
													<input type="text" class="form-control" id="streetname" name="streetname" value='<?php echo "$street" ?>'>
												</div>
											</div>


											<div class="col-lg-2">
												<div class="form-group">
													<label for="firstName">ໜ່ວຍ</label>
													<input type="text" class="form-control" id="houseunit" name="houseunit" value='<?php echo "$h_unit" ?>'>
												</div>
											</div>

											<div class="col-lg-2">
												<div class="form-group">
													<label for="firstName">ເຮືອນເລກທີ</label>
													<input type="text" class="form-control" id="housenumber" name="housenumber" value='<?php echo "$h_number" ?>'>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group">
													<label for="firstName">ເລກບັດ/ເລກອາກອນ</label>
													<input type="text" class="form-control" id="identid" name="identid" value='<?php echo "$identfy_number" ?>'>
												</div>
											</div>

											<div class="col-lg-9">
												<div class="form-group">
													<label for="firstName">ທີ່ຕັ້ງ</label>
													<input type="text" class="form-control" id="locationdetail" name="locationdetail" value='<?php echo "$location_des" ?>'>
												</div>
											</div>


										</div>


										<div class="row">



											<div class="col-lg-4">
												<div class="form-group">
													<label for="firstName">ເບີໂທ1</label>
													<input type="text" class="form-control" id="phone1" name="phone1" value='<?php echo "$phone1" ?>'>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="lastName">ເບີໂທ2</label>
													<input type="text" class="form-control" id="phone2" name="phone2" value='<?php echo "$phone2" ?>'>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label for="lastName">ແຟັກ</label>
													<input type="text" class="form-control" id="fax" name="fax" value='<?php echo "$fax" ?>'>
												</div>
											</div>

										</div>

										<label for="firstName">ປະເພດການຊຳລະ</label>




										<div class="row">


											<?php
											if ($payment_type == "Cash") {
												$cash = "checked";
												$credit = "";
											} else if ($payment_type == "Credit") {
												$cash = "";
												$credit = "checked";
											} else {
												$cash = "";
												$credit = "";
											}

											?>



											<div class="col-lg-3">
												<div class="form-group">
													<br><br>

													<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
														<input type="radio" id="Cash" name="CashType" value="Cash" <?php echo "$cash "; ?> class="custom-control-input">
														<label class="custom-control-label" for="Cash">ຈ່າຍສົດ</label>
													</div>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group">
													<br><br>
													<div class="custom-control custom-radio d-inline-block mr-3 mb-3">
														<input type="radio" id="Credit" name="CashType" value="Credit" <?php echo "$credit "; ?> class="custom-control-input">
														<label class="custom-control-label" for="Credit">ຕິດໜີ້</label>
													</div>
												</div>
											</div>

											<div class="  col-lg-6">
												<label class="text-dark font-weight-medium">ປະເພດລາຄາ</label>
												<div class="form-group">
													<select class=" form-control font" name="pricelist" id="pricelist">
														<option value="0"> ເລືອກປະເພດລາຄາ </option>
														<?php
														$stmt6 = $conn->prepare(" SELECT pricelist_name,b1_code FROM tbl_price_list order by pricelist_name");
														$stmt6->execute();
														if ($stmt6->rowCount() > 0) {
															while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
																$edit_pl_id = $row6["b1_code"];
														?> <option value="<?php echo $row6['b1_code']; ?>" <?php if ($pl_id == "$edit_pl_id") {
																												echo "selected";
																											} ?>> <?php echo $row6['pricelist_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">ວົງເງິນຕິດໜີ້</label>
													<input type="number" class="form-control" id="creditvalues" name="creditvalues" value='<?php echo "$credit_values" ?>'>
												</div>
											</div>



											<div class="col-lg-6">
												<label for="lastName">ຈຳນວນວັນຕິດໜີ້</label>
												<select class=" form-control font" name="paymentterm" id="paymentterm">
													<option value="0"> ເລືອກວັນຕິດໜີ້ </option>
													<?php
													$stmt5 = $conn->prepare(" SELECT b1_number,pt_name FROM tbl_payment_term order by pt_name ");
													$stmt5->execute();
													if ($stmt5->rowCount() > 0) {
														while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
															$edit_pt_id = $row5["b1_number"];
													?> <option value="<?php echo $row5['b1_number']; ?>" <?php if ($payment_term == "$edit_pt_id") {
																												echo "selected";
																											} ?>> <?php echo $row5['pt_name']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>

										</div>


										<div class="row">



											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName">ຊື່ຜູ້ຕິດຕໍ່</label>
													<input type="text" class="form-control" id="contactby" name="contactby" value='<?php echo "$contact_by" ?>'>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">ເບີໂທ</label>
													<input type="text" class="form-control" id="contactphone" name="contactphone" value='<?php echo "$contact_phone" ?>'>
												</div>
											</div>

										</div>

										<div class="row">
											<div class="form-group  col-lg-6">
												<label class="text-dark font-weight-medium">ພະນັກງານຕິດຕໍ່</label>
												<div class="form-group">
													<select class=" form-control font" name="ss_id" id="ss_id">
														<option value="0"> ເລືອກພະນັກງານ </option>
														<?php
														$stmt3 = $conn->prepare(" 
														SELECT staff_code,concat(staff_cp,' ', staff_name) as st_name 
														FROM tbl_staff_sale a
														left join tbl_user_staff b on a.user_ids = b.usid
														where depart_id = '$depart_id'
														order by staff_cp  
														");
														$stmt3->execute();
														if ($stmt3->rowCount() > 0) {
															while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
																$edit_st_id = $row3["staff_code"];
														?> <option value="<?php echo $row3['staff_code']; ?>" <?php if ($staff_contact_get == "$edit_st_id") {
																													echo "selected";
																												} ?>> <?php echo $row3['st_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">Shop Type</label>
													<input type="text" class="form-control" id="shopttypecus" name="shopttypecus" value='<?php echo "$shop_type" ?>'>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="lastName">Service Type</label>
													<input type="text" class="form-control" id="servicetype" name="servicetype" value='<?php echo "$service_type" ?>'>
												</div>
											</div>



											<div class="form-group  col-lg-6">
												<label class="text-dark font-weight-medium">ວັນຢ້ຽມ</label>
												<div class="form-group">
													<select class=" form-control font" name="visitdays" id="visitdays">
														<option value=""> ເລືອກວັນຢ້ຽມ </option>
														<?php
														$stmtv = $conn->prepare(" SELECT * FROM tbl_day_visit  ");
														$stmtv->execute();
														if ($stmtv->rowCount() > 0) {
															while ($rowv = $stmtv->fetch(PDO::FETCH_ASSOC)) {
														?> <option value="<?php echo $rowv['dv_code']; ?>" <?php if ($visit_days == $rowv['dv_code']) {
																												echo "selected";
																											} ?>> <?php echo $rowv['dv_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName"> ເຂດລູກຄ້າ </label>
													<input type="text" class="form-control" id="cuszone" name="cuszone" value='<?php echo "$c_zone" ?>'>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label for="firstName"> ລະດັບລູກຄ້າ </label>
													<input type="text" class="form-control" id="cusclass" name="cusclass" value='<?php echo "$c_class" ?>'>
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

			<div class="content-wrapper">
				<div class="content">
					<!-- For Components documentaion -->


					<div class="card card-default">

						<div class="card-body">

							<table id="productsTable" class="table table-hover table-product" style="width:100%">
								<thead>
									<tr>
										<th>ເລກລຳດັບ</th>
										<th>ລະຫັດລູກຄ້າ</th>
										<th>ຊື່ຮ້ານ/ຊື່ບໍລິສັດ</th>
										<th>ຊື່ລູກຄ້າ</th>
										<th>ເບີໂທ</th>

										<th>ປະເພດຊຳລະ</th>
										<th>ພະນັກງານ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare(" SELECT c_id,c_code,c_shop_name,c_name,payment_type,phone1,staff_name,ref_number
				FROM tbl_customer a
				left join tbl_staff_sale b on a.staff_contact = b.staff_code
				where add_by ='$id_users'
				order by c_id DESC ");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$c_id = $row4['c_id'];
											$c_code = $row4['c_code'];
											$c_shop_name = $row4['c_shop_name'];
											$c_name = $row4['c_name'];
											$phone1 = $row4['phone1'];
											$payment_type = $row4['payment_type'];
											$staff_contact = $row4['staff_name'];
											$ref_number = $row4['ref_number'];

									?>



											<tr>
												<td><?php echo "$ref_number"; ?></td>
												<td><?php echo "$c_code"; ?></td>
												<td><?php echo "$c_shop_name"; ?></td>
												<td><?php echo "$c_name"; ?></td>
												<td><?php echo "$phone1"; ?></td>
												<td><?php echo "$payment_type"; ?></td>
												<td><?php echo "$staff_contact"; ?></td>



												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a class="dropdown-item" href="edit-customer.php?cus_id=<?php echo "$c_id"; ?>">ແກ້ໄຂ</a>

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
		// Update customer
		$(document).on("submit", "#editcutomerFrm", function() {
			$.post("../query/editcustomer.php", $(this).serialize(), function(data) {
				if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ແກ້ໄຂຂໍ້ມູນລູກຄ້າສຳເລັດ',
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