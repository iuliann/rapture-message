<?php

namespace Rapture\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $message = new \Rapture\Message\Message();

        $message->setSubject('Subject');

        $this->assertEquals('Subject', $message->getSubject());
    }
}
