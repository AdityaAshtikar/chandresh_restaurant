<?php
$fill_star = 'images/star.png';
$holo_star = 'images/star-hollow.png';
$guest = (isset($_SESSION['user_id'])) ? "login" : "guest";
?>

<div class="rating restaurant_<?= $restaurant_id ?>">
    <img class="star star1" data-user="<?=$guest?>" data-curr_star="<?= $rating ?>" data-star="1" data-restaurant_id="<?= $restaurant_id ?>" src="<?= ($rating >= 1) ? $fill_star : $holo_star ?>"/>
    <img class="star star2" data-user="<?=$guest?>" data-curr_star="<?= $rating ?>" data-star="2" data-restaurant_id="<?= $restaurant_id ?>" src="<?= ($rating >= 2) ? $fill_star : $holo_star ?>"/>
    <img class="star star3" data-user="<?=$guest?>" data-curr_star="<?= $rating ?>" data-star="3" data-restaurant_id="<?= $restaurant_id ?>" src="<?= ($rating >= 3) ? $fill_star : $holo_star ?>"/>
    <img class="star star4" data-user="<?=$guest?>" data-curr_star="<?= $rating ?>" data-star="4" data-restaurant_id="<?= $restaurant_id ?>" src="<?= ($rating >= 4) ? $fill_star : $holo_star ?>"/>
    <img class="star star5" data-user="<?=$guest?>" data-curr_star="<?= $rating ?>" data-star="5" data-restaurant_id="<?= $restaurant_id ?>" src="<?= ($rating >= 5) ? $fill_star : $holo_star ?>"/>
</div>
<?= (isset($total_rating)) ? '<span class="total_rating">'.$total_rating.'</span>' : "" ?>
<div class="clearfix"></div>
