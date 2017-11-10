
$(document).ready(function() {
    var drag = false;
    var margin = ($(window).width() - $(".container-game").width())/2;
    var x = 0;
    var y = 0;

    $('circle')
    .mouseup(function () {
        var m = Math.sign( ($(this).attr("cy") - y)/($(this).attr("cx") - x) );        
        if (m == 1) {
            move($(this), x + 70, x);
        } else {
            move($(this), y, x);
        }
        console.log(x+','+y);
        drag = false;
    })
    .mousedown(function () {
        y = $(this).attr("cy");
        x = $(this).attr("cx");
        drag = true;
    })
    .mousemove(function (event) {
        if (drag) {
            move($(this), (event.pageX - margin), (event.pageY - 70));
        }
    });

    function move(piece, x, y) {
        piece.attr({
            cx: x,
            cy: y
        });
    }

});