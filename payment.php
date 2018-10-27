<?php include 'inc/header.php'?>
<?php
$cheklogin = Session::get("cmrlogin");
if ($cheklogin == false) {
    header("Location: login.php");
}
?>
<style>
    .payment{width: 500px; margin: 0 auto; min-height:200px; padding: 50px; border: 1px solid #ddd; border-radius: 5px;text-align:center;
    }
    .payment h2{border-bottom:1px solid #ddd;margin-bottom:30px;padding-bottom:10px;}
    .payment a{background: #d35400 none repeat scroll 0 0;color: #fff;font-size: 20px;padding: 10px 30px;text-transform: uppercase;border-radius: 5px;}
    .payment a:hover{background: #f39c12 none repeat scroll 0 0;}
    .back {margin: 25px 0 0;text-align: center;}
    .back a{background: #34495e none repeat scroll 0 0;color: #fff;padding: 10px 50px;text-transform: uppercase;border-radius: 5px;}
    .back a:hover{background: #7f8c8d none repeat scroll 0 0;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="notfound">
                <div class="payment">
                    <h2>Choose Payment Option</h2>
                    <a href="onlinepayment.php">Online Payment</a>
                    <a href="offlinepayment.php">Offline Payment</a>
                </div>
                <div class="back">
                    <a href="cart.php">Cart</a>
                </div>
            </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>