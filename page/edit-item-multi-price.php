<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ເພິ່ມສິນຄ້າຫຼາຍລາຄາ";
$header_click = "2";

$item_id = $_GET['item_id'];

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
			$header_name = "ແກ້ໄຂສິນຄ້າຫຼາຍລາຄາ";
			include "header.php";
			?>
			<div class="content-wrapper">
				<div class="content">

					<div class="email-wrapper rounded border bg-white">
						<div class="row no-gutters justify-content-center">



							<div class="    ">
								<div class="email-right-column  email-body p-4 p-xl-5">
									<div class="email-body-head mb-6 ">
										<h4 class="text-dark">ແກ້ໄຂສິນຄ້າຫຼາຍລາຄາ</h4>




									</div>
									<form method="post" id="edititemfrm">







										<div class="row">



											<div class="col-lg-12">
												<div class="card">
													<div class="card-title">

													</div>
													<div id="add-brand-messages"></div>
													<div class="card-body">
														<div class="input-states">
															<div class="form-group">
																<div class="row">


																	<?php

																	$cusrows = $conn->query("SELECT  * FROM tbl_item_code where it_id = '$item_id' ")->fetch(PDO::FETCH_ASSOC);
																	$it_id = $cusrows['it_id'];
																	$icc_id = $cusrows['icc_id'];
																	$date_use = $cusrows['date_use'];
																	$ccy = $cusrows['ccy'];


																	?>

																	<input type="hidden" class="form-control" id="item_id" name="item_id" autocomplete="off" value="<?php echo $it_id ?>" />


																	<div class="form-group  col-lg-4">
																		<label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
																		<div class="form-group">
																			<select class=" form-control font" name="item_group_code" id="item_group_code">
																				<option value=""> ເລືອກລະຫັດກຸ່ມສິນຄ້າ </option>
																				<?php
																				$stmt1 = $conn->prepare(" select item_company_code,a.icc_id as icc_id,concat('S',item_company_code, ' - ', name_company) as item_group_code 
																				from tbl_item_company_code a
																				left join tbl_staff_item_code b on a.icc_id = b.icc_id where use_by = '$depart_id'  ");
																				$stmt1->execute();
																				if ($stmt1->rowCount() > 0) {
																					while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
																						$edit_icc_id = $row1["icc_id"];
																				?> <option value="<?php echo $row1['icc_id']; ?>" <?php if ($icc_id == "$edit_icc_id") {
																																		echo "selected";
																																	} ?>> <?php echo $row1['item_group_code']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>








																	<div class="col-lg-4">
																		<div class="form-group">
																			<label for="firstName">ວັນທີນຳໃຊ້</label>
																			<input type="date" class="form-control" id="date_request" name="date_request" value='<?php echo "$date_use"; ?>' required>
																		</div>
																	</div>

																	<div class="form-group col-lg-4">
																		<label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
																		<div class="form-group">
																			<select class=" form-control font" name="ccy" id="ccy">
																				<option value=""> ເລືອກສະກຸນເງິນ </option>
																				<option value="kip" <?php if ($ccy == "kip") {
																										echo "selected";
																									} ?>> KIP </option>
																				<option value="thb" <?php if ($ccy == "thb") {
																										echo "selected";
																									} ?>> THB </option>
																				<option value="usd" <?php if ($ccy == "usd") {
																										echo "selected";
																									} ?>> USD </option>
																			</select>
																		</div>
																	</div>




																</div>
															</div>
															<table class="table" id="productTable">

																<tbody>
																	<?php
																	$arrayNumber = 0;

																	$stmt3 = $conn->prepare(" SELECT * FROM tbl_item_code_list where it_id ='$item_id' ");
																	$stmt3->execute();
																	$x = 1;
																	if ($stmt3->rowCount() > 0) {
																		while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {


																	?>

																			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

																				<td>

																					<div class="form-group "> <?php echo "ລາຍການທີ: $x"; ?> <br>
																						<div class="row p-2">


																							<div class="form-group  col-lg-3">
																								<label class="text-dark font-weight-medium">ລະຫັດສິນຄ້າ</label>
																								<div class="form-group">
																									<input type="text" step="any" name="itemcode[]" id="itemcode<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_code']; ?>" />
																								</div>
																							</div>


																							<div class="col-lg-3">
																								<div class="form-group">
																									<label for="firstName">ຊື່ສິນຄ້າ</label>
																									<input type="text" step="any" name="itemname[]" id="itemname<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_name']; ?>" />
																								</div>
																							</div>

																							<div class="col-lg-3">
																								<div class="form-group">
																									<label for="firstName">ລາຄາຊື້</label>
																									<input type="number" step="any" name="item_price_pur[]" id="item_price_pur<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_price_purchase']; ?>" />
																								</div>
																							</div>

																							<div class="col-lg-3">
																								<div class="form-group">
																									<label for="firstName">ລາຄາຂາຍ</label>
																									<input type="number" step="any" name="item_price_base[]" id="item_price_base<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_price']; ?>" />
																								</div>
																							</div>

																							<div class="col-lg-2">
																								<div class="form-group">
																									<label for="firstName">ຫົວໜ່ວຍໃຫຍ່</label>
																									<select class="form-control" name="buy_unit[]" id="buy_unit<?php echo $x; ?>">
																										<option value="">ຫົວໜ່ວຍ</option>
																										<?php
																										$stmt4 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name  ");
																										$stmt4->execute();
																										if ($stmt4->rowCount() > 0) {
																											while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
																												$edit_buy_unit = $row4["cat_name"];
																										?> <option value="<?php echo $row4['cat_name']; ?>" <?php if ($row3['buy_unit'] == "$edit_buy_unit") {
																																								echo "selected";
																																							} ?>> <?php echo $row4['cat_name']; ?></option>
																										<?php
																											}
																										}
																										?>
																									</select>
																								</div>
																							</div>

																							<div class="col-lg-2">
																								<div class="form-group">
																									<label for="firstName">ຫົວໜ່ວຍນ້ອຍ</label>
																									<select class="form-control" name="sale_unit[]" id="sale_unit<?php echo $x; ?>">
																										<option value="">ຫົວໜ່ວຍ</option>
																										<?php
																										$stmt5 = $conn->prepare(" SELECT * from tbl_category_type  order by cat_name  ");
																										$stmt5->execute();
																										if ($stmt5->rowCount() > 0) {
																											while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
																												$edit_sale_unit = $row5["cat_name"];
																										?> <option value="<?php echo $row5['cat_name']; ?>" <?php if ($row3['sale_unit'] == "$edit_sale_unit") {
																																								echo "selected";
																																							} ?>> <?php echo $row5['cat_name']; ?></option>
																										<?php
																											}
																										}
																										?>
																									</select>

																								</div>
																							</div>

																							<div class="col-lg-2">
																								<div class="form-group">
																									<label for="firstName">ປະລິມານ</label>
																									<input type="number" step="any" name="pack[]" id="pack<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['pack']; ?>" />
																								</div>
																							</div>

																							<div class="col-lg-3">
																								<div class="form-group">
																									<label for="firstName">ຫໍ່ຫຸ້ມ</label>
																									<input type="text" step="any" name="weight[]" id="weight<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['weight']; ?>" />
																								</div>
																							</div>

																							<div class="col-lg-3">
																								<div class="form-group">
																									<label for="firstName">ຍິຫໍ້</label>
																									<input type="text" step="any" name="brand_name[]" id="brand_name<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['brand_name']; ?>" />
																								</div>
																							</div>


																						</div>
																					</div>



																					<div class="d-flex justify-content-end mt-6 ">

																						<div class="form-group p-4">
																							<button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading...">
																								<i class="mdi mdi-briefcase-plus"></i>
																							</button>
																						</div>


																						<div class="form-group p-4">
																							<button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)">
																								<i class="mdi mdi-briefcase-remove"></i>
																							</button>
																						</div>
																					</div>


																				</td>
																			</tr>



																	<?php
																			$arrayNumber++;
																			$x++;
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



										<div class="d-flex justify-content-end mt-6">
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ແກ້ໄຂຂໍ້ມູນ</button>
										</div>

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

	<script>
		// add Customer Data 
		$(document).on("submit", "#edititemfrm", function() {
			$.post("../query/edit-item-multi-price.php", $(this).serialize(), function(data) {
				if (data.res == "invalid") {
					Swal.fire(
						'ແຈ້ງເຕືອນ',
						'ກະລຸນາຕື່ມຂໍ້ມູນໄຫ້ຄົບຖ້ວນ',
						'error'
					)
				} else if (data.res == "success") {

					Swal.fire(
						'ສຳເລັດ',
						'ແກ້ໄຂສຳເລັດ',
						'success'
					)

					setTimeout(
						function() {

							location.reload();
						}, 1000);

				}
			}, 'json');

			return false;
		});


		function addRow() {
			$("#addRowBtn").button("loading");

			var tableLength = $("#productTable tbody tr").length;

			var tableRow;
			var arrayNumber;
			var count;

			if (tableLength > 0) {
				tableRow = $("#productTable tbody tr:last").attr('id');
				arrayNumber = $("#productTable tbody tr:last").attr('class');
				count = tableRow.substring(3);
				count = Number(count) + 1;
				arrayNumber = Number(arrayNumber) + 1;
			} else {
				// no table row
				count = 1;
				arrayNumber = 0;
			}

			$.ajax({
				url: '../query/fetchItemData.php',
				type: 'post',
				dataType: 'json',
				success: function(response) {
					$("#addRowBtn").button("reset");



					var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +


						'<td>' +
						'<div class="form-group">ລາຍການທີ: ' + count +
						'<div class="row p-2">' +
						'<div class="form-group  col-lg-3">' +
						'<label class="text-dark font-weight-medium">ລະຫັດສິນຄ້າ</label>' +
						'<div class="form-group">' +
						'<input type="text" name="itemcode[]" id="itemcode' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-3">' +
						'<div class="form-group">' +
						'<label for="firstName">ຊື່ສິນຄ້າ</label>' +
						'<input type="text" name="itemname[]" id="itemname' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-3">' +
						'<div class="form-group">' +
						'<label for="firstName">ລາຄາຊື້</label>' +
						'<input type="number" step="any" name="item_price_pur[]" id="item_price_pur' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-3">' +
						'<div class="form-group">' +
						'<label for="firstName">ລາຄາຂາຍ</label>' +
						'<input type="number" step="any" name="item_price_base[]" id="item_price_base' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-2">' +
						'<div class="form-group">' +
						'<label for="firstName">ຫົວໜ່ວຍນ້ອຍ</label>' +


						'<select class="form-control" name="buy_unit[]" id="buy_unit' + count + '" >' +
						'<option value="">ຫົວໜ່ວຍ</option>';
					$.each(response, function(index, value) {
						tr += '<option value="' + value[1] + '">' + value[1] + '</option>';
					});
					tr += '</select>' +

						'</div>' +
						'</div>' +

						'<div class="col-lg-2">' +
						'<div class="form-group">' +
						'<label for="firstName">ຫົວໜ່ວຍນ້ອຍ</label>' +


						'<select class="form-control" name="sale_unit[]" id="sale_unit' + count + '" >' +
						'<option value="">ຫົວໜ່ວຍ</option>';
					$.each(response, function(index, value) {
						tr += '<option value="' + value[1] + '">' + value[1] + '</option>';
					});
					tr += '</select>' +

						'</div>' +
						'</div>' +

						'<div class="col-lg-2">' +
						'<div class="form-group">' +
						'<label for="firstName">ປະລິມານ</label>' +
						'<input type="number" name="pack[]" id="pack' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-3">' +
						'<div class="form-group">' +
						'<label for="firstName">ຫໍ່ຫຸ້ມ</label>' +
						'<input type="text" name="weight[]" id="weight' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +

						'<div class="col-lg-3">' +
						'<div class="form-group">' +
						'<label for="firstName">ຍິຫໍ້</label>' +
						'<input type="text" name="brand_name[]" id="brand_name' + count + '" autocomplete="off" class="form-control" />' +
						'</div>' +
						'</div>' +


						'</div>' +
						'</div>' +
						'<div class="d-flex justify-content-end mt-6 ">' +

						'<div class="form-group p-4">' +
						'<button class="btn btn-primary removeProductRowBtn" type="button" onclick="addRow(' + count + ')"><i class="mdi mdi-briefcase-plus"></i></button>' +
						'</div>' +


						'<div class="form-group p-4">' +
						'<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +

						'</div>' +
						'</div>' +


						'</td>' +


						'</tr>';
					if (tableLength > 0) {
						$("#productTable tbody tr:last").after(tr);
					} else {
						$("#productTable tbody").append(tr);
					}

				} // /success
			}); // get the product data

		} // /add row

		function removeProductRow(row = null) {
			if (row) {
				$("#row" + row).remove();


				subAmount();
			} else {
				alert('error! Refresh the page again');
			}
		}
	</script>

	<!--  -->


</body>

</html>