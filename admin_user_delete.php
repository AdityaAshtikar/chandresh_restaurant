
<?php 
    include 'dbcon.php';
    $sql = "UPDATE `user` SET `status` = 'trash' WHERE `id` = '".$_REQUEST['id']."';";
    $query = mysqli_query($con,$sql);
    header("location:admin_user.php");
?>    