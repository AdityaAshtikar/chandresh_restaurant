
<?php 
    include 'dbcon.php';
    $sql = "UPDATE `restaurant` SET `status` = 'trash' WHERE `id` = '".$_REQUEST['id']."';";
    $query = mysqli_query($con,$sql);
    header("location:admin_restaurant_list.php");
?>    