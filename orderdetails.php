<?php include 'inc/header.php'?>
<?php
$cheklogin = Session::get("cmrlogin");
if ($cheklogin == false) {
    header("Location: login.php");
}
?>
<style>
.tblone tr td{text-align:justify;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="notfound">
                <h2>Your order details</h2>
				<table class="tblone">
					<tr>
						<th>No</th>
						<th>Product Name</th>
						<th>Image</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
<?php
$cmrId = Session::get('cmrId');
$getorderproduct = $ct->getOrderProduct($cmrId);
if ($getorderproduct) {
    $i = 0;
    $qty = 0;
    $sum = 0;
    while ($result = $getorderproduct->fetch_assoc()) {
        $i++;
        ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
						<td><?php echo $result['quantity']; ?></td>
						<td>$<?php echo $result['price']; ?></td>
						<td><?php echo $fm->formatDate($result['date']); ?></td>
						<td>
<?php
if ($result['status'] == 0) {
            echo "Pending";
        } else {
            echo "Shifted";
        }
        ?>
						</td>
						<?php
if ($result['status'] == 1) {?>
            <td><a onclick="return confirm('Are you sure to delete!')" href="?delproid=<?php echo $result['id']; ?>">X</a></td>
<?php
} else {
            ?>
	<td>N/A</td>
<?php
}
        ?>

					</tr>
<?php }}?>
				</table>
            </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>