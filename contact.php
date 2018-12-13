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

        //===================================email
        if (empty($_POST['email'])) {
            $emailerr = "Email is Required";
        } else {
            $email = strtolower($_POST['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "Invalid Email";
            }
        }

        //===================================subject
        $subject = $_POST['subject'];
        $subject = str_replace(" ", "", $subject);

        if (empty($subject)) {
            $subjecterr = 'subject is Required';
        } else {
            $subject = $_POST['subject'];
        }

        //===================================message
        $message = $_POST['message'];
        $message = str_replace(" ", "", $message);

        if (empty($message)) {
            $messageerr = '$message is Required';
        } else {
            $messageerr = $_POST['message'];
        }





        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            include 'dbcon.php';
            $sql = "INSERT INTO `contact` (`name`, `email`,`subject`, `message`, `date`)
                                VALUES ('$name','$email','$subject','$message', now())";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Thank You For Contacting.')</script>";
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
            <h1 class="title text-center">Contact</h1>
            <!-- contact -->
            <div class="contact-agile">
                <div class="faq">
                    <div class="container">
                        <div class="col-md-3 location-agileinfo">
                            <div class="icon-w3">
                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                            </div>
                            <h3>Address</h3>
                            <h4>Changora bhata</h4>
                            <h4>Raipur ( C. G. )</h4>
                        </div>
                        <div class="col-md-3 call-agileits">
                            <div class="icon-w3">
                                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                            </div>
                            <h3>Call</h3>
                            <h4>8982513104</h4>
                            <h4>7000703506</h4>
                        
                        </div>
                        <div class="col-md-3 mail-wthree">
                            <div class="icon-w3">
                                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            </div>
                            <h3>Email</h3>
                            <h4><a href="mailto:info@example.com">chandresh1497@mail.com</a></h4>
                            <h4><a href="mailto:info@example.com">Amansahu@mail.com</a></h4>
                        
                        </div>
			<!--
                        <div class="col-md-3 social-w3l">
                            <div class="icon-w3">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            </div>    
			<h3>Social media</h3>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span class="text">Facebook</span></a></li>
                                <li class="twt"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span class="text">Twitter</span></a></li>
                                <li class="ggp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span class="text">Google+</span></a></li>	
                            </ul>
                        </div>
			-->
                        <div class="clearfix"></div>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="text" name="name" placeholder="NAME" required>
                            <input type="email" name="email" placeholder="EMAIL" required>
                            <input type="text" name="subject" placeholder="SUBJECT" required>
                            <textarea  name="message" placeholder="YOUR MESSAGE" required></textarea>
                            <input type="submit" name="submit" value="SEND MESSAGE">
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-w3-agileits">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3510.089338451619!2d81.6753989339029!3d21.239388351791405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x26fe3462deea6281!2sHP+PETROL+PUMP+-+MINOCHA+AND+COMPANY!5e0!3m2!1sen!2sin!4v1539715790728" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <!-- //contact -->
        </section>

        <?php include_once'footer.php' ?>	


    </body>
</html> 