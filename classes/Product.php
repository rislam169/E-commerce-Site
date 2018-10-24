<?php
include_once '../helpers/Format.php';
include_once '../lib/Database.php';
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
}
