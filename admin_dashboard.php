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
        if (!isset($_REQUEST['status'])) {
            $sql = "select * from company where status = 'req';";
        } elseif ($_REQUEST['status'] == 'all') {
            $status = $_REQUEST['status'];
            $sql = "select * from company;";
        } else {
            $status = $_REQUEST['status'];
            $sql = "select * from company where status = '$status';";
        }

        $query = mysqli_query($con, $sql);
        $res = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $sn = 1;

        $sql = "select com_id,count(*) as count from job group by com_id";
        $query = mysqli_query($con, $sql);
        $count = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach ($count as $count) {
            $counts[$count['com_id']] = $count['count'];
        }
        ?>    

        <section id="base">
            <div class="container">
                <h1 class="title">Company List
                    <span class="pull-right"><a href="admin_company.php?status=trash" class="btn btn-default">Trash</a></span>
                    <span class="pull-right"><a href="admin_company.php?status=req" class="btn btn-default">Request</a></span>
                    <span class="pull-right"><a href="admin_company.php?status=on" class="btn btn-default">Ongoing</a></span>
                    <span class="pull-right"><a href="admin_company.php?status=all" class="btn btn-default">All</a></span>
                </h1>
                <table id="example" class="mytable" border="1">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Contact Person</th>
                            <th>Date</th>
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
                                <td><?= $value['contact_person'] ?></td>
                                <td><?= date("d-m-Y", $value['date']) ?></td>
                                <td>
                                    <span class="badge badge-primary">
                                        <a href="admin_job.php?com_id=<?= $value['com_id'] ?>" style="color:white"><i class="fa fa-eye"></i>
                                            <?php if (isset($counts[$value['com_id']])) { ?>
                                                <?= $counts[$value['com_id']] ?>
                                            <?php } ?>
                                        </a>
                                    </span>

                                    <a href="admin_company_delete.php?curr=<?= $status ?>&status=trash&com_id=<?= $value['com_id'] ?>"><i class="fa fa-trash"></i> </a> 
                                    <a href="admin_company_delete.php?curr=<?= $status ?>&status=on&com_id=<?= $value['com_id'] ?>"><i class="fa fa-undo"></i> </a> 
                                    <a href="admin_company_delete.php?curr=<?= $status ?>&status=on&com_id=<?= $value['com_id'] ?>"><i class="fa fa-check"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>





        <?php include_once'footer.php' ?>	


    </body>
</html>