<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພິນສິນຄ້າຫລາຍກຸ່ມ-ລາຄາ";
$header_click = "2";
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
									<form method="post">



										<table id="productsTable" class="table table-hover table-product" style="width:100%">
											<thead>
												<tr>
													<th>ເລກເອກະສານ</th>
													<th>ກຸ່ມສິນຄ້າ</th>
													<th>ລາຍການຂໍ</th>
													<th>ສະກຸນເງິນ</th>

													<th>ປະເພດລາຄາ(ຮ້ານ)</th>
													<th>ວັນທີນຳໃຊ້</th>
													<th>ວັງທີລົງທະບຽນ</th>
													<th></th>
												</tr>
											</thead>
											<tbody>


												<?php

												if ($role_id == 1) {
													$syntax = "where add_by !='0'";
												} else {
													$syntax = "where add_by ='$id_users'";
												}


												$stmt4 = $conn->prepare("
				
												SELECT count(icl_id) as count_list,a.it_id,b.date_register as date_register,ccy,name_company,pricelist_name,date_use
												FROM tbl_item_code_list a 
												left join tbl_item_code b on a.it_id = b.it_id 
												left join tbl_item_company_code c on b.icc_id = c.icc_id 
												left join tbl_price_list d on b.pl_id = d.pl_id
												$syntax
												group by a.it_id  ");

												$stmt4->execute();
												if ($stmt4->rowCount() > 0) {
													while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
														$name_company = $row4['name_company'];
														$date_use = $row4['date_use'];
														$count_list = $row4['count_list'];
														$it_id = $row4['it_id'];
														$ccy = $row4['ccy'];
														$pricelist_name = $row4['pricelist_name'];
														$date_register = $row4['date_register'];

												?>



														<tr>
															<td><?php echo "$it_id"; ?></td>
															<td><?php echo "$name_company"; ?></td>
															<td><?php echo "$count_list"; ?></td>
															<td><?php echo "$ccy"; ?></td>
															<td><?php echo "$pricelist_name"; ?></td>
															<td><?php echo "$date_use"; ?></td>
															<td><?php echo "$date_register"; ?></td>



															<td>
																<div class="dropdown">
																	<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
																	</a>

																	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
																		<a class="dropdown-item" href="../pdf/print-add-item-multi-price-group.php?item_id=<?php echo "$it_id"; ?>" target="_blank">ພິນລະຫັດສິນຄ້າ</a>

																		<?php

																		if ($role_id == 1) {
																		?>
																			<a class="dropdown-item" href="../export/export-item-multi-price-group.php?item_id=<?php echo "$it_id"; ?>">ດາວໂຫລດ</a>
																		<?php
																		}

																		?>

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