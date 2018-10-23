<?php
include_once '../helpers/Format.php';
include_once '../lib/Database.php';

?>
<?php
class Category
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertCategory($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName) values('$catName')";
            $catinsert = $this->db->insert($query);
            if ($catinsert) {
                $msg = "<span class='success'>Category Inserted Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Inserted!!</span>";
                return $msg;
            }
        }
    }

    public function getCategory()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $getcat = $this->db->insert($query);
        return $getcat;
    }

    public function getCategoryById($catid)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$catid'";
        $getcat = $this->db->insert($query);
        return $getcat;
    }

    public function updateCategory($catName, $catid)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catid = mysqli_real_escape_string($this->db->link, $catid);

        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty</span>";
            return $msg;
        } else {
            $query = "UPDATE tbl_category
                        SET catName = '$catName'
                        WHERE catId = '$catid'";
            $catupdate = $this->db->update($query);
            if ($catupdate) {
                $msg = "<span class='success'>Category Updated Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Updated!!</span>";
                return $msg;
            }
        }
    }

    public function deleteCategoryById($delcatid)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$delcatid'";
        $delcat = $this->db->delete($query);
        if ($delcat) {
            $msg = "<span class='success'>Category Deleted Successfully!!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category Not Deleted!!</span>";
            return $msg;
        }
    }
}
