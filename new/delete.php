<?php
    include_once "db.php";
    print_r($_REQUEST);
    $id = $_REQUEST['id'];
    $img = $_REQUEST['img'];

    $sql = "DELETE FROM userfile WHERE id ='$id' ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if(file_exists($img)){
        unlink($img);
    }
    if($result){
        header("location:index.php");
    }

?>