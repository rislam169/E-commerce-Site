<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../helpers/Format.php';
include_once $filepath . '/../lib/Database.php';
?>
<?php
class Brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertbrand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $msg = "<span class='error'>Brand field must not be empty</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) values('$brandName')";
            $brandinsert = $this->db->insert($query);
            if ($brandinsert) {
                $msg = "<span class='success'>Brand Name Inserted Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Name Not Inserted!!</span>";
                return $msg;
            }
        }
    }

    public function getBrand()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $getbrand = $this->db->insert($query);
        return $getbrand;
    }

    public function getBrandById($brandid)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$brandid'";
        $getbrand = $this->db->insert($query);
        return $getbrand;
    }

    public function updateBrand($brandName, $brandid)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $brandid = mysqli_real_escape_string($this->db->link, $brandid);

        if (empty($brandName)) {
            $msg = "<span class='error'>Brand name field must not be empty!!</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_brand
                        SET brandName = '$brandName'
                        WHERE brandId = '$brandid'";
            $brandupdate = $this->db->update($query);
            if ($brandupdate) {
                $msg = "<span class='success'>Brand Name Updated Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Name Not Updated!!</span>";
                return $msg;
            }
        }
    }

    public function deleteBrandById($delbrandid){
        $query = "DELETE FROM tbl_brand WHERE brandId = '$delbrandid'";
        $delbrand = $this->db->delete($query);
        if ($delbrand) {
            $msg = "<span class='success'>Brand Deleted Successfully!!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand    Not Deleted!!</span>";
            return $msg;
        }
    }
}
