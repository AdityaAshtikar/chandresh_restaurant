<?php session_start();
if(!isset($_SESSION['adminLogin'])){
    header("Location:index.php");
}
?>