<?php
session_start();
if (isset($_SESSION['userLogin'])) {
    header('Location:user_panel.php');
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $pass = md5($_POST['pass']);
        include'dbcon.php';
        $sql = "select * from user where email = '$uname' and pass = '$pass'";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) == 1) {
            $res = mysqli_fetch_assoc($query);
            $_SESSION['userLogin'] = 'userLogin';
            $_SESSION['user_id'] = $res['id'];
            $_SESSION['user_name'] = $res['name'];
            header('Location:user_panel.php');
        } else {
            echo "<script>alert('Invalid Email and Password');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Restaurant</title>
<?php include_once'header_files.php' ?>
    </head>
    <body>
<?php include_once'header.php' ?>
        <section id="login">
            <div class="container">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <h1 class="title text-center">User Login</h1>
                            <label for="uname">Email</label>
                            <input type="text" name="uname" id="uname" placeholder="Username">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass" placeholder="*****">

                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <a href="registration.php" style="margin-top:20px !important;">Registration</a>
                            <input type="submit" name="submit" value="Login" class="pull-right">
                        </div>

                    </div>

                </form>
            </div>
        </section>

<?php include_once'footer.php' ?>	


    </body>
</html>