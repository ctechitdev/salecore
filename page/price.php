<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຄາສິນຄ້າ";
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


</head>
<script src="../plugins/nprogress/nprogress.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
	$(document).on("click", "#editmodal", function(e) {
		e.preventDefault();
		var item_code = $(this).data("item_code");
		var pack_type_name = $(this).data("pack_type_name");

		$.post('../function/modal/price-manage.php', {
				item_code: item_code,
				pack_type_name: pack_type_name
			},
			function(output) {
				$('.show_data_edit').html(output).show();
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

					<div class="card card-default">

						<div class="card-body">

							<table id="productsTable4" class="table table-hover table-product" style="width:100%">
								<thead>
									<tr>
										<th>ເລກລຳດັບ</th>
										<th>ໂຄດສິນຄ້າ</th>
										<th>ຊື່ສິນຄ້າ</th>
										<th>ຫົວໜ່ວຍ</th>
										<th>ລາຄາ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php


									$i = 1;
									$stmt1 = $conn->prepare(" select a.item_code,item_name,pack_type_name,sale_price
									from tbl_item_price_sale a
									left join tbl_item_code_list b on a.item_code = b.full_code 
									order by item_name asc ");
									$stmt1->execute();
									if ($stmt1->rowCount() > 0) {
										while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
									?>

											<tr>

												<td><?php echo  $i; ?></td>
												<td><?php echo  $row1['item_code']; ?></td>
												<td><?php echo  $row1['item_name']; ?></td>
												<td><?php echo  $row1['pack_type_name']; ?></td>

												<td><?php echo number_format($row1['sale_price'], 2); ?></td>
												<td>
													<div class="dropdown">
														<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
														</a>

														<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
															<a href="javascript:0" class="dropdown-item" id="editmodal" data-item_code='<?php echo $row1['item_code']; ?>' data-pack_type_name='<?php echo $row1['pack_type_name']; ?>' data-toggle="modal" data-target="#modal-edit">ປັບລາຄາ</a>

														</div>
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

						</div>
					</div>
					<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header justify-content-end border-bottom-0">


									<button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
										<i class="mdi mdi-close"></i>
									</button>
								</div>

								<div class="show_data_edit">



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
		$(document).on("submit", "#update-modal", function() {
			$.post("../query/update-item-price.php", $(this).serialize(), function(data) {
				if (data.res == "success") {
					Swal.fire(
						'ສຳເລັດ',
						'ປ່ຽນລາຄາສຳເລັດ',
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
	</script>

	<!--  -->


</body>

</html>