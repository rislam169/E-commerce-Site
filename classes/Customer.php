<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../helpers/Format.php';
include_once $filepath . '/../lib/Database.php';
?>
<?php
class Customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegister($data)
    {
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);
        $password = $this->fm->validation($data['password']);
        $password = md5($password);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email) || empty($password)) {
            $msg = "<span class='error'>Fields must not be empty!!</span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
        $mailcheck = $this->db->select($query);
        if (!$mailcheck == false) {
            $msg = "<span class='error'>Email already exist!!</span>";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, password) values('$name','$address','$city','$country','$zip','$phone','$email','$password')";
            $customerregistration = $this->db->insert($query);
            if ($customerregistration) {
                $msg = "<span class='success'>Registered Successfully!!</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Not Registered!!</span>";
                return $msg;
            }
        }
    }

    public function customerLogin($email, $password)
    {
        $email = $this->fm->validation($email);
        $password = $this->fm->validation($password);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);
        if (empty($email) || empty($password)) {
            $msg = "<span class='error'>Fields must not be empty!!</span>";
            return $msg;
        }
        $password = md5($password);
        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
        $result = $this->db->select($query);
        if ($result) {
            $value = $result->fetch_assoc();
            Session::set("cmrlogin", true);
            Session::set("cmrId", $value['id']);
            Session::set("cmrName", $value['name']);
            header("Location: order.php");
        } else {
            $msg = "<span class='error'>Email or Password don't match!!</span>";
            return $msg;
        }

    }

    public function getCustomerData($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function customerUpdateInfo($data, $id)
    {
        $name = $this->fm->validation($data['name']);
        $address = $this->fm->validation($data['address']);
        $city = $this->fm->validation($data['city']);
        $country = $this->fm->validation($data['country']);
        $zip = $this->fm->validation($data['zip']);
        $phone = $this->fm->validation($data['phone']);
        $email = $this->fm->validation($data['email']);

        $name = mysqli_real_escape_string($this->db->link, $name);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $city = mysqli_real_escape_string($this->db->link, $city);
        $country = mysqli_real_escape_string($this->db->link, $country);
        $zip = mysqli_real_escape_string($this->db->link, $zip);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email)) {
            $msg = "<span class='error'>Fields must not be empty!!</span>";
            return $msg;
        }
        $query = "UPDATE tbl_customer
                    SET
                    name = '$name',
                    address = '$address',
                    city = '$city',
                    country = '$country',
                    zip = '$zip',
                    phone = '$phone',
                    email = '$email'
                    WHERE id = '$id'";
        $updateinfo = $this->db->update($query);
        if ($updateinfo) {
            $msg = "<span class='success'>Data Updated Successfully!!</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Data Not Updated!!</span>";
            return $msg;
        }

    }
}
