<?php include 'inc/header.php'?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<form action="hello" method="get" id="member">
				<input name="Domain" type="text" value="Username" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
				<input name="Domain" type="password" value="Password" class="field" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
			</form>
			<p class="note">Forgot your passoword click <a href="#">here</a></p>
			<div class="buttons">
				<div><button class="grey">Sign In</button></div>
			</div>
		</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $customerregister = $cmr->customerRegister($_POST);
}
?>
		<div class="register_account">
			<h3>Register New Account</h3>
<?php
if (isset($customerregister)) {
    echo $customerregister;
}
?>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<input type="text" name="name" placeholder="Name">
								<input type="text" name="city" placeholder="City">
								<input type="text" name="zip" placeholder="Zip-Code">
								<input type="text" name="email" placeholder="Email">
							</td>
							<td>
								<input type="text" name="address" placeholder="Address">
								<input type="text" name="country" placeholder="Country">
								<input type="text" name="phone" placeholder="Phone">
								<input type="password" name="password" placeholder="Password">
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button class="grey" name="register" >Create Account</button></div>
				</div>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php'?>