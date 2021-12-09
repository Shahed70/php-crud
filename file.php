
<?php
        if(isset($_POST)){
           $file =  $_FILES['myfile']['name'];
           echo $file;
        }


?>





<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="myfile" id="">
    <input type="submit" value="Submit" name="submit">
</form>