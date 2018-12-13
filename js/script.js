


$(".star").on("mouseout", function () {
    star = $(this).attr("data-curr_star");
    show($(this), star);
});
$(".star").on("mouseover", function () {//alert();
    var star = $(this).data("star");
    show($(this), star);
});
function show(thisObj, star) {
//    var baseUrl = baseurl;
    var restaurant_id = thisObj.data("restaurant_id");
    var restaurant_class = ".restaurant_" + restaurant_id;
    for (i = 1; i <= 5; i++) {
        if (i <= star) {
            $(restaurant_class + " .star" + i).attr("src", "images/star.png");
        } else {
            $(restaurant_class + " .star" + i).attr("src", "images/star-hollow.png");
        }
    }
}
$(".star").on("click", function () {
    var thisObj = $(this);
    //var baseUrl = "";
    var star = thisObj.data("star");
    var restaurant_id = thisObj.data("restaurant_id");
    var restaurant_class = ".restaurant_" + restaurant_id;
    var url = "ajax_rating.png";

    if (thisObj.data("user") == "guest") {
        location = "login.php";
    } else {
//    alert(restaurant_id)
        $.post("ajax_rating.php", {restaurant_id: restaurant_id, star: star}, function (data) {//alert();
            data = JSON.parse(data);
            if (data.response) {
                if (data.response_type == "new") {
                    //showToast.show('Thank You For Rate!', 2500);
                }
                show(thisObj, star);
                $(restaurant_class + " img").attr("data-curr_star", star);

            }
        });
    }
});

