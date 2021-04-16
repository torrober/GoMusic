$(document).ready(function () {
    $('#button').on('click', function (e) {
        var sq_raw = $("#sq").val();
        var sq = sq_raw.replace(/ /g, "+");
        var result = "search.php?sq=" + sq;
        var dzr = "dzr.php?sq=" + sq;
        history.pushState(sq, null, result);
        $("#content").load(dzr);
    });
    $('#sq').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#button').click();
        }
    });
    $('#home').on('click', function (e) {
        var homexd = "home";
        var result2 = "/GoMusic/";
        var link = "home.php";
        history.pushState(homexd, null, result2);
        $("#main").load(link);
    });
    $('.main-carousel').flickity({
        // options
        cellAlign: 'left',
        contain: true,
        autoPlay: true
    });
});