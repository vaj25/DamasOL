
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
    var Color = "";
    var captureX=0;
    var captureY=0;

    $('circle')
    .mouseup(function () {
        if (drag) {
            MovimientoY = y;
            MovimientoX = x;
            m = Math.sign( ($(this).attr("cy") - y)/($(this).attr("cx") - x) );

            wp = w * d;
            if (($(this).attr("class")=="white" && d == 1) || ($(this).attr("class")=="black" && d == -1)) {
                if (m == 1) {
                    move($(this), x + wp, y + wp);
                } else {
                    move($(this), x - wp, y + wp);
                }

                stringMovimientoCY = $(this).attr("cy");
                stringMovimientoCX = $(this).attr("cx");
                
                if($(this).attr("class")=="white"){
                    Color = "white";
                }else{
                    Color = "black";
                }

                Movimiento.envioMovimiento(String(MovimientoX),String(MovimientoY),stringMovimientoCX,stringMovimientoCY,Color);
            } else {
                move($(this), x, y);
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
    .click(function () {
        if (drag) {
            move($(this), x, y);
        }
    })
    .dblclick( function () {
        move($(this), x, y);
    });

    
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
    conn.onmessage = function(e) {
        var data = JSON.parse(e.data);
        /*move($('circle[cx='+data[0]+'][cy='+data[1]+']'), data[2], data[3]);
        alert("algo se movio we")*/
        console.log(data);
        Movimiento.recibirMovimiento(data);
    };
    conn.onerror = function(e){
        alert("Error: something went wrong with the socket.");
        console.error(e);
    };
    // END SOCKET CONFIG
    
    
    // Mini API to send a message with the socket and append a message in a UL element.
    var Movimiento = {
        
        envioMovimiento: function(textX,textY,textCX,textCY,color){
           
            var txt = [
                textX,
                textY,
                textCX,
                textCY,
                color,

            ];
            
            conn.send(JSON.stringify(txt));
            console.log("JSON en función es: "+JSON.stringify(txt));
            // Add my own message to the list
            //captureX=0;
        },

        recibirMovimiento: function(data){
            move($('circle[cx='+data[0]+'][cy='+data[1]+']'), data[2], data[3]);
            //alert("algo se movio we");
        },
        
    };
    
    function move(piece, x, y) {
        piece.attr({
            cx: x,
            cy: y
        });
    }

});