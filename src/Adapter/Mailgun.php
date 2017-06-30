<?php

namespace Rapture\Message\Adapter;

use Psr\Http\Message\RequestInterface;
use Rapture\Http\Request;
use Rapture\Http\Stream;
use Rapture\Http\Uri;
use Rapture\Message\Definition\AdapterInterface;
use Rapture\Message\Definition\MessageInterface;

/**
 * Class Mailgun
 *
 * @package Rapture\Message
 * @author  Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 * @see     https://documentation.mailgun.com/api-sending.html#sending
 */
class Mailgun implements AdapterInterface
{
    /** @var array */
    protected $config = [
        'apiKey'    =>  '',
        'baseUrl'   =>  'https://api.mailgun.net/v3',
        'domain'    =>  ''
    ];

    public function __construct(array $config = [])
    {
        $this->config = $config + $this->config;
    }

    public function getRequest(MessageInterface $message):RequestInterface
    {
        $stream = new Stream(fopen('php://memory', 'r+'));
        $stream->write(http_build_query($this->getParams($message)));

        $headers = [
            'Authorization' => 'Basic ' . base64_encode(sprintf('api:%s', $this->config['apiKey'])),
        ];

        $request = new Request(new Uri($this->getUrl()), Request::METHOD_POST, $headers);
        $request->withBody($stream);

        return $request;
    }

    protected function getUrl()
    {
        return sprintf('%s/%s/messages', $this->config['baseUrl'], $this->config['domain']);
    }

    /**
     * @param MessageInterface $message
     *
     * @return array
     */
    protected function getParams(MessageInterface $message)
    {
        $data = array_filter([
            'from'      =>  $message->getSender(),
            'to'        =>  $message->getRecipients(),
            'cc'        =>  $message->getAttribute('cc'),
            'bcc'       =>  $message->getAttribute('bcc'),
            'subject'   =>  $message->getSubject(),
            'text'      =>  $message->getAttribute('text'),
            'html'      =>  $message->getAttribute('html'),
            'inline'    =>  $message->getAttribute('inline') ?? [],
            'attachment'=>  $message->getAttribute('attachment') ?? [],
            'o:tag'     =>  $message->getAttribute('tags') ?? [],
        ]);

        return $data;
    }
}
