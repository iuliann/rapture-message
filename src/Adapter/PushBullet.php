<?php

namespace Rapture\Message\Adapter;

use Psr\Http\Message\RequestInterface;
use Rapture\Http\Request;
use Rapture\Http\Stream;
use Rapture\Http\Uri;
use Rapture\Message\Definition\AdapterInterface;
use Rapture\Message\Definition\MessageInterface;

/**
 * Class PushBullet
 *
 * @package Rapture\Message
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 * @see     https://docs.pushbullet.com/#create-push
 */
class PushBullet implements AdapterInterface
{
    /** @var array */
    protected $config = [
        'apiKey'    =>  '',
        'baseUrl'   =>  'https://api.pushbullet.com/v2'
    ];

    public function __construct(array $config = [])
    {
        $this->config = $config + $this->config;
    }

    public function getRequest(MessageInterface $message):RequestInterface
    {
        $data = json_encode(
            [
                'title' =>  $message->getSubject(),
                'body'  =>  $message->getBody()
            ]
            + $message->getAttributes()
            + ['type' => 'note']
        );

        $headers = [
            'Content-Type'  =>  'application/json',
            'Access-Token'  =>  $this->config['apiKey']
        ];

        $request = new Request(new Uri($this->getUrl()), Request::METHOD_POST, $headers);

        $stream = new Stream(fopen('php://memory', 'r+'));
        $stream->write(json_encode($data));
        $request->withBody($stream);

        return $request;
    }

    protected function getUrl()
    {
        return "{$this->config['baseUrl']}/pushes";
    }
}
