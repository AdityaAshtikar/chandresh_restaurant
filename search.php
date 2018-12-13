<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $pass = md5($_POST['pass']);
        include'dbcon.php';
        $sql = "select * from user where email = '$uname' and pass = '$pass'";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) == 1) {
            $res = mysqli_fetch_assoc($query);
            $_SESSION['userLogin'] = 'userLogin';
            $_SESSION['user_id'] = $res['id'];
            $_SESSION['user_name'] = $res['name'];
            header('Location:user_panel.php');
        } else {
            echo "<script>alert('Invalid Email and Password');</script>";
        }
    }
}
?>
<style type="text/css">
    .search{
        padding: 10px;
        background: #ccc;
    }

</style>
<section class="search">
    <div class="container">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="row">
                <div class="col-md-6">
                    <input type="text"  class=""   name="restaurant" placeholder="Search Restaurant"/>
                </div>
                <div class="col-md-4">
                    <input type="text"  class=""  name="address" placeholder="Address, City"/>
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Search" />
                </div>
            </div>
        </form>
    </div>
</section>