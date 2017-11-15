
$(document).ready(function() {
    var drag = false;
    var play = true;
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
    var captureX = 0;
    var captureY = 0;
    var color = "";
    var idPartida = $('input[name=partida]').val();
    
    $.ajax({
        type: 'post',
        url: '/partida/jugador',
        data: {partida : $('input[name="partida"]').val()},
        success: function(result) {
            if (result["response"] == "visited" || result["response"] == "null") {
                noPlay();
            } else {
                color = result["response"];
                if (play && color != "") {
                    $('circle.'+color)
                    .mouseup(function () {
                        if (drag) {
                            MovimientoY = y;
                            MovimientoX = x;
                            m = Math.sign( ($(this).attr("cy") - y)/($(this).attr("cx") - x) );
            
                            wp = w * d;
                            xp = (m == 1) ? (x + wp) : (x - wp);
                            yp = y + wp;
            
                            if (
                                ( ($(this).attr("class")=="white" && Math.sign(d) == 1) || 
                                ($(this).attr("class")=="black" && Math.sign(d) == -1) ) &&
                                isEmpty(xp, yp) && (Math.abs(d) <= 2) &&
                                play
                            ) {
            
                                if ( Math.abs(d) == 2) {
                                    wc = w * (Math.sign(d) * 1);
                                    xc = (m == 1) ? (x + wc) : (x - wc);
                                    yc = y + wc;
                                    
                                    if(!remove(xc, yc)) {
                                        xp = x;
                                        yp = y;
                                    } else {
                                        captureX = xc;
                                        captureY = yc;
                                    }
                                }
            
                                move($(this), xp, yp);
                                
                                stringMovimientoCY = $(this).attr("cy");
                                stringMovimientoCX = $(this).attr("cx");
            
                                Movimiento.envioMovimiento(
                                    String(MovimientoX),
                                    String(MovimientoY),
                                    stringMovimientoCX,
                                    stringMovimientoCY,
                                    $(this).attr("class"),
                                    String(captureX),
                                    String(captureY),
                                    String(idPartida)
                                );
                            } else {
                                move($(this), x, y);
                            }
                        }
                        $('svg[width=24]').empty();
                        drag = false;
                        noPlay();
                    })
                    .mousedown(function () {
                        if (!drag) {    
                            y = parseInt($(this).attr("cy"));
                            x = parseInt($(this).attr("cx"));
                        }
                        captureX = "0";
                        captureY = "0";
                        $('svg').append($(this));
                        drag = true;
                    })
                    .mousemove(function (event) {
                        if (drag) {
                            move($(this), (event.pageX - margin), (event.pageY - w));
                            d = Math.round(((event.pageY - w) - y)/70);
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
                }
            }
        },
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
        console.log(data);
        Movimiento.recibirMovimiento(data);
        if (data[5] != 0 && data[6] != 0) {
            Movimiento.eliminarPieza(data);
        }
    };
    conn.onerror = function(e){
        alert("Error: something went wrong with the socket.");
        console.error(e);
    };
    // END SOCKET CONFIG
    
    
    // Mini API to send a message with the socket and append a message in a UL element.
    var Movimiento = {
        
        envioMovimiento: function(textX,textY,textCX,textCY,color,textCapX,textCapY,idPartida){
           
            var txt = [
                textX,
                textY,
                textCX,
                textCY,
                color,
                textCapX,
                textCapY,
                idPartida
            ];
            
            conn.send(JSON.stringify(txt));
            console.log("JSON en función es: "+JSON.stringify(txt));
            // Add my own message to the list
        },

        recibirMovimiento: function(data){
            if (idPartida == data[7]) {
                move($('circle[cx='+data[0]+'][cy='+data[1]+']'), data[2], data[3]);
                Play();
            }
        }, 

        eliminarPieza:  function(data){
            remove(data[5], data[6]);         
            
        }, 
        
    };
    
    function move(piece, x, y) {
        piece.attr({
            cx: x,
            cy: y
        });
    }

    function isEmpty(x, y) {
        if ($('#svg circle[cx='+x+'][cy='+y+']').length) {
            return false;
        } else {
            return true;
        }
    }

    function remove(x, y) {
        var cicl = $('#svg circle[cx='+x+'][cy='+y+']');
        if (cicl.length) {
            cicl.remove();
            return true;
        } else {
            return false;
        }
    }

    function noPlay() {
        play = false;
    }

    function Play() {
        play = true;
    }

});