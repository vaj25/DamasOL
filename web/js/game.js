
$(document).ready(function() {
    var drag = false;
    var margin = ($(window).width() - $(".container-game").width())/2;
    var w = 70;
    var x = 0;
    var y = 0;
    var m = 0;
    var d = 0;

    $('circle')
    .mouseup(function () {
        if (drag) {
            m = Math.sign( ($(this).attr("cy") - y)/($(this).attr("cx") - x) );        

            wp = w * d;

            if (m == 1) {
                move($(this), x + wp, y + wp);
            } else {
                move($(this), x - wp, y + wp);
            }
        }
        drag = false;
    })
    .mousedown(function () {
        if (!drag) {
            y = parseInt($(this).attr("cy"));
            x = parseInt($(this).attr("cx"));
        }
        drag = true;
    })
    .mousemove(function (event) {
        if (drag) {
            move($(this), (event.pageX - margin), (event.pageY - w));
            if ((event.pageY - w) - y > 0) {
                d = 1;
            } else {
                d = -1;                
            }
        }
    })
    .dblclick( function () {
        move($(this), x, y);
    });

    function move(piece, x, y) {
        piece.attr({
            cx: x,
            cy: y
        });
    }

});