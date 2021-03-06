<?php include 'inc/header.php'?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == null) {
    echo "<script>window.location = '404.php';</script>";
} else {
    $catid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from Category</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
<?php
$getprobyid = $pd->getProductByCategoryId($catid);
if ($getprobyid) {
    while ($result = $getprobyid->fetch_assoc()) {
        ?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="Product" height="200px" width="250px"/></a>
				<h2><?php echo $result['productName']; ?></h2>
				<p><?php echo $fm->textShorten($result['body'], 60); ?></p>
                <p><span class="price">$<?php echo $result['price']; ?></span></p>
				<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
			</div>
<?php }} else {header("Location: 404.php");}?>
		</div>



	</div>
</div>
<?php include 'inc/footer.php'?>