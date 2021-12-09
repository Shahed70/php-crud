<?php
include_once "db.php";

if (isset($_POST['submit'])) {

    $fileDir = 'upload/';
    $target_file = $fileDir . basename($_FILES["image"]["name"]);

    $file_tmp = $_FILES['image']['tmp_name'];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($target_file) {
        move_uploaded_file($file_tmp, $target_file);
    }
    $sql = "INSERT INTO userinfo (username, email, password, image) VALUES ('$username', '$email', '$password', '$target_file')";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
}

$sql = "SELECT * FROM userinfo";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

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
    <title>php crud</title>
</head>


<body>

    <div class="container m-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>Profile</td>
                            <td><input type="file" name="image" id="image" onchange="previewFile(); "></td>
                            <div class="image_holder">
                                <img class="img-fluid" id="previewImg" src="" alt="">
                            </div>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input class="form-control" type="text" name="username"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input class="form-control" type="email" name="email"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input class="form-control" type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="btn btn-success" type="submit" value="submit" name="submit">
                                <input class="btn btn-primary" type="reset" value="Reset" name="reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-6 mx-auto">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Emil</td>
                        <th>Password</th>
                        <th>Action</th>

                        <?php
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td> <img class="img-fluid" src="<?php echo $row['image'] ?>" alt=""></td>
                        <td><a class="btn btn-warning" href="edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                        <td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'] ?>&&img=<?php echo $row['image']?>">Delete</a>
                        
                        </td>
                    <?php
                        }
                    ?>
                    </tr>

                    </tr>
                </table>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>