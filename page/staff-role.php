<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຜູກກຸ່ມລູກຄ້າ";
$header_click = "3";
?>


<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Mono - Responsive Admin & Dashboard Template</title>
	<?php

	include("../setting/callcss.php");
	?>


	<script src="plugins/nprogress/nprogress.js"></script>
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
						<div class="row no-gutters justify-content-center">


							<div class=" col-xxl-12">
								<div class="email-right-column  email-body p-4 p-xl-5">
									<div class="email-body-head mb-5 ">
										<h4 class="text-dark">ຜູກກຸ່ມລູກຄ້າ</h4>



									</div>
									<form method="post" id="joinstafffrm">


										<div class="row">

											<div class="form-group  col-lg-12">
												<label class="text-dark font-weight-medium">ຢູສເຊີ້ພະນັກງານ</label>
												<div class="form-group">
													<select class=" form-control font" name="staff_id" id="staff_id">
														<option value=""> ເລືອກຢູສເຊີ້ພະນັກງານ </option>
														<?php
														$stmt2 = $conn->prepare(" SELECT * from tbl_user_staff order by user_name  ");
														$stmt2->execute();
														if ($stmt2->rowCount() > 0) {
															while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
														?> <option value="<?php echo $row2['usid']; ?>"> <?php echo $row2['user_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="form-group  col-lg-12">
												<label class="text-dark font-weight-medium">ລະຫັດບໍລິສັດ</label>
												<div class="form-group">
													<select class=" form-control font" name="Acc_id" id="Acc_id">
														<option value=""> ເລຶອກລະຫັດບໍລິສັດ </option>
														<?php
														$stmt1 = $conn->prepare(" SELECT company_code,concat(company_code ,' (',acc_name, ') ') as full_code FROM tbl_account_company order by company_code ");
														$stmt1->execute();
														if ($stmt1->rowCount() > 0) {
															while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
														?> <option value="<?php echo $row1['company_code']; ?>"> <?php echo $row1['full_code']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>





										</div>








										<div class="d-flex justify-content-end mt-6">
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ຜູກພະນັກງານກັບລະຫັດບໍລະສັດ</button>
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
										<th>ຊື່ຜູ້ໃຊ້</th>
										<th>ຢູສເຊີ້</th>
										<th>ສິດຈັດການ</th>
										<th>ລະຫັດບໍລິສັດ</th>
										<th>ວັນລົງທະບຽນ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare(" select sc_id,user_name,full_name,acc_name,a.date_register as date_register,a.company_code as company_code
				from tbl_staff_company a
				left join tbl_user_staff b
				on a.user_id = b.usid left join tbl_account_company c on a.company_code = c.company_code ");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$sc_id = $row4['sc_id'];
											$user_name = $row4['user_name'];
											$full_name = $row4['full_name'];
											$acc_name = $row4['acc_name'];
											$company_code = $row4['company_code'];
											$date_register = $row4['date_register'];

									?>



											<tr>
												<td><?php echo "$sc_id"; ?></td>
												<td><?php echo "$full_name"; ?></td>
												<td><?php echo "$user_name"; ?></td>
												<td><?php echo "$acc_name"; ?></td>
												<td><?php echo "$company_code"; ?></td>
												<td><?php echo "$date_register"; ?></td>



												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

															<a class="dropdown-item" type="button" id="deletestaffrole" data-id='<?php echo $row4['sc_id']; ?>' class="btn btn-danger btn-sm">ລຶບ</a>
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
		// join staff and company code
		$(document).on("submit", "#joinstafffrm", function() {
			$.post("../query/joinstaffcompany.php", $(this).serialize(), function(data) {
				if (data.res == "exist") {
					Swal.fire(
						'ບໍ່ສາມາດຜູກໄດ້',
						'ຢູສເຊີ້ ແລະ ລະຫັດແມ່ນຖືກຜູກແລ້ວ',
						'error'
					)
				} else if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ລົດທະບຽນສິດສຳເລັດແລ້ວ',
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



		// Delete staff role
		$(document).on("click", "#deletestaffrole", function(e) {
			e.preventDefault();
			var id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/deletestaffrole.php",
				dataType: "json",
				data: {
					id: id
				},
				cache: false,
				success: function(data) {
					if (data.res == "success") {
						Swal.fire(
							'ສຳເລັດ',
							'ລຶບສິດສຳເລັດ',
							'success'
						)
						setTimeout(
							function() {
								window.location.href = 'staff-role.php';
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