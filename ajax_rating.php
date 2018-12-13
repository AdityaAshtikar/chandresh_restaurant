<?php
session_start();
include 'dbcon.php';
$data = [
    'response' => true
];

$restaurant_id = $_REQUEST["restaurant_id"];
$user_id = $_SESSION['user_id'];
$star = $_REQUEST["star"];

$sql = "select count(id) count from rating where restaurant_id = $restaurant_id AND user_id = $user_id";
$query = mysqli_query($con, $sql);
$res = mysqli_fetch_assoc($query);



if (!$res['count']) {

    $sql = "INSERT INTO `rating` (`restaurant_id`, `user_id`, `rating`) 
                            VALUES ('$restaurant_id','$user_id','$star');";
    $query = mysqli_query($con, $sql);
    $data['response_type'] = "new";
} else {
    $sql = "UPDATE `rating` SET `rating` = '$star' WHERE `user_id` = $user_id and restaurant_id = $restaurant_id;";
    $query = mysqli_query($con, $sql);
    $data['response_type'] = "update";
}
echo  json_encode($data);
?>