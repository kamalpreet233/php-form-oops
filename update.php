<?php
require_once "form.php"; 
if (isset($_POST['firstname']) && $_GET['upd']) {
    $id = $_GET['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $obj = new \form\formdata();
    $obj->update($id,$firstname,$lastname,$email);
}
?>