<?php include 'session_admin.php'; ?>
<?php
include'dbcon.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['restaurant_upload_submit'])) {

//        $restaurant_name = $_POST['restaurant_name'];
//        $city = $_POST['city'];
//        $address = $_POST['address'];
//        $pincode = $_POST['pincode'];
//        $description = $_POST['description'];
//        $opening_hr = $_POST['opening_hr'];
//        $closing_hr = $_POST['closing_hr'];
        $restaurant_name = "";
        $city = "";
        $address = "";
        $pincode = "";
        $description = "";
        $opening_hr = "";
        $closing_hr = "";

        //===================================restaurant_name
        $restaurant_name = $_POST['restaurant_name'];
        $restaurant_name = str_replace(" ", "", $restaurant_name);

        if (empty($restaurant_name)) {
            $restaurant_nameerr = 'Restaurant Name is Required';
        } else {
            $restaurant_name = $_POST['restaurant_name'];
        }

        //===================================city
        $city = $_POST['city'];
        $city = str_replace(" ", "", $city);

        if (empty($city)) {
            $cityerr = 'City is Required';
        } else {
            $city = $_POST['city'];
        }

        //===================================address
        $address = $_POST['address'];
        $address = str_replace(" ", "", $address);

        if (empty($address)) {
            $addresserr = 'Address is Required';
        } else {
            $address = $_POST['address'];
        }

        //===================================pincode
        $pincode = $_POST['pincode'];
        $pincode = str_replace(" ", "", $pincode);

        if (empty($pincode)) {
            $pincodeerr = 'Pincode is Required';
        } else {
            $pincode = $_POST['pincode'];
        }

        //===================================description
        $description = $_POST['description'];
        $description = str_replace(" ", "", $description);

        if (empty($description)) {
            $descriptionerr = 'Description is Required';
        } else {
            $description = $_POST['description'];
        }

        //===================================opening_hr
        $opening_hr = $_POST['opening_hr'];
        $opening_hr = str_replace(" ", "", $opening_hr);

        if (empty($opening_hr)) {
            $opening_hrerr = 'Opening Hr is Required';
        } else {
            $opening_hr = $_POST['opening_hr'];
        }


        //===================================closing_hr
        $closing_hr = $_POST['closing_hr'];

        if (empty($closing_hr)) {
            $closing_hrerr = 'Closing Hr is Required';
        } else {
            $closing_hr = $_POST['closing_hr'];
        }

        //==================================img
        if (empty($_FILES['img']['name'])) {
            $img_name = '';
            $imgerr = "Restaurant Image is required.";
        } else {
            $img_name = $_FILES['img']['name'];
            $img_temp = $_FILES['img']['tmp_name'];

            $ext = strtolower(@end(explode(".", $img_name)));
            $valid_ext = array('jpeg', 'jpg', 'png');
            if (in_array($ext, $valid_ext)) {
                $img_name = time() . "." . $ext;
                move_uploaded_file($img_temp, 'images/restaurant/' . $img_name);
            } else {
                echo "<script>alert('Invalid Image Formate. only [jpeg][jpg][png] allowed');</script>";
            }
        }



        if (!empty($restaurant_name) && !empty($img_name) && !empty($city) && !empty($address) && !empty($pincode) && !empty($description) && !empty($opening_hr) && !empty($closing_hr)) {

            $sql = "insert into restaurant (`restaurant_name`,`city`,`address`,`pincode`,`description`,`opening_hr`,`closing_hr`,`img_path`,`reg_date`)
							values('$restaurant_name','$city','$address','$pincode','$description','$opening_hr','$closing_hr','$img_name',now())";
            if (mysqli_query($con, $sql)) {
                header("Location:admin_restaurant_list.php");
                //echo '<script type="text/javascript">alert("Restaurant successfully Saved")</script>';
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
            label{
                padding-top: 5px;
            }
        </style>
    </head>
    <body>
        <?php include_once'header.php'; ?>

        <div class="container">
            <h2 class="title text-center">Restaurant Registration</h2>	
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Restaurant ">Restaurant Name<span class="error"> * </span></label>	
                        <input id="Restaurant " type="text" name="restaurant_name" value="<?= @$restaurant_name ?>" class="form-control" />
                        <span class="error"><?= @$restaurant_nameerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="City">City<span class="error"> * </span></label>	
                        <input id="City" type="text" name="city" value="<?= @$city ?>" class="form-control" />
                        <span class="error"><?= @$cityerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Address">Address<span class="error"> * </span></label>	
                        <input id="Address" type="text" name="address" value="<?= @$address ?>" class="form-control" />
                        <span class="error"><?= @$addresserr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Pincode">Pincode<span class="error"> * </span></label>	
                        <input id="Pincode" type="text" name="pincode" value="<?= @$pincode ?>" class="form-control" />
                        <span class="error"><?= @$pincodeerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Description">Description<span class="error"> * </span></label>
                        <textarea id="Description" name="description" class="form-control" rows="3"><?= @$description ?></textarea>
                        <span class="error"><?= @$descriptionerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="img">Image<span class="error"> * </span></label>
                        <input type="file" name="img" id="img" />
                        <span class="error"><?= @$imgerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Opening">Opening Hr<span class="error"> * </span></label>	
                        <!--<input id="Opening" type="text" name="opening_hr" value="<?= @$opening_hr ?>" class="form-control" />-->

                        <select name="opening_hr" id="Opening" class="form-control">
                            <option value=""> -- Opening Hr -- </option>
                            <?php for ($am = 1; $am <= 12; $am++) { ?>
                                <option value="<?= $am ?> AM"  <?= (@$opening_hr == $am . " AM") ? "selected" : "" ?> > <?= $am ?> AM </option>
                            <?php } ?>
                            <?php for ($pm = 1; $pm <= 12; $pm++) { ?>
                                <option value="<?= $pm ?> PM"  <?= (@$opening_hr == $pm . " PM") ? "selected" : "" ?> > <?= $pm ?> PM </option>
                            <?php } ?>
                        </select>


                        <span class="error"><?= @$opening_hrerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label for="Closing">Closing Hr<span class="error"> * </span></label>	
                        <!--<input id="Closing" type="text" name="closing_hr" value="<?= @$closing_hr ?>" class="form-control" />-->


                        <select name="closing_hr" id="Opening" class="form-control">
                            <option value=""> -- Closing Hr -- </option>
                            <?php for ($am = 1; $am <= 12; $am++) { ?>
                                <option value="<?= $am ?> AM"  <?= (@$closing_hr == $am . " AM") ? "selected" : "" ?> > <?= $am ?> AM </option>
                            <?php } ?>
                            <?php for ($pm = 1; $pm <= 12; $pm++) { ?>
                                <option value="<?= $pm ?> PM"  <?= (@$closing_hr == $pm . " PM") ? "selected" : "" ?> > <?= $pm ?> PM </option>
                            <?php } ?>
                        </select>



                        <span class="error"><?= @$closing_hrerr ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <input type="submit" value="Save" name="restaurant_upload_submit" class="btn btn-default pull-right" />
                    </div>
                </div>  
            </form>
        </div>




        <?php include_once'footer.php' ?>
    </body>
</html>