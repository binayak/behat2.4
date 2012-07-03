<?php

namespace Test\Behat\SahiClient;

use Buzz\Client;
use Buzz\Message;

class ClientQueue implements Client\ClientInterface
{
    protected $queue = array();

    public function getQueue()
    {
        return $this->queue;
    }

    public function setQueue(array $queue)
    {
        foreach ($queue as $response) {
            $this->sendToQueue($response);
        }
    }

    /**
     * Sends a response into the queue.
     *
     * @param Message\Response $response A response
     */
    public function sendToQueue(Message\Response $response)
    {
        $this->queue[] = $response;
    }

    /**
     * Receives a response from the queue.
     *
     * @return Message\Response|null
     */
    public function receiveFromQueue()
    {
        if (count($this->queue)) {
            return array_pop($this->queue);
        }
    }

    /**
     * @see Client\ClientInterface
     */
    public function send(Message\Request $request, Message\Response $response)
    {
        if (!$queued = $this->receiveFromQueue()) {
            throw new \LogicException('There are no queued responses.');
        }

        $response->setHeaders($queued->getHeaders());
        $response->setContent($queued->getContent());
    }
}
