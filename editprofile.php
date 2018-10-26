<?php include 'inc/header.php'?>
<?php
$cheklogin = Session::get("cmrlogin");
if ($cheklogin == false) {
    header("Location: login.php");
}
$id = Session::get("cmrId");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $customerupdate = $cmr->customerUpdateInfo($_POST, $id);
}
?>
<style>
.tblone{width: 550px;margin: 0 auto;border: 1px solid #ddd;border-radius:50px;}
.tblone tr td{text-align:justify;}
.tblone input[type="text"]{width: 400px; font-size: 15px; padding: 3px;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
<?php
$getcustomer = $cmr->getCustomerData($id);
if ($getcustomer) {
    while ($result = $getcustomer->fetch_assoc()) {
        ?>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <td colspan=3><h2>Update Profile Details</h2>
<?php
if (isset($customerupdate)) {
            echo $customerupdate;
        }
        ?>              </td>
                    </tr>
                    <tr>
                        <td width="30%">Name</td>
                        <td width="5%">:</td>
                        <td><input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?php echo $result['address']; ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><input type="text" name="country" value="<?php echo $result['country']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip</td>
                        <td>:</td>
                        <td><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="email" value="<?php echo $result['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" name="submit" value="Update"></td>
                    </tr>
                </table>
            </form>
<?php }}?>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>