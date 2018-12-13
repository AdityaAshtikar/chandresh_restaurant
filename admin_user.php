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
        $sql = "select * from user where status = 'on';";
        $query = mysqli_query($con, $sql);
        $res = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $sn = 1;
        ?>    

        <section id="basea">
            <div class="container">
                <h2 class="title text-center">User List</h2>
                <table id="example" class="mytable" border="1">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Reg. Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($res as $value) { ?>
                            <tr>
                                <td><?= $sn++ ?></td>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td><?= $value['mob'] ?></td>
                                <td><?= $value['gender'] ?></td>
                                <td><?= date("d-m-Y", strtotime($value['dob'])) ?></td>
                                <td><?= date("d-m-Y", $value['date']) ?></td>
                                <td> <a onclick="return confirm('Are you sure to delete this user ?')" href="admin_user_delete.php?id=<?= $value['id'] ?>"><i class="fa fa-trash"></i></a> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>





        <?php include_once'footer.php' ?>	


    </body>
</html>