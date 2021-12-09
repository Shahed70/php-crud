<?php
include_once "db.php";
$id = $_REQUEST['id'];

$sql = "SELECT * FROM userfile WHERE id='$id' ";

$user = mysqli_query($conn, $sql) or die(mysqli_error($conn));
if ($user) {
    $row = mysqli_fetch_assoc($user);
    $name = $row['name'];
    $file = $row['image'];
    $game = $row['game'];
    $gameArray = explode(",", $game);

    if ($gameArray[0]) {
        $crick = $gameArray[0];
    } else {
        $crick = "";
    }
    if ($gameArray[1]) {
        $foot = $gameArray[1];
    } else {
        $foot = "";
    }
    if ($gameArray[2]) {
        $badm = $gameArray[2];
    } else {
        $badm = "";
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $dir = "upload/";
    $file = $_FILES['image'];
    $check = $_POST['check'];

    $checkBoxValue = "";
    foreach ($check as $x) {
        $checkBoxValue .= $x . ",";
    }

    $target_file = $dir . basename($file['name']);
    $tmp_name = $file['tmp_name'];

    if ($file['size'] > 1) {
        if (file_exists($row['image']) && !empty($row['image'])) {
            unlink($row['image']);
        }
        move_uploaded_file($tmp_name, $target_file);
        $sql = "UPDATE userfile SET name='$name', image='$target_file', game ='$checkBoxValue' WHERE id='$id' ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if ($result) {
            header("location:index.php");
        }
    } else {
        $sql = "UPDATE userfile SET name='$name'  WHERE id='$id' ";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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
    <title>Edit</title>
</head>

<body>


    <div class="col-md-6 my-5">
        <form action="" method="POST" , enctype="multipart/form-data">
            <table>
                <tr>
                    <td>name</td>
                    <td><input type="text" name="name" id="" value="<?php echo $name; ?>"></td>
                    <div>
                        <img src="<?php echo $file; ?>" id="previewImage" alt="">
                    </div>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Choose game</td>
                    <td>

                        <span><input type="checkbox" <?php echo $crick === "cricket" ? "checked" : "";?> name="check[]" id="" value="cricket"> Cricket</span>
                        <span><input type="checkbox" <?php echo $foot === "football" ? "checked" : "";?> name="check[]" id="" value="football">Football</span>
                        <span><input type="checkbox" <?php echo $badm === "badminton" ? "checked" : ""; ?> name="check[]" id="" value="badminton">Badminton
                        </span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="submit" name="update"></td>
                </tr>
            </table>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>