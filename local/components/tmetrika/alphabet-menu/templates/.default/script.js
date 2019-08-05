$(function () {

    // var loading = false;

    $(".alphabet-loader").hide();

    $(".element_hover, .seria_hover").on("mouseenter", function () {

        // не делаем повторную загрузку
        // if (loading) {
            // return;
        // }

        // loading = true;

        var loader = $(this).closest(".alphabet-item").find(".alphabet-loader");

        loader.show();

        var $this = $(this);

        $(".element_hover, .seria_hover").removeClass("active");
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
                loading = false;
                loader.hide();
            }
        });
    });
});
