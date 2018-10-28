<?php include 'inc/header.php'?>
<?php
if (isset($_GET['proid'])) {
    $proid = $_GET['proid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
    $addcart = $ct->addToCart($quantity, $proid);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['procmprid'])) {
    $productId = $_POST['procmprid'];
    $insertcompare = $pd->addCompare($cmrId, $productId);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addwish'])) {
    $productId = $_POST['procmprid'];
    $insertcompare = $pd->addWishList($cmrId, $productId);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">
<?php
$getproduct = $pd->getSingleProductById($proid);
if ($getproduct) {
    while ($result = $getproduct->fetch_assoc()) {
        ?>
				<div class="grid images_3_of_2">
					<img src="admin/<?php echo $result['image']; ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1" />
							<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
						</form>
					</div>
					<span style="color:red;font-size:18px;">
<?php
if (isset($addcart)) {
            echo $addcart;
        }
        if (isset($insertcompare)) {
            echo $insertcompare;
        }
        ?>
					</span>
<?php
if (Session::get("cmrlogin") == true) {
            ?>
					<div class="add-cart">
						<form action="" method="post">
							<input type="hidden" class="buyfield" name="procmprid" value="<?php echo $result['productId']; ?>" />
							<input type="submit" class="buysubmit" name="addcompare" value="Add to Compare" />
							<input type="submit" class="buysubmit" name="addwish" value="Add to wishList" />
						</form>
					</div>
<?php }?>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<?php echo $result['body']; ?>
				</div>
<?php }}?>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
<?php
$getcat = $cat->getCategory();
if ($getcat) {
    while ($result = $getcat->fetch_assoc()) {
        ?>
					<li><a href="productbycat.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
<?php }}?>
				</ul>

			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>