<?php include 'inc/header.php'?>
<style>
.shopcenter{text-align:center;}
.tblone tr td{text-align:justify;}
.tblone tr td img{height: 70px;width: 100px;}
.cartpage h2 {width: 100%;}

</style>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Product Compare</h2>
				<table class="tblone">
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
<?php
$cmrId = Session::get('cmrId');
$getcompareproduct = $pd->getCompareProduct($cmrId);
if ($getcompareproduct) {
    $i = 0;
    while ($result = $getcompareproduct->fetch_assoc()) {
        $i++;
        ?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $result['productName']; ?></td>
						<td>$<?php echo $result['price']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
						<td><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></td>
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