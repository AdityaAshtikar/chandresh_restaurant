<?php 
session_start();
if(isset($_SESSION['adminLogin'])){
	header('Location:admin_feedback.php');	
}	

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['submit'])){
            $uname = $_POST['uname'];
            $pass = md5($_POST['pass']);
            include'dbcon.php';
            $sql = "select * from admin where username = '$uname' and pass = '$pass'";
            $query = mysqli_query($con,$sql);
            if(mysqli_num_rows($query) == 1){
                $_SESSION['adminLogin'] = 'adminLogin';				
                header('Location:admin_feedback.php');
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Restaurant</title>
<?php include_once'header_files.php'?>
</head>
<body>
<?php include_once'header.php'?>
<section id="login">
	<div class="container">
    	<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4">
                	<h1 class="title text-center">Admin Login</h1>
                	<label for="uname">Username</label>
                	<input type="text" name="uname" id="uname" placeholder="Username">
                	<label for="pass">Password</label>
                	<input type="password" name="pass" id="pass" placeholder="*****">
                    <input type="submit" name="submit" value="Login" class="pull-right">
                </div>
            </div>
        
        </form>
    </div>
</section>

<?php include_once'footer.php'?>	


</body>
</html>