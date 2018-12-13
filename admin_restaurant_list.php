<?php include 'session_admin.php'; ?>
<?php
include'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Restaurant</title>
        <?php include_once'header_files.php' ?>
    </head>
    <body>
        <?php include_once'header.php' ?>


        <div class="container">
            <h2 class="title text-center">Restaurant List</h2>	
            <table id="example" class="mytable" border="1">
                <thead>
                    <tr style="background:#09F;color:#FFF">
                        <th>SN</th>
                        <th>Restaurant Name</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Pincode</th>
                        <th>Description</th>
                        <th>Opening Hr</th>
                        <th>Closing Hr</th>
                        <th>View Feedback</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sn = 1;
                    $sql = "select * from restaurant where status = 'on'";
                    $query = mysqli_query($con, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?= $sn++ ?></td>
                                <td><?php echo $res['restaurant_name'] ?></td>
                                <td><?php echo $res['city'] ?></td>
                                <td><?php echo $res['address'] ?></td>
                                <td><?php echo $res['pincode'] ?></td>
                                <td><?php echo $res['description'] ?></td>
                                <td><?php echo $res['opening_hr'] ?></td>
                                <td><?php echo $res['closing_hr'] ?></td>
                                <td><a href="admin_feedback.php?restaurent_id=<?php echo $res['id'] ?>">Feedback</a></td>
                                <td>
                                    <a onclick="return confirm('Are you sure to delete this restaurant ?')" href="admin_restaurant_delete.php?id=<?php echo $res['id'] ?>" >Delete</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>




        <?php include_once'footer.php' ?>	


    </body>
</html>






