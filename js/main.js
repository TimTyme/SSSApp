$(function () {
    $('input').mouseenter(function () {
        $('p').text("inside");
    })
    $('input').mouseleave(function () {
        $('p').text("outside");
    })
});