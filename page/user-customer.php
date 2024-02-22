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
													<input type="text" class="form-control" name="customer_name" required>
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
										<th>ສະຖານະ</th>
										<th>ລົງທະບຽນ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>


									<?php
									$stmt4 = $conn->prepare("  SELECT  customer_user_id,customer_name,customer_user_name, customer_status,
									(case when customer_status = 1 then 'ເປີດນຳໃຊ້' when customer_status = 2 then 'ປິດນຳໃຊ້' else 'ປຽນລະຫັດ' end) as user_status_name,add_date
									FROM tbl_customer_user  
									where company_depart_id = '$depart_id'  ");
									$stmt4->execute();
									if ($stmt4->rowCount() > 0) {
										while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
											$usid = $row4['customer_user_id'];
											$full_name = $row4['customer_name'];
											$user_name = $row4['customer_user_name'];
											$user_status = $row4['customer_status'];
											$user_status_name = $row4['user_status_name'];
											$add_date = $row4['add_date'];

									?>



											<tr>
												<td><?php echo "$usid"; ?></td>
												<td><?php echo "$full_name"; ?></td>
												<td><?php echo "$user_name"; ?></td>
												<td> <span class="badge <?php
																		if ($user_status == '1') {
																			echo "badge-success";
																		} else if ($user_status == '2') {
																			echo "badge-danger";
																		} else {
																			echo "badge-info";
																		}

																		?>">
														<?php echo "$user_status_name"; ?>
													</span>
												</td>

												<td><?php echo "$add_date"; ?></td>

												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

															<a class="dropdown-item" type="button" id="reset-password" data-customer_user_id='<?php echo $row4['customer_user_id']; ?>' class="btn btn-danger btn-sm">ຣີເຊັດລະຫັດ</a>
															<a class="dropdown-item" type="button" id="ative-user" data-customer_user_id='<?php echo $row4['customer_user_id']; ?>' class="btn btn-danger btn-sm">ເປິດນຳໃຊ້</a>
															<a class="dropdown-item" type="button" id="disable-user" data-customer_user_id='<?php echo $row4['customer_user_id']; ?>' class="btn btn-danger btn-sm">ປິດນຳໃຊ້</a>
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

		$(document).on("click", "#reset-password", function(e) {
			e.preventDefault();
			var customer_user_id = $(this).data("customer_user_id");
			$.ajax({
				type: "post",
				url: "../query/update-customer-user.php",
				dataType: "json",
				data: {
					customer_user_id: customer_user_id,
					customer_status_id: 3
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
								location.reload();
							}, 1000);

					}
				},
				error: function(xhr, ErrorStatus, error) {
					console.log(status.error);
				}

			});



			return false;
		});


		// active user
		$(document).on("click", "#ative-user", function(e) {
			e.preventDefault();
			var customer_user_id = $(this).data("customer_user_id");
			$.ajax({
				type: "post",
				url: "../query/update-customer-user.php",
				dataType: "json",
				data: {
					customer_user_id: customer_user_id,
					customer_status_id: 1
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
								location.reload();
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
		$(document).on("click", "#disable-user", function(e) {
			e.preventDefault();
			var customer_user_id = $(this).data("customer_user_id");
			$.ajax({
				type: "post",
				url: "../query/update-customer-user.php",
				dataType: "json",
				data: {
					customer_user_id: customer_user_id,
					customer_status_id: 2
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
								location.reload();
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