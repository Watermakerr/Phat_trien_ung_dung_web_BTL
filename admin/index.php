<?php
require 'header.php';
?>
<div class="container" style="padding-top: 20px;">
	<div class="container">
		<div class="row">
			<table class="table" border="1px">
				<thead class="thead-dark">
					<tr>
						<th>
							<h6>Danh sách</h6>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row"><a href="show_feedback.php" style="color: #d75335;text-decoration: none;"><i class="fas fa-eye"></i> Quản lý bình luận</a></th><br>
					</tr>
					<tr>
						<th scope="row"><a href="show_product.php" style="color: #d75335;text-decoration: none;"><i class="fas fa-eye"></i> Quản lý sản phẩm</a></th><br>
					</tr>
					<tr>
						<th scope="row"><a href="show_order.php" style="color: #d75335;text-decoration: none;"><i class="fas fa-eye"></i> Quản lý đơn hàng</a></th><br>
					</tr>
					<tr>
						<th scope="row"><a href="show_user.php" style="color: #d75335;text-decoration: none;"><i class="fas fa-eye"></i> Quản lý người dùng</a></th><br>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<?php
			$revenueQuery = "SELECT SUM(products.price * order_details.quantity)
							AS revenue FROM orders JOIN order_details
							ON orders.order_id = order_details.order_id JOIN products
							ON order_details.product_id = products.product_id
							WHERE orders.create_at > DATE_SUB(NOW(), INTERVAL 30 DAY)";

			$orderQuery = "SELECT COUNT(*) AS orders FROM orders
								WHERE create_at > DATE_SUB(NOW(), INTERVAL 30 DAY)";

			$revenueResult = $conn->query($revenueQuery);
			$orderResult = $conn->query($orderQuery);

			$revenue = $revenueResult->fetch_assoc()['revenue'];
			$orders = $orderResult->fetch_assoc()['orders'];
			?>
			<div class="col-md-6">
				<div class="card text-white bg-primary mb-3">
					<div class="card-header">Doanh thu 30 ngày gần nhất</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo number_format($revenue); ?>đ</h5>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card text-white bg-success mb-3">
					<div class="card-header">Số lượng đơn hàng trong 30 ngày gần nhất
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $orders; ?> orders</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>