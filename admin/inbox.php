<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
include '../classes/Cart.php';
$ct = new Cart();
$fm = new Format();
?>
<?php
if (isset($_GET['shiftid'])) {
    $orderId = $_GET['shiftid'];
    $shift = $ct->shiftedProduct($orderId);
}

if (isset($_GET['delproid'])) {
    $delproid = $_GET['delproid'];
    $deleteorder = $ct->deleteProduct($delproid);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Product Order</h2>
<?php
if (isset($shift)) {
    echo $shift;
}
?>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Product Id</th>
							<th>Product</th>
							<th>Order Time</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
$getallorder = $ct->getAllOrderProduct();
if ($getallorder) {
    while ($result = $getallorder->fetch_assoc()) {

        ?>
						<tr class="odd gradeX">
							<td><?php echo $result['productId']; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['date']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>$<?php echo $result['price']; ?></td>
							<td><a href="customer.php?custid=<?php echo $result['cmrId']; ?>">View Address</a></td>
<?php
if ($result['status'] == 0) {
            ?>
		<td><a href="?shiftid=<?php echo $result['id']; ?>">Shifted</a></td>
<?php
}if ($result['status'] == 1) {
            ?>
		<td><a>Pending</a></td>
<?php }?>
						</tr>
<?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
		<div class="grid_10">
            <div class="box round first grid">
                <h2>Delivered and Confirmed</h2>
<?php
if (isset($deleteorder)) {
    echo $deleteorder;
}
?>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Product Id</th>
							<th>Product</th>
							<th>Order Time</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
$getallorder = $ct->getAllConfirmedProduct();
if ($getallorder) {
    while ($result = $getallorder->fetch_assoc()) {

        ?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['date']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>$<?php echo $result['price']; ?></td>
							<td><a href="customer.php?custid=<?php echo $result['cmrId']; ?>">View Address</a></td>
							<td><a href="?delproid=<?php echo $result['id']; ?>">Remove</a></td>

						</tr>
<?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
