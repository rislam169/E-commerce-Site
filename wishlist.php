<?php include 'inc/header.php'?>
<?php
	$cheklogin = Session::get("cmrlogin");
	if($cheklogin == false){
		header("Location: index.php");
	}
?>
<?php
if (isset($_GET['delwishid'])) {
    $delwishid = $_GET['delwishid'];
    $deletewish = $pd->removeWishList($cmrId, $delwishid);
}
?>
<style>
.shopcenter{text-align:center;}
.tblone tr td img{height: 70px;width: 100px;}
.cartpage h2 {width: 100%;}
</style>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Wish List</h2>
<?php
if (isset($deletewish)) {
    echo $deletewish;
}
?>
				<table class="tblone">
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
<?php
$getwishlist = $pd->getWishList($cmrId);
if ($getwishlist) {
    $i = 0;
    while ($result = $getwishlist->fetch_assoc()) {
        $i++;
        ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td>$<?php echo $result['price']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
						<td>
                            <span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Buy Now</a></span>
                            ||
                            <span><a href="?delwishid=<?php echo $result['productId']; ?>" class="details">Remove</a></span>
                        </td>
					</tr>
<?php }}?>
				</table>
			</div>
            <div class="shopcenter">
                <a href="index.php"> <img src="images/shop.png" alt="" /></a>
            </div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php'?>