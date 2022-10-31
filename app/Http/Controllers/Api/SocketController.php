<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class SocketController extends Controller implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);
        if (isset($queryarray['token'])) {
            /*todo*/
        }
        foreach ($this->clients as $client) {
            /*todo*/
        }
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $data = json_decode($msg);
    }

    public function onClose(ConnectionInterface $conn)
    {
        foreach ($this->clients as $client) {
            /*todo*/
        }
        $this->clients->detach($conn);
        $querystring = $conn->httpRequest->getUri()->getQuery();
        parse_str($querystring, $queryarray);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()} \n";
        $conn->close();
    }
}
