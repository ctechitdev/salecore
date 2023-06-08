<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ພິນດັດແກ້ສິນຄ້າ";
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
													<th>ເລກທີ</th>
													<th>ຈຳນວນລາຍການ</th>
													<th>ກຸ່ມສິນຄ້າ</th>
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

												SELECT  a.ie_id,count(b.iedl_id) as count_list,a.date_register
												FROM tbl_item_edit a
												left join tbl_item_edit_detail_list b on a.ie_id = b.ie_id
												$syntax
												group by b.ie_id 
												order by a.ie_id desc ");
												$stmt4->execute();
												if ($stmt4->rowCount() > 0) {
													while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

														$ie_id = $row4['ie_id'];
														$count_list = $row4['count_list'];
														$date_register = $row4['date_register'];

												?>



														<tr>
															<td><?php echo "$ie_id"; ?></td>
															<td><?php echo "$count_list"; ?></td>





															<td>
																<?php

																$stmt5 = $conn->prepare("
																select name_company 
																from tbl_item_edit_detail_list a
																left join tbl_item_code_list b on a.item_id = b.icl_id
																left join tbl_item_company_code c on b.item_header_code = c.item_company_code
																where ie_id = '$ie_id'
																group by name_company  ");
																$stmt5->execute();

																if ($stmt5->rowCount() > 0) {
																	while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
																		$name_company = $row5['name_company'];
																		echo "$name_company ";
																	}
																}

																?>
															</td>
															<td><?php echo "$date_register"; ?></td>
															<td>
																<div class="dropdown">
																	<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
																	</a>

																	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
																		<a class="dropdown-item" href="../pdf/print-add-item-update-pdf.php?item_id=<?php echo "$ie_id"; ?>" target="_blank">ພິນລະຫັດສິນຄ້າ</a>

																		<?php

																		if ($role_id == 1) {
																		?>
																			<a class="dropdown-item" href="../export/export-item-data.php?item_id=<?php echo "$ie_id"; ?>">ດາວໂຫລດ</a>

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
 
</body>

</html>