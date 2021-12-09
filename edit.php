<?php
include_once "db.php";
$id = $_REQUEST['id'];
$sql = "SELECT * FROM userinfo WHERE id=$id";
$user = mysqli_query($con, $sql) or die(mysqli_error($con));

if (mysqli_num_rows($user) > 0) {
    $row = mysqli_fetch_assoc($user);
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $image = $row['image'];
}


if (isset($_POST['update'])) {
    $fileDir = 'upload/';
    $target_file = $fileDir . basename($_FILES["image"]["name"]);
    $file = $_FILES['image'];
    $file_name = $file['name'];
    $file_tmp =  $file['tmp_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($_FILES['image']['size'] > 1) {
        if (file_exists($row['image']) && !empty($row['image'])) {
            unlink($row['image']);
        }
        move_uploaded_file($file_tmp, $target_file);
        $sql = "UPDATE userinfo SET username='$username', email= '$email', password='$password', image='$target_file' WHERE id='$id' ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
        if ($result) {
            header("location:index.php");
        }
    } else {
        $sql = "UPDATE userinfo SET username='$username', email= '$email', password='$password' WHERE id='$id' ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        if ($result) {
            header("location:index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>edit</title>
</head>

<body>
    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input class="form-control" type="text" name="username" value="<?php echo $username ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input class="form-control" type="email" name="email" value="<?php echo $email ?>"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input class="form-control" t type="password" name="password" value="<?php echo $password ?>"></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input class="form-control" type="file" id="image" name="image" onchange="previewFile(); "></td>
                        <div>
                            <img id="previewImg" class="img-fluid" style="width: 100%; height: 200px;" src="<?php echo $image ?>" alt="">
                        </div>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="btn btn-success" type="submit" value="submit" name="update">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>