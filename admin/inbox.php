<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
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
$ct = new Cart();
$fm = new Format();

$getallorder = $ct->getAllOrderProduct();
if ($getallorder) {
    while ($result = $getallorder->fetch_assoc()) {

        ?>
						<tr class="odd gradeX">
							<td>01</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td><a href="">Shifted</a></td>
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
