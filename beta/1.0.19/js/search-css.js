$(function() {
    //あ A　タブ切替
    $("#tab li").click(function() {
        $("#tab li").removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();

        $(".tab-item").removeClass("active");
        $(".tab-item").eq(index).addClass("active");
    });

    //あかさたな　タブ切替
    $("#kana-tab li").click(function() {
        $("#kana-tab li").removeClass("kana-active");
        $(this).addClass("kana-active");
        var index = $(this).index();

        $(".kana-tab-item").removeClass("kana-active");
        $(".kana-tab-item").eq(index).addClass("kana-active");
    });
});