<?php include 'inc/header.php'?>
<?php
	$cheklogin = Session::get("cmrlogin");
	if($cheklogin == false){
		header("Location: login.php");
	}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="notfound">
                <h2>Order Page</h2>
            </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>