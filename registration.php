<?php session_start(); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {


        //===================================name
        $name = $_POST['name'];
        $name = str_replace(" ", "", $name);

        if (empty($name)) {
            $nameerr = 'Name is Required';
        } elseif (!ctype_alpha($name)) {
            $nameerr = "Invalid name";
            $name = "";
        } else {
            $name = $_POST['name'];
        }

        //==================================GENDER
        if (!isset($_POST['gender'])) {
            $gendererr = "Please Select Gender";
            $gender = '';
        } else {
            $gender = $_POST['gender'];
        }

        //==================================dob
        if (empty($_POST['dob'])) {
            $doberr = "Please Select DOB";
            $dob = '';
        } else {
            $dob = $_POST['dob'];
        }

        //===================================email
        if (empty($_POST['email'])) {
            $emailerr = "Email is Required";
        } else {
            $email = strtolower($_POST['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "Invalid Email";
            }
        }


        //==================================mobile
        if (empty($_POST['mob'])) {
            $moberr = "Please Provide Mobile No.";
        } else {
            $mob = $_POST['mob'];
            $moblen = strlen($mob);
            if ($moblen != 10) {
                $moberr = "Invalid Mobile No.";
                $mob = "";
            } elseif (!ctype_digit($mob)) {
                $moberr = "Invalid Mobile No.";
                $mob = "";
            }
        }

        //==================================Password
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        if (empty($pass)) {
            $passerr = 'Please Enter Password';
            $pass = "";
        } elseif (empty($cpass)) {
            $cpasserr = 'Please Re-Enter Password';
            $pass = "";
        } elseif (strlen($pass) <= 5) {
            $passerr = 'Password Length Should Be 6 or more.';
            $pass = "";
        } else {
            $pass = md5($pass);
        }





        if (!empty($name) && !empty($gender) && !empty($dob) && !empty($email) && !empty($mob) && !empty($pass)) {
            include 'dbcon.php';
		$dateTime = date('Y-m-d h:i:s');
            $sql = "INSERT INTO `user` (`name`, `gender`, `dob`, `email`,`mob`, `pass`,`date`)
                                VALUES ('$name','$gender','$dob','$email','$mob','$pass','$dateTime')";
            if (mysqli_query($con, $sql)) {
                header("Location:login.php");
            }
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
        <section id="base">
            <div class="container">
                <h1 class="title text-center">User Registration</h1>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form" enctype='multipart/form-data'">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="name">Name</label>
                            <input type="text" name="name"  id="name" placeholder="Name">
                            <p class="error"><?= @$nameerr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label for="name">Gender</label><br>
                            <input type="radio" name="gender" value="male" id="male" <?php if (@$gender == 'male') echo "checked" ?>/><label for="male">Male</label>
                            <input type="radio" name="gender" value="female" id="female" <?php if (@$gender == 'female') echo "checked" ?>/><label for="female">Female</label>
                            <p class="error"><?= @$gendererr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label for="dob">dob</label>
                            <input type="date" name="dob" placeholder="" id="dob" class="form-control" />
                            <p class="error"><?= @$doberr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label for="email">Email</label>
                            <input type="email" name="email"  id="email" placeholder="email">
                            <p class="error"><?= @$emailerr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label for="mob">Mobile</label>
                            <input type="text" name="mob"  id="mob" placeholder="Mobile">
                            <p class="error"><?= @$moberr ?></p>
                        </div>


                        <div class="col-md-6 col-md-offset-3">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass" placeholder="*****">
                            <p class="error"><?= @$passerr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <label for="cpass">Re-Enter Password</label>
                            <input type="password" name="cpass" id="cpass" placeholder="*****">
                            <p class="error"><?= @$cpasserr ?></p>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" name="submit" value="Registration" class="pull-right">
                        </div>
                    </div>

                </form>
            </div>
        </section>

<?php include_once'footer.php' ?>	


    </body>
</html>