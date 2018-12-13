<?php session_start() ?>
<?php include'dbcon.php'; ?>
<?php
$restaurent_id = $_REQUEST['restaurent'];
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

        //===================================feedback
        $feedback = $_POST['feedback'];
        $feedback = str_replace(" ", "", $feedback);

        if (empty($feedback)) {
            $feedbackerr = 'feedback is Required';
        } else {
            $feedback = $_POST['feedback'];
        }

        if (!empty($name) && !empty($feedback)) {//die;
            $restaurent_id = $_REQUEST['restaurent'];
            $sql = "INSERT INTO `feedback` (`name`,`restaurant_id`, `feedback`, `date`)
                                VALUES ('$name','$restaurent_id','$feedback',now())";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Thank You For Feedback.')</script>";
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

        <style type="text/css">
            .tile{
                width: 100%;
                background: white;
                border: 1px solid black;
                border-radius: 5px;
                margin: 10px auto;
                padding: 20px;
                box-shadow: 3px 3px 10px #000;
            }
            .tile h2{
                padding-bottom: 10px;
                text-transform: capitalize;
                border-bottom: 1px dashed #000;
            }
            img{
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        <?php include_once'header.php' ?>



        <section>
            <div class="container">
                <?php
                $restaurant_id = $_REQUEST['restaurent'];
                $sql = "select * from restaurant where status = 'on' and id =  $restaurant_id order by id desc";
                $query = mysqli_query($con, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($res = mysqli_fetch_assoc($query)) {
//                echo "<pre>";
//                print_r($res);
//                die;
                        ?>
                        <div class="tile">
                            <h2><?= $res['restaurant_name'] ?></h2>
                            <div class="text-center" style="margin-top: 20px;margin-bottom: 20px;">
                                <img src="images/restaurant/<?= $res['img_path'] ?>" class="img-thumbnail" width="500" alt="" />
                            </div>
                            <p class="tile"><?= $res['description'] ?></p>
                            <p>Address : <?= $res['address'] ?>, <?= $res['city'] ?>, <?= $res['pincode'] ?></p>
                            <p>Working Time : <?= $res['opening_hr'] ?> - <?= $res['closing_hr'] ?></p>
                            <div class="clearfix"></div>
                            <hr />
                        </div>


                        <?php
                    }
                }
                ?>
            </div>
            <div class="container">
                <div class="tile">
                    <h2>User Feedback</h2>
                    <br />
                    <?php //print_r($_SESSION)?>
                    <form action="<?= $_SERVER['PHP_SELF'] . "?restaurent=" . $_REQUEST['restaurent'] ?>" method="post">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" />
                        <span class="error"><?= @$nameerr ?></span><br>
                        <label for="name">Feedback</label>
                        <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="3"></textarea>
                        <span class="error"><?= @$feedbackerr ?></span><br>

                        <span class="pull-right">
                            <input type="submit" value="Send" class="btn btn-success" name="submit" />
                        </span>
                        <div class="clearfix"></div>
                    </form>

                    <div class="containera">

                        <?php
                        $sql = "select * from feedback where restaurant_id = '$restaurent_id' order by feed_id desc";
                        $query = mysqli_query($con, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($res = mysqli_fetch_assoc($query)) {
//                echo "<pre>";
//                print_r($res);
//                die;
                                ?>
                                <div class="tile">
                                    <h2><?= $res['name'] ?>

                                        <span class="pull-right">
                                            <small><?=date("d-m-Y",strtotime($res['date']))?></small>
                                        </span>
                                    </h2>
                                    <p><?= $res['feedback'] ?></p>

                                    <div class="clearfix"></div>

                                </div>


                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>


        <?php include_once'footer.php' ?>	


    </body>
</html>
