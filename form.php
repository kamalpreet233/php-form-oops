<?php

namespace form;

use ErrorException;
use Exception;
use mysqli_sql_exception;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class formdata
{
    public $firstname, $lastname, $email, $conn;
    function __construct()
    {
        try {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "form";


            $this->conn = new \mysqli($servername, $username, $password, $dbname);


            if ($this->conn->connect_error) {
                die("Connection failed: " .  $this->conn->connect_error);
            }
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }

    public function insert($fname, $lname, $email)
    {
        try {
            $insert = "INSERT INTO emptab(firstname,lastname,email) VALUES ('$fname','$lname','$email');";
            $selquery = "select * from emptab where email= '$email';";
            $res = $this->conn->query($selquery);
            if (!empty($fname) && !empty($lname) && preg_match("/^[a-zA-Z ]*$/", $fname) && preg_match("/^[a-zA-Z ]*$/", $lname)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    if ($res->num_rows >= 1) {
                        echo "email already exists";
                        exit;
                    } else {

                        if ($this->conn->query($insert)) {
                            echo "insertion success";

                        } else {
                            echo "data does not inserted" . $this->conn->error;
                        }
                    }
                } else {
                    echo "please enter a valid email";
                }
            } else {
                echo "enter valid name";
            }
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }
    public function fetchdata()
    {
        try {

            $selquery = "select * from emptab;";
            $res = $this->conn->query($selquery);
            return $res;
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }
    public function fetchdatasingle($id)
    {

        try {
            $selquery = "select * from emptab where id=$id;";
            $res = $this->conn->query($selquery);
            return $res;
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }
    public function dlt($id)
    {
        try {
            $dlt = "delete from emptab where id = $id;";
            if ($this->conn->query($dlt)) {
                header("location:view.php");
            } else {
                echo "not deleted";
            }
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }
    public function update($id, $fname, $lname, $email)
    {
        try {
            $update = "UPDATE emptab SET firstname='$fname',lastname='$lname',email='$email' WHERE id=$id;";

            $check = $this->conn->query("select email from emptab where id= '$id';");
            $row = mysqli_fetch_array($check);
            $existing_email = $row['email'];
            if (!empty($fname) && !empty($lname) && preg_match("/^[a-zA-Z ]*$/", $fname) && preg_match("/^[a-zA-Z ]*$/", $lname)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($email != $existing_email) {
                        $res = $this->conn->query("select * from emptab where email = '$email';");
                        if ($res->num_rows >= 1) {
                            echo "email already exists";
                            exit;
                        }
                    }
                    if ($this->conn->query($update)) {
                        echo "updated successfully";
                    } else {
                        echo "data not updated" . $this->conn->error;
                    }
                } else {
                    echo "please enter a valid email";
                }
            } else {
                echo "enter valid name";
            }
        } catch (mysqli_sql_exception $e) {
            die("error:" . $e->getMessage());
        }
    }
}
// formdata::submitdata();
$obj = new \form\formdata();
try {
    if (isset($_GET['req']) && $_GET['req'] === 'insert') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $obj->insert($firstname, $lastname, $email);
    } else if (isset($_GET['req']) && $_GET['req'] === 'update') {
        $firstname = $_POST['firstname'];
        $id = $_GET['id'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $obj->update($id, $firstname, $lastname, $email);
    }
} catch (mysqli_sql_exception $e) {
    die("error:" . $e->getMessage());
}
