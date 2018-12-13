<?php include_once'session_user.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {

        //==================================img
        if (empty($_FILES['img']['name'])) {
            $img_name = '';
            $imgerr = "please Select Resume.";
        } else {
            $img_name = $_FILES['img']['name'];
            $img_temp = $_FILES['img']['tmp_name'];

            $ext = strtolower(@end(explode(".", $img_name)));
            $valid_ext = array('doc', 'docx', 'pdf');
            if (in_array($ext, $valid_ext)) {
                $img_name = time() . "." . $ext;
                move_uploaded_file($img_temp, 'resume/' . $img_name);
            } else {
                echo "<script>alert('Invalid Image Formate. only [doc][docx][pdf]');</script>";
            }
        }




        if (!empty($img_name)) {
            include 'dbcon.php';
            $sql = "UPDATE `user` SET `doc` = '$img_name' WHERE `id` = '$user_id';";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Resume Uploaded.')</script>";
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

        <?php
        include 'dbcon.php';
        $sql = "select * from user where id = '$user_id' and status = 'on';";
        $query = mysqli_query($con, $sql);
        $value = mysqli_fetch_assoc($query);
        $sn = 1;
        ?>    

        <section id="base">
            <div class="container">
                <h1 class="title">User Profile</h1>
                <table class="my table" border="1">

                    <tr>
                        <th>Name</th>
                        <td><?= $value['name'] ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $value['email'] ?></td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td><?= $value['mob'] ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $value['gender'] ?></td>
                    </tr>
                    <tr>
                        <th>DOB</th>
                        <td><?= date("d-m-Y",strtotime($value['dob'])) ?></td>
                    </tr>
                    <tr>
                        <th>Reg. Date</th>
                        <td><?= /*date("d-m-Y",$value['date'])*/ $value['date'] ?></td>
                    </tr>
                        <!-- </tr>
                            <th>Status</th>
                            <td> <a href="user_delete.php?id=<?= $value['id'] ?>">delete</a> </td>
                        </tr> -->

                </table>
            </div>
        </section>



        <?php include_once'footer.php' ?>	


    </body>
</html>