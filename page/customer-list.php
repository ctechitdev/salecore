<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພິນລະຫັດລູກຄ້າ";
$header_click = "1";
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
</head>

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
									<form method="post" target="_blank">


										<div class="form-footer  d-flex justify-content-end">
											<button type="submit" class="btn btn-primary btn-pill" formaction="../pdf/print-add-customer-pdf.php">ພິນຂໍ້ມູນລູກຄ້າ</button>
											<?php

											if ($role_id == 1) {
												$syntax = "where add_by !='0'";
											?>
												<button type="submit" class="btn btn-success btn-pill" formaction="../export/export-customer-data.php">ດາວໂຫລດ</button>
											<?php
											} else {
												$syntax = "where add_by ='$id_users'";
											}
											?>

										</div><br>




										<table id="productsTable" class="table table-hover table-product" style="width:100%">
											<thead>
												<tr>
													<th>ລຳດັບ</th>
													<th>ລະຫັດລູກຄ້າ</th>
													<th>ຊື່ຮ້ານ</th>
													<th>ຊື່ລູກຄ້າ</th>
													<th>ເບິໂທ</th>
													<?php
													if ($role_id == 1) {
													?>
														<th>ວັນທີລົງທະບຽນ</th>
													<?php
													} else {
													?>
														<th>ປະເພດການຊຳລະ</th>
													<?php
													}

													?>

													<th></th>
												</tr>
											</thead>
											<tbody>


												<?php



												$stmt4 = $conn->prepare("  
 												SELECT c_id,c_code,c_shop_name,c_name,(case when payment_type = '0' then 'None' else payment_type end) as payment_type,
												phone1,staff_name,ref_number,date_register
												FROM tbl_customer a
												left join tbl_staff_sale b on a.staff_contact = b.staff_code
												$syntax
												order by c_id DESC ");
												$stmt4->execute();
												if ($stmt4->rowCount() > 0) {
													while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {


														$ref_number = $row4['ref_number'];
														$c_id = $row4['c_id'];
														$c_code = $row4['c_code'];
														$c_shop_name = $row4['c_shop_name'];
														$c_name = $row4['c_name'];
														$phone1 = $row4['phone1'];
														$payment_type = $row4['payment_type'];
														$date_register = $row4['date_register'];


												?>



														<tr>
															<td><?php echo "$ref_number"; ?></td>
															<td><?php echo "$c_code"; ?></td>
															<td><?php echo "$c_shop_name"; ?></td>
															<td><?php echo "$c_name"; ?></td>
															<td><?php echo "$phone1"; ?></td>

															<?php
															if ($role_id == 1) {
															?>
																<td><?php echo "$date_register"; ?></td>
															<?php
															} else {
															?>
																<td><?php echo "$payment_type"; ?></td>
															<?php
															}

															?>




															<td>
																<div class="form-check d-inline-block mr-3 mb-3">
																	<input class="form-check-input" type="checkbox" value="<?php echo "$c_id"; ?>" name="check_box[]" id="check_box<?php echo "$c_id"; ?>">
																	<label class="form-check-label" for="check_box<?php echo "$c_id"; ?>">

																	</label>
																</div>
															</td>
														</tr>


												<?php
													}
												}
												?>








											</tbody>
										</table>


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