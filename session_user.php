<?php session_start();
if(!isset($_SESSION['userLogin'])){
    header("Location:index.php");
}else{
	$user_id = $_SESSION['user_id'];	
}
?>