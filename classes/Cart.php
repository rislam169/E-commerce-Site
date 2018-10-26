<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../helpers/Format.php';
include_once $filepath . '/../lib/Database.php';
?>
<?php
class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $proid)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $proid);
        $sId = session_id();

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $result = $this->db->select($chquery);
        if ($result) {
            $msg = "Product Already Added!";
            return $msg;
        } else {
            $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) values('$sId','$productId','$productName','$price','$quantity','$image')";
            $cartinsert = $this->db->insert($query);
            if ($cartinsert) {
                header("Location: cart.php");
            } else {
                header("Location: 404.php");
            }
        }

    }

    public function getCartProduct()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $getcartproduct = $this->db->insert($query);
        return $getcartproduct;
    }

    public function cartUpdate($cartId, $quantity)
    {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE tbl_cart
                SET
                quantity = '$quantity'
                WHERE cartId = '$cartId'";
        $cartupdate = $this->db->update($query);
        if ($cartupdate) {
            echo "<script>window.location='cart.php';</script>";
        } else {
            $msg = "<span class='error'>Quantity Not Updated!!</span>";
            return $msg;
        }
    }

    public function deleteCartById($delproid)
    {
        $delproid = mysqli_real_escape_string($this->db->link, $delproid);
        $delquery = "DELETE FROM tbl_cart WHERE cartId = '$delproid'";
        $delcart = $this->db->delete($delquery);
        if ($delcart) {
            echo "<script>window.location='cart.php';</script>";
        } else {
            $msg = "<span class='error'>Product Not Deleted From Cart!!</span>";
            return $msg;
        }
    }

    public function cartCheck()
    {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
        $checkcartproduct = $this->db->select($query);
        return $checkcartproduct;
    }

    public function deleteCart()
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $delcart = $this->db->delete($query);
        return $delcart;

    }
}
