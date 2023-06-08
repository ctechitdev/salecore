<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ແກ້ລາຄາ";
$header_click = "5";

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

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
	$(function() {



		$('#com_code').change(function() {
			var com_code = $('#com_code').val();
			$.post('../function/dynamic_dropdown/list_item_table.php', {
					com_code: com_code
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
											<button type="submit" class="btn btn-primary btn-pill" formaction="list-add-price.php">ຂໍແກ້ລາຄາ</button>
										</div><br>


										<div class="form-group  col-lg-12">
											<label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
											<div class="form-group">
												<select class=" form-control font" name="com_code" id="com_code">
													<option value=""> ເລຶອກລະຫັດກຸ່ມສິນຄ້າ </option>
													<?php
													$stmt = $conn->prepare(" select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
													from tbl_item_company_code a
													left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id'   ");
													$stmt->execute();
													if ($stmt->rowCount() > 0) {
														while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
													?> <option value="<?php echo $row['icc_id']; ?>"> <?php echo $row['item_group_code']; ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
										</div>




										<table id="productsTable" class="table table-hover table-product" style="width:100%">
											<thead>
												<tr>
													<th>ລຳດັບ</th>
													<th>ລະຫັດສິນຄ້າ</th>
													<th>ຊື່ສິນຄ້າ</th>
													<th>ລາຄາ</th>
													<th>ກຸ່ມສິນຄ້າ</th>
													<th>ຂະຫນາດ</th>

													<th>ຫົວໜ່ວຍຊື້</th>
													<th>ຫົວໜ່ວຍຂາຍ</th>
													<th></th>
												</tr>
											</thead>
											<tbody id="dis_id">


												<?php
												$i = 1;
												$stmt4 = $conn->prepare(" SELECT full_code,name_company,icl_id,item_code,item_name,item_price,buy_unit,sale_unit,concat(pack,'X',weight) as packing
												FROM tbl_item_code_list a
												left join tbl_item_company_code b on a.com_code = icc_id
                                                left join tbl_staff_item_code c on b.icc_id =c.icc_id
												where use_by  = '$depart_id' ");
												$stmt4->execute();
												if ($stmt4->rowCount() > 0) {
													while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
														$icl_id = $row4['icl_id'];
														$full_code = $row4['full_code'];
														$item_name = $row4['item_name'];
														$item_price = $row4['item_price'];
														$buy_unit = $row4['buy_unit'];
														$sale_unit = $row4['sale_unit'];
														$packing = $row4['packing'];
														$name_company = $row4['name_company'];

												?>



														<tr>
															<td><?php echo "$i"; ?></td>
															<td><?php echo "$full_code"; ?></td>
															<td><?php echo "$item_name"; ?></td>
															<td><?php echo "$item_price"; ?></td>
															<td><?php echo "$name_company"; ?></td>
															<td><?php echo "$packing"; ?></td>
															<td><?php echo "$buy_unit"; ?></td>
															<td><?php echo "$sale_unit"; ?></td>



															<td>
																<div class="form-check d-inline-block mr-3 mb-3">
																	<input class="form-check-input" type="checkbox" value="<?php echo "$icl_id"; ?>" name="check_box[]" id="check_box<?php echo "$icl_id"; ?>">
																	<label class="form-check-label" for="check_box<?php echo "$icl_id"; ?>">

																	</label>
																</div>
															</td>
														</tr>


												<?php

														$i++;
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