<?php include 'session_admin.php'; ?>
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
        if(isset($_REQUEST['restaurent_id'])){
            $restaurent_id = $_REQUEST['restaurent_id'];
            $sql = "select * from feedback where restaurant_id = $restaurent_id order by `date` desc"; 
        }else{
            $sql = "select * from feedback order by `date` desc"; 
        }

        $query = mysqli_query($con, $sql);
        $res = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $sn = 1;
        ?>    

        <section id="base">
            <div class="container">
                <h1 class="title">Feedback List</h1>
                <table id="example" class="mytable" border="1">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>feedback</th>
                            <th width="100">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($res as $value) { ?>
                            <tr>
                                <td><?= $sn++ ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['feedback'] ?></td>
                                <td><?= date("d-m-Y", strtotime($value['date'])) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>





        <?php include_once'footer.php' ?>	


    </body>
</html>