<?php
include_once "db.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $directory = "upload/";
    $file = $_FILES['image'];
    $target_file = $directory . basename($file['name']);
    $tmp_name = $file['tmp_name'];
    $check = $_POST['check'];
    $checkBoxValue = "";
    foreach($check as $x){
    $checkBoxValue .= $x.",";
    }

    if ($file) {
        move_uploaded_file($tmp_name, $target_file);
        $sql = "INSERT INTO userfile (name, image, 	game) VALUES ('$name', '$target_file', '$checkBoxValue ')";

        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }
}


if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}


$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page; 

$total_pages_sql = "SELECT COUNT(id) FROM userfile";
$result = mysqli_query($conn,$total_pages_sql);

$total_row = mysqli_fetch_array($result)[0];

$total_pages = ($total_row/$no_of_records_per_page);

$sql = "SELECT * FROM userfile LIMIT $offset, $no_of_records_per_page"; 
$user = mysqli_query($conn, $sql) or die(mysqli_error($conn));




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
    <title>File upload</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 my-5">
                <form action="" method="POST" , enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>name</td>
                            <td><input class="form-control" type="text" name="name" id=""></td>
                            <div>
                                <img src="" id="previewImage" alt="">
                            </div>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td><input class="form-control my-4" type="file" name="image" id="image"></td>
                        </tr>
                        <tr>
                            <td>Choose game</td>
                            <td>

                                <span><input class="" type="checkbox" name="check[]" id="" value="cricket"> Cricket</span>
                                <span><input class="" type="checkbox" name="check[]" id="" value="football">Football</span>
                                <span><input class="" type="checkbox" name="check[]" id="" value="badminton">Badminton</span>
                            </td>
                        </tr>
                        <tr class=" ">
                            <td></td>
                            <td><input class="btn btn-primary mt-3" type="submit" value="submit" name="submit">
                                <input class="btn btn-secondary mt-3" type="reset" value="Reset" name="reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Game</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if ($user) {
                            while ($row = mysqli_fetch_assoc($user)) { ?>

                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td> <img class="img-fluid" style="width: 100px; height:auto" src="<?php echo $row['image'] ?>" alt=""> </td>
                                    <td><?php echo $row['game'] ?></td>
                                    <td><a class="btn btn-warning" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                                    <td><a class="btn btn-danger" href="delete.php?id=<?= $row['id'] ?>&&img=<?php echo $row['image'] ?>">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        ?>


                    </tbody>

                </table>

                <ul class="pagination">
                        <li><a href="?pageno=1">First</a></li>
                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                        </li>
                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                        </li>
                        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                </ul>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</body>

</html>