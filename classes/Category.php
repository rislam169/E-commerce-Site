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
}
