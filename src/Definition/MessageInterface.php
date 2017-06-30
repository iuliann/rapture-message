<?php

namespace Rapture\Message\Definition;

/**
 * Interface GenericMessageInterface
 *
 * @package Rapture\Message
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
interface MessageInterface
{
    /**
     * Set sender
     *
     * @param mixed $sender
     *
     * @return MessageInterface
     */
    public function setSender($sender):MessageInterface;

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender():string;

    /**
     * Set recipients
     *
     * @param array $recipients
     *
     * @return mixed
     */
    public function addRecipients(array $recipients):MessageInterface;

    /**
     * Get recipients
     *
     * @return array
     */
    public function getRecipients():array;

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return MessageInterface
     */
    public function setSubject($subject):MessageInterface;

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject():string;

    /**
     * Set body
     *
     * @param string $body
     *
     * @return MessageInterface
     */
    public function setBody($body):MessageInterface;

    /**
     * Get body
     *
     * @return string
     */
    public function getBody():string;

    /**
     * Set attributes
     *
     * @param array $attributes
     *
     * @return MessageInterface
     */
    public function addAttributes(array $attributes):MessageInterface;

    /**
     * get attributes
     *
     * @return array
     */
    public function getAttributes():array;

    /**
     * Set attribute
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return MessageInterface
     */
    public function setAttribute(string $name, $value):MessageInterface;

    /**
     * Get attribute
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getAttribute(string $name);
}
