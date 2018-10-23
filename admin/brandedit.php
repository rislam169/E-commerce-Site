<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>
<?php
if (!isset($_GET['brandid']) || $_GET['brandid'] == null) {
    echo "<script> window.location='brandlist.php';</script>";
} else {
    $brandid = $_GET['brandid'];
}
?>
<?php
$br = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];
    $brandupdate = $br->updateBrand($brandName, $brandid);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock">
<?php
if (isset($brandupdate)) {
    echo $brandupdate;
}
?>
<?php
$getbrand = $br->getBrandById($brandid);
if (isset($getbrand)) {
    $result = $getbrand->fetch_assoc();
    ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
    <?php }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>