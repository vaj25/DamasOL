<?php
// myapplication/src/sandboxBundle/Command/SocketCommand.php
// Change the namespace according to your bundle
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// Include ratchet libs
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

use Ratchet\App;

// Change the namespace according to your bundle
use AppBundle\Sockets\Game;
use AppBundle\Sockets\Chat;

class SocketCommand extends Command
{
    protected function configure()
    {
        $this->setName('sockets:start-socket')
            // the short description shown while running "php bin/console list"
            ->setHelp("Starts the chat socket demo")
            // the full command description shown when running the command with
            ->setDescription('Starts the chat socket demo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Game socket',// A line
            '============',// Another line
            'Starting game, open your browser.',// Empty line
        ]);
        
        // $server = IoServer::factory(
        //     new HttpServer(
        //         new WsServer(
        //             new Chat()
        //         )
        //     ),
        //     8080
        // );

        $app = new App('localhost', 8080);
        $app->route('/chat', new Chat);
        $app->route('/game', new Game);
        //$app->route('/grupoa-chat', new Chat);
        
        $app->run();
    }
}