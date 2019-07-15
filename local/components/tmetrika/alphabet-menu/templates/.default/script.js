$(function () {

    $(".element_hover, .seria_hover").hover(function () {

        var $this = $(this);

        $this.addClass("active");

        var type = $this.attr("data-type");
        var id = $this.attr("data-id");

        var url = type === "section" ? "seria_info.php" : "element_info.php";

        $.ajax({
            url: "/ajax/tmetrika/" + url,
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                var element = $this.closest(".alphabet-item").find(".alphabet-demo");
                element.html(data).addClass("active");
                console.log("AJAX");
            }
        });
    }, function () {
        $(this).removeClass("active");
    });


    console.log("script");
});
