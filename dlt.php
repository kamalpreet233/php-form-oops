<?php
require 'form.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $obj->dlt($id); 
}
?>
