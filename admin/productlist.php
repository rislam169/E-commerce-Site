<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php
$fm = new Format();
$pd = new Product();
$getproduct = $pd->getProduct();
?>
<?php
if (isset($_GET['delproductid'])) {
    $delproductid = $_GET['delproductid'];
    $delproduct = $pd->deleteProductById($delproductid);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
<?php
if(isset($delproduct)){
	echo $delproduct;
}
?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Image</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php
if ($getproduct) {
    $i = 0;
    while ($result = $getproduct->fetch_assoc()) {
        $i++;
        ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 35); ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="50px" alt="Product Image"></td>
					<td><?php echo $result['price']; ?></td>
					<td>
<?php
if ($result['type'] == 0) {
            echo "Fetured";
        } else {
            echo "General";
        }
        ?>
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delproductid=<?php echo $result['productId']; ?>">Delete</a></td>
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
