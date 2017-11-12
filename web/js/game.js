
$(document).ready(function() {
    var drag = false;
    var margin = ($(window).width() - $(".container-game").width())/2;
    var w = 70;
    var x = 0;
    var y = 0;
    var m = 0;
    var d = 0;
    var MovimientoX = 0;
    var MovimientoY = 0;
    var stringMovimientoCX = "";
    var stringMovimientoCY = "";

    $('circle')
    .mouseup(function () {
        if (drag) {
            MovimientoY = y;
            MovimientoX = x;
            m = Math.sign( ($(this).attr("cy") - y)/($(this).attr("cx") - x) );        

            wp = w * d;

            if (m == 1) {
                move($(this), x + wp, y + wp);
            } else {
                move($(this), x - wp, y + wp);
            }



            stringMovimientoCY = $(this).attr("cy");
            stringMovimientoCX = $(this).attr("cx");

            Movimiento.envioMovimiento(String(MovimientoX),String(MovimientoY),stringMovimientoCX,stringMovimientoCY);
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

    });

    function move(piece, x, y) {
        piece.attr({
            cx: x,
            cy: y
        });
    }

    // This object will be sent everytime you submit a message in the sendMessage function.
    var clientInformation = {
        username: new Date().getTime().toString()
        // You can add more information in a static object
    };
    
    // START SOCKET CONFIG
    /**
     * Note that you need to change the "sandbox" for the URL of your project. 
     * According to the configuration in Sockets/Chat.php , change the port if you need to.
     * @type WebSocket
     */
    var conn = new WebSocket('ws://localhost:8080/game');

    conn.onopen = function(e) {
        console.info("Connection established succesfully");
    };
    
    conn.onerror = function(e){
        alert("Error: something went wrong with the socket.");
        console.error(e);
    };
    // END SOCKET CONFIG
   

    // Mini API to send a message with the socket and append a message in a UL element.
    var Movimiento = {

        envioMovimiento: function(textX,textY,textCX,textCY){
            console.log("x en función es: "+textX);
            console.log("y en función es: "+textY);
            console.log("Cx en función es: "+textCX);
            console.log("Cy en función es: "+textCY);

            var text= textX.concat(",");
            text= text.concat(textY);
            var textC= textCX.concat(",");
            textC= textC.concat(textCY);
            //clientInformation.message = text;
            // Send info as JSON
            var textCompleto=text.concat("-");
            textCompleto=textCompleto.concat(textC);
            conn.send(JSON.stringify(textCompleto));
            console.log("JSON en función es: "+textCompleto);
            // Add my own message to the list
        }

    };

});