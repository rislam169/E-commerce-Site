<?php include 'inc/header.php'?>
<?php
$cheklogin = Session::get("cmrlogin");
if ($cheklogin == false) {
    header("Location: login.php");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == "order") {
    $cmrId = Session::get('cmrId');
    $insertorder = $ct->orderProduct($cmrId );
    $delcart = $ct->deleteCart();
    header("Location: success.php");
}
?>
<style>
.division{width:50%;margin-bottom: 30px;float:left;}
.tblone{width: 500px;margin: 0 auto;border: 1px solid #ddd;}
.tblone tr td{text-align:justify;}
.tbltwo{border: 1px solid #ddd;float: right;margin-right: 13px;margin-top: 20px;text-align: left;width: 60%;}
.tbltwo tr td{text-align:justify;padding:5px 10px;}
.back {text-align: center;}
.back a{background: #34495e none repeat scroll 0 0;color: #fff;padding: 10px 50px;text-transform: uppercase;border-radius: 5px;}
.back a:hover{background: #7f8c8d none repeat scroll 0 0;}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="division">
                <table class="tblone">
                        <tr>
                            <th width="10%">No</th>
                            <th width="30%">Name</th>
                            <th width="20%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="20%">Total</th>
                        </tr>
    <?php
$getcartproduct = $ct->getCartProduct();
if ($getcartproduct) {
    $i = 0;
    $qty = 0;
    $sum = 0;
    while ($result = $getcartproduct->fetch_assoc()) {
        $i++;
        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['productName']; ?></td>
                            <td>$<?php echo $result['price']; ?></td>
                            <td><?php echo $result['quantity']; ?></td>
                            <td>$
<?php
$total = $result['price'] * $result['quantity'];
        echo $total;
        ?>
                            </td>
                        </tr>
    <?php
$qty = $qty + $result['quantity'];
        $sum = $sum + $total;
        ?>
    <?php }}?>
                    </table>
    <?php
$cartcheck = $ct->cartCheck();
if ($cartcheck) {
    ?>
                    <table class="tbltwo">
                        <tr>
                            <td>Quantity</td>
                            <td>:</td>
                            <td><?php echo $qty; ?></td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>:</td>
                            <td>$ <?php echo $sum; ?></td>
                        </tr>
                        <tr>
                            <td>VAT</td>
                            <td>:</td>
                            <td>10% ($<?php echo $vat = $sum * 0.1; ?>)</td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>$
    <?php
$vat = $sum * 0.1;
    $gtotal = $sum + $vat;
    echo $gtotal;
    ?>
                            </td>
                        </tr>
                    </table>
    <?php } else {header("Location:index.php");}?>
            </div>
			<div class="division">
            <?php
$id = Session::get("cmrId");
$getcustomer = $cmr->getCustomerData($id);
if ($getcustomer) {
    while ($result = $getcustomer->fetch_assoc()) {
        ?>
                <table class="tblone">
                    <tr><td colspan=3><h2>Profile Details</h2></td></tr>
                    <tr>
                        <td width="30%">Name</td>
                        <td width="5%">:</td>
                        <td><?php echo $result['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $result['address'] ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $result['city'] ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $result['country'] ?></td>
                    </tr>
                    <tr>
                        <td>Zip</td>
                        <td>:</td>
                        <td><?php echo $result['zip'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $result['phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $result['email'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="editprofile.php">Update Details</a></td>
                    </tr>
                </table>
<?php }}?>
            </div>
            <div class="back">
                <a href="?orderid=order">Order</a>
            </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'?>