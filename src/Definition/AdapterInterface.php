<?php

namespace Rapture\Message\Definition;

use Psr\Http\Message\RequestInterface;

/**
 * Interface AdapterInterface
 *
 * @package Rapture\Message
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface AdapterInterface
{
    public function getRequest(MessageInterface $message):RequestInterface;
}
