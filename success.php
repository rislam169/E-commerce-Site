<?php include 'inc/header.php'?>
<style>
.greeting{min-height:300px;}
.greeting h2{font-size:30px; line-height:100px;text-align:center;}
.greeting p{text-align:center;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="greeting">
                <h2>Order Complete!</h2>
                <p>Total payable amount: <span style="font-size:18px;font-weight:bold;">$
<?php
$cmrId = Session::get('cmrId');
$totalamount = $ct->getTotalPayable($cmrId);
$sum = 0;
if ($totalamount) {
    while ($result = $totalamount->fetch_assoc()) {
        $sum = $sum + $result['price'];
    }
    echo $sum;

} else {
    echo "0.00";
}
?>
                </span></p>
                <p>We will contact you soon with delivery. Visit here for <a href="orderdetails.php">order detail</a></p>
            </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>