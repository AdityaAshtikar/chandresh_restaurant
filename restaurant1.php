
<?php include'dbcon.php'; ?>
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

</style>
<section>
    <div class="container">
        <?php
        $sn = 1;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $sql = "select res.*,r.rating, round(sum(r2.rating) / count(r2.restaurant_id),1) as total_rating from restaurant as res
                    left join rating r on r.restaurant_id =  res.id and r.user_id = $user_id
                    left join rating r2 on r2.restaurant_id =  res.id
                    left join user u on u.id =  r.user_id 
                    where res.status = 'on' 
                    group by res.id 
                    order by res.id desc ";
        } else {
            $sql = "select res.*,null as rating, round(sum(r.rating) / count(r.restaurant_id),1) as total_rating from restaurant as res
                    left join rating r on r.restaurant_id =  res.id
                    where res.status = 'on'
                    group by res.id 
                    order by res.id desc ";
        }
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) > 0) {
            while ($res = mysqli_fetch_assoc($query)) {//print_r($res);
                ?>
                <div class="row">
                    <div class="tile">
                        <h2><?= $res['restaurant_name'] ?></h2>
                        <div class="col-md-3">
                            <img src="images/restaurant/<?= $res['img_path'] ?>" width="200" alt="" />
                        </div>
                        <div class="col-md-9">
                            <br>
                            <?php
                            $restaurant_id = $res['id'];
                            $rating = $res['rating'];
                            $total_rating = $res['total_rating'];
                            include("rating.php")
                            ?>


                            <p><?= $res['description'] ?></p>
                            <p>Address : <?= $res['address'] ?>, <?= $res['city'] ?>, <?= $res['pincode'] ?></p>
                            <p>Working Time : <?= $res['opening_hr'] ?> - <?= $res['closing_hr'] ?></p>
                            <span class="pull-right">
                                <a href="view.php?restaurent=<?= $res['id'] ?>" class="btn btn-danger">View Details</a>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    <div class="clearfix"></div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>










