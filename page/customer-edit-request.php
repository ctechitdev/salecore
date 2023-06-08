<?php
include("../setting/checksession.php");
include("../setting/conn.php");

?>

<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Mono - Responsive Admin & Dashboard Template</title>
	<?php

	include "callcss.php";

	?>


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


<body class="navbar-fixed sidebar-fixed" id="body">




	<div class="wrapper">

		<?php include "menu.php"; ?>

		<div class="page-wrapper">

			<?php
			$header_name = "ດັດແກ້ຂໍ້ມູນລູກຄ້າ";
			include "header.php";
			?>
			<div class="content-wrapper">
				<div class="content">
					<div class="email-wrapper rounded border bg-white">
						<div class="row no-gutters justify-content-center">

							<?php

							include "menu-sub-customer.php";

							// echo "$com_code_type ";




							?>



							<div class="col-lg-8 col-xl-9 col-xxl-10">
								<div class="email-right-column  email-body p-4 p-xl-5">
									<div class="email-body-head mb-5 ">
										<h4 class="text-dark">ດັດແກ້ຂໍ້ມູນລູກຄ້າ</h4>



									</div>

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
													<th></th>
												</tr>
											</thead>
											<tbody>


												<?php
												$stmt4 = $conn->prepare("  

				SELECT c_id,c_code,c_shop_name,c_name,payment_type,phone1,staff_name
				FROM tbl_customer a
				left join tbl_staff_sale b on a.staff_contact = b.staff_code
				where add_by ='$id_users'
				order by c_id DESC

				");
												$stmt4->execute();
												if ($stmt4->rowCount() > 0) {
													while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
														$c_id = $row4['c_id'];
														$c_code = $row4['c_code'];
														$c_shop_name = $row4['c_shop_name'];
														$c_name = $row4['c_name'];
														$phone1 = $row4['phone1'];
														$payment_type = $row4['payment_type'];

												?>



														<tr>
															<td><?php echo "$c_id"; ?></td>
															<td><?php echo "$c_code"; ?></td>
															<td><?php echo "$c_shop_name"; ?></td>
															<td><?php echo "$c_name"; ?></td>
															<td><?php echo "$phone1"; ?></td>
															<td><?php echo "$payment_type"; ?></td>



															<td>
																<div class="dropdown">
																	<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
																	</a>

																	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
																		<a class="dropdown-item" href="edit-customer.php?cus_id=<?php echo "$c_id"; ?>">ດັດແກ້</a>


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



	<!--  -->


</body>

</html>