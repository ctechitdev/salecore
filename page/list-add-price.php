<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$item_id = $_GET['item_id'];
$com_code = $_POST['com_code'];

?>

<!DOCTYPE html>



<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />


	<link href="../images/iconmenu.png" rel="shortcut icon" />
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
			$header_name = "ລະຫັດສິນຄ້າ";
			include "header.php";
			?>
			<div class="content-wrapper">
				<div class="content">

					<div class="email-wrapper rounded border bg-white">
						<div class="row no-gutters justify-content-center">



							<div class="    ">
								<div class="  email-body p-4 p-xl-5">
									<div class="email-body-head mb-6 ">
										<h4 class="text-dark">ເພິ່ມລະຫັດສິນຄ້າ</h4>
									</div>
									<form method="post" id="addpriceupdate">
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


																	// echo"$com_code ";

																	?>





																	<div class="form-group  col-lg-6">
																		<label class="text-dark font-weight-medium">ລະຫັດກຸ່ມສິນຄ້າ</label>
																		<div class="form-group">
																			<select class=" form-control font" name="com_code" id="com_code">
																				<option value=""> ເລຶອກລະຫັດກຸ່ມສິນຄ້າ </option>
																				<?php
																				$stmt = $conn->prepare(" select item_company_code, icc_id as icc_id,
																				concat('S',item_company_code, ' - ', name_company) as item_group_code 
																				from tbl_item_company_code 
																				where icc_id = '$com_code'   ");
																				$stmt->execute();
																				if ($stmt->rowCount() > 0) {
																					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
																						$edit_icc_id = $row["icc_id"];
																				?> <option value="<?php echo $row['icc_id']; ?>" <?php if ($com_code == "$edit_icc_id") {
																																		echo "selected";
																																	} ?>> <?php echo $row['item_group_code']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>





																	<div class="form-group  col-lg-6">
																		<label class="text-dark font-weight-medium">ປະເພດລາຄາ</label>
																		<div class="form-group">
																			<select class=" form-control font" name="price_list" id="price_list">
																				<option value=""> ເລຶອກປະເພດລາຄາ </option>
																				<?php
																				$stmt2 = $conn->prepare(" SELECT * from tbl_price_list  order by pricelist_name ");
																				$stmt2->execute();
																				if ($stmt2->rowCount() > 0) {
																					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
																						$edit_pl_id = $row2["b1_code"];
																				?> <option value="<?php echo $row2['b1_code']; ?>"> <?php echo $row2['pricelist_name']; ?></option>
																				<?php
																					}
																				}
																				?>
																			</select>
																		</div>
																	</div>







																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="firstName">ວັນທີນຳໃຊ້</label>
																			<input type="date" class="form-control" id="date_request" name="date_request" value='<?php echo "$date_use"; ?>' required>
																		</div>
																	</div>

																	<div class="form-group  col-lg-6">
																		<label class="text-dark font-weight-medium">ສະກຸນເງິນ</label>
																		<div class="form-group">
																			<select class=" form-control font" name="ccy" id="ccy">
																				<option value=""> ເລືອກສະກຸນເງິນ </option>
																				<option value="kip"> KIP </option>
																				<option value="thb"> THB </option>
																				<option value="usd"> USD </option>
																			</select>
																		</div>
																	</div>




																</div>
															</div>
															<table class="table" id="productTable">
																<thead>
																	<tr>
																		<th style="width:65%;">ລະຫັດສິນຄ້າ</th>
																		<th style="width:25%;">ລາຄາ</th>
																		<th style="width:10%"></th>

																	</tr>
																</thead>
																<tbody>
																	<?php
																	for ($y = 0; $y < count($_POST['check_box']); $y++) {
																		$check_box = $_POST['check_box'][$y];




																		$arrayNumber = 0;

																		$stmt3 = $conn->prepare(" SELECT * FROM tbl_item_code_list where icl_id ='$check_box' ");
																		$stmt3->execute();
																		$x = 1;
																		if ($stmt3->rowCount() > 0) {
																			while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {


																	?>
																				<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

																					<input type="hidden" name="itemid[]" id="itemid<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['icl_id']; ?>" readonly />

																					<td>
																						<div class="form-group">
																							<input type="text" name="itemname[]" id="itemname<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $row3['item_name']; ?>" readonly />
																						</div>
																					</td>


																					<td>
																						<div class="form-group">
																							<input type="number" step="any" name="item_price[]" id="item_price<?php echo $x; ?>" autocomplete="off" class="form-control" required />
																						</div>
																					</td>
																					<td>
																						<div class="form-group"><button type="button" class="btn btn-primary btn-flat " onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="mdi mdi-briefcase-plus"></i></button></div>
																					</td>
																					<td>

																						<div class="form-group"><button type="button" class="btn btn-danger  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="mdi mdi-briefcase-remove"></i></button></div>


																					</td>

																				</tr>
																	<?php
																				$arrayNumber++;
																				$x++;
																			}
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
											<button type="submit" class="btn btn-primary mb-2 btn-pill">ເພີ່ມຂໍ້ມູນ</button>
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
									$stmt4 = $conn->prepare(" 

									SELECT count(icl_id) as count_list,a.it_id,b.date_register as date_register,ccy,name_company,pricelist_name,date_use
									FROM tbl_item_code_list a 
									left join tbl_item_code b on a.it_id = b.it_id 
									left join tbl_item_company_code c on b.icc_id = c.icc_id 
									left join tbl_price_list d on b.pl_id = d.pl_id
									where add_by ='$id_users'
									group by a.it_id ");
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
															<a class="dropdown-item" href="edit-customer.php?item_id=<?php echo "$c_id"; ?>">ແກ້ໄຂ</a>


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
		// add Customer Data 
		$(document).on("submit", "#addpriceupdate", function() {
			$.post("../query/addpriceupdate.php", $(this).serialize(), function(data) {
				if (data.res == "invalid") {
					Swal.fire(
						'ແຈ້ງເຕືອນ',
						'ກະລຸນາຕື່ມຂໍ້ມູນໄຫ້ຄົບຖ້ວນ',
						'error'
					)
				} else if (data.res == "success") {

					Swal.fire(
						'ສຳເລັດ',
						'ລົງທະບຽນຂໍປ່ຽນລາຄາສຳເລັດ',
						'success'
					)

					setTimeout(
						function() {

							window.location.href = 'price-update-list.php';
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
				url: '../query/itemlist.php',
				type: 'post',
				data: {
					com_code: $("#com_code").val()
				},
				dataType: 'json',
				success: function(response) {
					$("#addRowBtn").button("reset");



					var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +

						'<td>' +
						'<div class="form-group">' +

						'<select class="form-control" name="itemid[]" id="itemid' + count + '" >' +
						'<option value="">ເລືອກຊື່ສິນຄ້າ</option>';
					// console.log(response);
					$.each(response, function(index, value) {
						tr += '<option value="' + value[0] + '">' + value[2] + '</option>';
					});

					tr += '</select>' +
						'</div>' +
						'</td>' +

						'<td>  <div class="form-group">' +
						'<input type="number" step="any" name="item_price[]" id="item_price' + count + '" autocomplete="off" class="form-control" required/>' +
						'</div></td>' +


						'<td>  <div class="form-group">' +
						'<button class="btn btn-primary removeProductRowBtn" type="button" onclick="addRow(' + count + ')"><i class="mdi mdi-briefcase-plus"></i></button>' +
						'</div> </td>' +
						' <td>  <div class="form-group">' +
						'<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +
						'</div></td>' +

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