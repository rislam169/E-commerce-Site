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
}
