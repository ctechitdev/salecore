<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຜູ້ໃຊ້(ຮ້ານຄ້າ)";
$header_click = "3";

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



		$('#group_id').change(function() {
			var group_id = $('#group_id').val();
			$.post('../function/dynamic_dropdown/get_depart.php', {
					group_id: group_id
				},
				function(output) {
					$('#dp_id').html(output).show();
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


							<div class="col-xxl-12">
								<div class="email-right-column  email-body p-4 p-xl-5">
									<div class="email-body-head mb-5 ">
										<h4 class="text-dark">ສ້າງຜູ້ໃຊ້</h4>



									</div>
									<form method="post" id="addstaffuserFrm">


										<div class="row">

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຊື່ເຈົ້າຂອງຮ້ານ</label>
													<input type="text" class="form-control"  name="customer_name" required>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label for="firstName">ຢູສເຊີ້</label>
													<input type="text" class="form-control" name="customer_user_name" required>
												</div>
											</div>


 

									  


										</div>








										<div class="d-flex justify-content-end mt-6">
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຜູ້ໃຊ້ລູກຄ້າ</button>
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
										<th>ພະແນກ</th>

										<th>ສະຖານະ</th>
										<th>ສິດຈັດການ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare(" select usid,full_name,user_name,dp_name,role_name,
									(case when user_status = 1 then 'ເປີດນຳໃຊ້' else 'ປິດນຳໃຊ້' end) as user_status,date_register
									from tbl_user_staff a
									LEFT JOIN tbl_depart b on a.depart_id = b.dp_id
									LEFT join tbl_roles c on a.role_id = c.r_id ");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$usid = $row4['usid'];
											$full_name = $row4['full_name'];
											$user_name = $row4['user_name'];
											$dp_name = $row4['dp_name'];
											$user_status = $row4['user_status'];
											$role_name = $row4['role_name'];

									?>



											<tr>
												<td><?php echo "$usid"; ?></td>
												<td><?php echo "$full_name"; ?></td>
												<td><?php echo "$user_name"; ?></td>
												<td><?php echo "$dp_name"; ?></td>
												<td> <span class="badge <?php
																		if ($user_status == 'ປິດນຳໃຊ້') {
																			echo "badge-secondary";
																		} else {
																			echo "badge-success";
																		}

																		?>">
														<?php echo "$user_status"; ?></span></td>
												<td><?php echo "$role_name"; ?></td>



												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a class="dropdown-item" href="edit-staff-user.php?us_id=<?php echo "$usid"; ?>">ແກ້ໄຂ</a>
															<a class="dropdown-item" type="button" id="activestaffuser" data-id='<?php echo $row4['usid']; ?>' class="btn btn-danger btn-sm">ເປິດນຳໃຊ້</a>
															<a class="dropdown-item" type="button" id="inactivestaffuser" data-id='<?php echo $row4['usid']; ?>' class="btn btn-danger btn-sm">ປິດນຳໃຊ້</a>
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
		// Add staff user 
		$(document).on("submit", "#addstaffuserFrm", function() {
			$.post("../query/add-customer-user.php", $(this).serialize(), function(data) {
				if (data.res == "exist") {
					Swal.fire(
						'ລົງທະບຽນຊ້ຳ',
						'ຜູ້ໃຊ້ນີ້ຖືກລົງທະບຽນແລ້ວ',
						'error'
					)
				} else if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ເພິ່ມຜູ້ໃຊ້ສຳເລັດ',
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


		// active user
		$(document).on("click", "#activestaffuser", function(e) {
			e.preventDefault();
			var id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/activestaffuser.php",
				dataType: "json",
				data: {
					id: id
				},
				cache: false,
				success: function(data) {
					if (data.res == "success") {
						Swal.fire(
							'ສຳເລັດ',
							'ເປີດນຳໃຊ້ສຳເລັດ',
							'success'
						)
						setTimeout(
							function() {
								window.location.href = 'user-staff.php';
							}, 1000);

					}
				},
				error: function(xhr, ErrorStatus, error) {
					console.log(status.error);
				}

			});



			return false;
		});


		// inactive user
		$(document).on("click", "#inactivestaffuser", function(e) {
			e.preventDefault();
			var id = $(this).data("id");
			$.ajax({
				type: "post",
				url: "../query/inactivestaffuser.php",
				dataType: "json",
				data: {
					id: id
				},
				cache: false,
				success: function(data) {
					if (data.res == "success") {
						Swal.fire(
							'ສຳເລັດ',
							'ປິດນຳໃຊ້ສຳເລັດ',
							'success'
						)
						setTimeout(
							function() {
								window.location.href = 'user-staff.php';
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