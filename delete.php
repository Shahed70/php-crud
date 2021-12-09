<?php
include_once "db.php";

$id = $_REQUEST['id'];
$img = $_REQUEST['img'];

unlink($img);

$sql = "DELETE FROM userinfo WHERE id = $id";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if ($result) {
    header("location:index.php");
}
