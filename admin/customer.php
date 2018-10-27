<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Customer.php';?>
<?php
if (!isset($_GET['custid']) || $_GET['custid'] == null) {
    echo "<script> window.location='inbox.php';</script>";
} else {
    $custid = $_GET['custid'];
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script> window.location='inbox.php';</script>";
}
?>
<style>
.tblone{width: 550px;margin: 0 auto;}
.tblone tr td{text-align:justify;}
.tblone input[type="text"]{width: 400px; font-size: 17px; padding: 5px;}
.tblone input[type="submit"]{width: 80px; font-size: 15px; padding: 5px;margin-top:10px;}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
               <?php
$cmr = new Customer();
$getcustomer = $cmr->getCustomerData($custid);
if ($getcustomer) {
    while ($result = $getcustomer->fetch_assoc()) {
        ?>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <td width="30%">Name</td>
                        <td width="5%">:</td>
                        <td width="65%"><input type="text" readonly value="<?php echo $result['name']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['address']; ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['city']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['country']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['zip']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['phone']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" readonly value="<?php echo $result['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><input type="submit" name="submit" value="OK"></td>
                    </tr>
                </table>
            </form>
<?php }}?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>