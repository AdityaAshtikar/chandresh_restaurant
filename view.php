<?php session_start() ?>
<?php include'dbcon.php'; ?>
<?php
//print_r($_SESSION);
$restaurent_id = $_REQUEST['restaurent'];
// booking system
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $booking_date = date("Y-m-d", strtotime($_POST['date']));
//     $nop = $_POST['nop'];
//     $restaurent_id = $_REQUEST['restaurent'];
//     $user_id = $_SESSION['user_id'];

//     if (isset($_SESSION['userLogin'])) {

//         $sql = "INSERT INTO `booking` (`restaurant_id`, `user_id`, `nop`, `date`)
//                 VALUES ('{$restaurent_id}','{$user_id}','{$nop}','{$booking_date}');";
//         if (mysqli_query($con, $sql)) {
//             echo "<script>alert('Restaurent Booked.')</script>";
//         }
//     }
// }

    // feedback system
    if (isset($_POST['feedback'])) {
        $f_text = $_POST['feedback'];
        $restaurent_id = $_GET['restaurent'];
        $user_id = $_SESSION['user_id'];
        $date = date("Y-m-d h:i:s");
        $q = "INSERT INTO feedback (restaurant_id, user_id, feedback, date) VALUES ($restaurent_id, $user_id, '$f_text', '$date')";
        if (mysqli_query($con, $q)) {
            echo "<script>alert('Feedback sent!')</script>";
        } else {
            echo "<script>alert('Feedback not sent!')</script>";
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
                //$sql = "select * from restaurant where status = 'on' and id =  $restaurant_id order by id desc";



                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $sql = "select res.*,r.rating, round(sum(r2.rating) / count(r2.restaurant_id),1) as total_rating from restaurant as res
                    left join rating r on r.restaurant_id =  res.id and r.user_id = $user_id
                    left join rating r2 on r2.restaurant_id =  res.id
                    left join user u on u.id =  r.user_id 
                    where res.status = 'on' and res.id =  $restaurant_id 
                    group by res.id 
                    order by res.id desc ";
                } else {
                    $sql = "select res.*,null as rating, round(sum(r.rating) / count(r.restaurant_id),1) as total_rating from restaurant as res
                    left join rating r on r.restaurant_id =  res.id
                    where res.status = 'on' and res.id =  $restaurant_id 
                    group by res.id 
                    order by res.id desc ";
                }





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
                            <div style="margin: 0 auto;">
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isset($_SESSION['userLogin'])) { ?>
                                    <!-- <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Book Now</a> -->
                                <?php } else { ?>
                                    <!-- <a href="login.php"  class="btn btn-warning" >Login Then Book</a> -->
                                <?php } ?>
                                <?php
                                $restaurant_id = $res['id'];
                                $rating = $res['rating'];
                                $total_rating = $res['total_rating'];
                                include("rating.php")
                                ?>
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
                    <?php //print_r($_SESSION) ?>
                    <?php if (isset($_SESSION['userLogin'])) { ?>
                        <form action="<?= $_SERVER['PHP_SELF'] . "?restaurent=" . $_REQUEST['restaurent'] ?>" method="post">
                            <label class="text-capitalize title"><?= $_SESSION['user_name'] ?></label><br>
    <!--                        <input type="text" name="name" id="name" />
                            <span class="error"><?= @$nameerr ?></span><br>-->
                            <label for="name">Feedback</label>
                            <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="3"></textarea>
                            <span class="error"><?= @$feedbackerr ?></span><br>

                            <span class="pull-right">
                                <input type="submit" value="Send" class="btn btn-success" name="submit" />
                            </span>
                            <div class="clearfix"></div>
                        </form>
                    <?php } else { ?>
                        <a href="login.php">Login</a> / <a href="login.php">Registration</a> required for feedback
                    <?php } ?>

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
                                    <h2>
                                        <?php 
                                            $uID = $res['user_id'];
                                            $u_query = mysqli_query($con, "SELECT name FROM user WHERE id=$uID");
                                            $u_row = mysqli_fetch_array($u_query);
                                            $uName = $u_row['name'];
                                            echo "$uName";
                                        ?>
                                        <span class="pull-right">
                                            <small><?= date("d-m-Y", strtotime($res['date'])) ?></small>
                                        </span>
                                    </h2>
                                    <p><?= nl2br($res['feedback']) ?></p>

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


        <?php include_once 'footer.php' ?>	


    </body>
</html>




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Book Hotel</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="<?= $_SERVER['PHP_SELF'] . "?restaurent=" . $_REQUEST['restaurent'] ?>" method="post" >
                        <div class="row">
                            <label for="">Date</label><br>
                            <input type="date" name="date" class="form-control" required/>
                            <br>
                            <label for="">No Of People</label><br>
                            <select name="nop" id="" class="form-control" required>
                                <option value="">--select--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="row pull-right">
                            <input type="submit" value="Book Now" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>