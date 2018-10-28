<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../helpers/Format.php';
include_once $filepath . '/../lib/Database.php';
?>
<?php
class Product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertProduct($data, $file)
    {
        $productName = $this->fm->validation($data['productName']);
        $price = $this->fm->validation($data['price']);

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($price) || $type == "") {
            $msg = "<span class='error'>Fields must not be empty!!</span>";
            return $msg;
        } elseif (empty($file_name)) {
            $msg = "<span class='error'>Please Select any Image !</span>";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "<span class='error'>Image Size should be less then 1MB!</span>";
            return $msg;
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, body, image, price, type) values('$productName','$catId','$brandId','$body','$uploaded_image','$price','$type')";
            $productinsert = $this->db->insert($query);
            if ($productinsert) {
                $msg = "<span class='success'>Product Inserted Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Product Not Inserted!!</span>";
                return $msg;
            }
        }

    }

    // Prodcut Update Function

    public function updateProduct($data, $file, $productid)
    {
        $productName = $this->fm->validation($data['productName']);
        $price = $this->fm->validation($data['price']);

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($price) || $type == "") {
            $msg = "<span class='error'>Fields must not be empty!!</span>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1048567) {
                    $msg = "<span class='error'>Image Size should be less then 1MB!</span>";
                    return $msg;
                } elseif (in_array($file_ext, $permited) === false) {
                    $msg = "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
                    return $msg;
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product
                                SET
                                productName = '$productName',
                                catId = '$catId',
                                brandId = '$brandId',
                                body = '$body',
                                image = '$uploaded_image',
                                price = '$price',
                                type = '$type'
                                WHERE productId = '$productid'";
                    $productupdate = $this->db->update($query);
                    if ($productupdate) {
                        $msg = "<span class='success'>Product Updated Successfully!!</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated!!</span>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE tbl_product
                                SET
                                productName = '$productName',
                                catId = '$catId',
                                brandId = '$brandId',
                                body = '$body',
                                price = '$price',
                                type = '$type'
                                WHERE productId = '$productid'";
                $productupdate = $this->db->update($query);
                if ($productupdate) {
                    $msg = "<span class='success'>Product Updated Successfully!!</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Updated!!</span>";
                    return $msg;
                }
            }
        }
    }

    public function getProduct()
    {
        $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product as p, tbl_category as c, tbl_brand as b
                WHERE p.catId = c.catId AND p.brandId = b.brandId
                ORDER BY productId DESC";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProductById($productid)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getProductByCategoryId($catid)
    {
        $query = "SELECT * FROM tbl_product WHERE catId = '$catid'";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function deleteProductById($delproductid)
    {
        $query = "SELECT * FROM tbl_product WHERE productId = '$delproductid'";
        $getproduct = $this->db->select($query);
        if ($getproduct) {
            while ($result = $getproduct->fetch_assoc()) {
                $dellink = $result['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM tbl_product WHERE productId = '$delproductid'";
        $delproduct = $this->db->delete($delquery);
        if ($delproduct) {
            $msg = "<span class='success'>Product Deleted Successfully!!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Deleted!!</span>";
            return $msg;
        }
    }

    public function getFeaturedProduct()
    {
        $query = "SELECT * FROM tbl_product WHERE type = 0 ORDER BY RAND() LIMIT 4";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getNewProduct()
    {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getSingleProductById($proid)
    {
        $query = "SELECT p.*, c.catName, b.brandName
                FROM tbl_product as p, tbl_category as c, tbl_brand as b
                WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$proid'";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function getLatestFromIphone()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = 4 ORDER BY productId DESC LIMIT 1";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getLatestFromSamsung()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = 2 ORDER BY productId DESC LIMIT 1";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getLatestFromCanon()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = 3 ORDER BY productId DESC LIMIT 1";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function getLatestFromAcer()
    {
        $query = "SELECT * FROM tbl_product WHERE brandId = 1 ORDER BY productId DESC LIMIT 1";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function addCompare($cmrId, $productId)
    {
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);

        $cquery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";
        $check = $this->db->select($cquery);
        if ($check) {
            $msg = "<span class='error'>Already Added!!</span>";
            return $msg;
        }

        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $getinfo = $this->db->select($query);
        if ($getinfo) {
            $result = $getinfo->fetch_assoc();
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];
        }

        $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) values('$cmrId', '$productId', '$productName', '$price', '$image')";
        $insertcompare = $this->db->insert($query);
        if ($insertcompare) {
            $msg = "<span class='success'>Added! Check compare page</span>";
            return $msg;
        } else {
            $msg = "<span class='success'>Not Added!!</span>";
            return $msg;
        }
    }

    public function getCompareProduct($cmrId)
    {
        $query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";
        $getproduct = $this->db->select($query);
        return $getproduct;
    }

    public function deleteCompareData($cmrId)
    {
        $sId = session_id();
        $query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
        $deldata = $this->db->delete($query);
    }

    public function addWishList($cmrId, $productId)
    {
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);

        $cquery = "SELECT * FROM tbl_wishlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
        $check = $this->db->select($cquery);
        if ($check) {
            $msg = "<span class='error'>Already Added!!</span>";
            return $msg;
        }

        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $getinfo = $this->db->select($query);
        if ($getinfo) {
            $result = $getinfo->fetch_assoc();
            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];
        }

        $query = "INSERT INTO tbl_wishlist(cmrId, productId, productName, price, image) values('$cmrId', '$productId', '$productName', '$price', '$image')";
        $insertwishlist = $this->db->insert($query);
        if ($insertwishlist) {
            $msg = "<span class='success'>Added! Check WishList Page</span>";
            return $msg;
        } else {
            $msg = "<span class='success'>Not Added!!</span>";
            return $msg;
        }
    }

    public function getWishList($cmrId){
        $query = "SELECT * FROM tbl_wishlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
        $getwishlist = $this->db->select($query);
        return $getwishlist;
    }

    public function removeWishList($cmrId, $delwishid){
        $query = "DELETE FROM tbl_wishlist WHERE productId = '$delwishid' AND cmrId = '$cmrId'";
        $deldata = $this->db->delete($query);
        if($deldata){
            $msg = "<span class='success'>Product deleted from wishlist!</span>";
            return $msg;
        }else{
            return false;
        }
    }

}
