<?php
// myapp\src\AppBundle\Sockets\Chat.php;

// Change the namespace according to your bundle, and that's all !
namespace AppBundle\Sockets;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Game implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        //echo sprintf('Connection %d sending message "%s" to %d other connection %s' . "\n" , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $obj = json_decode($msg,true);       
        $y=intval($obj[1]);
        $cy=intval($obj[3]);
        $yc=intval($obj[1]);
        $cyc=intval($obj[3]);


        if ($obj[4]=="black") {
            if (($cy-$y)==-70 || ($cyc-$yc)==-140) {
                foreach ($this->clients as $client) {
                    if ($from !== $client) {
                        // The sender is not the receiver, send to each client connected
                        $client->send($msg);
                        echo var_dump($msg);
                    }
                }

            }
        }else{
            if (($cy-$y)==70 || ($cyc-$yc)==140) {
                foreach ($this->clients as $client) {
                    if ($from !== $client) {
                        $client->send($msg);
                        echo var_dump($msg);
                    }
                }
            }
        }

    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}