<?php

namespace Rapture\Message;

use Rapture\Message\Definition\MessageInterface;

/**
 * Class Message
 *
 * @package Rapture\Message
 * @author Iulian N. <rapture@iuliann.ro>
 * @license LICENSE MIT
 */
class Message implements MessageInterface
{
    protected $attributes = [];

    /**
     * GenericMessageInterface constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * setSender
     *
     * @param mixed $sender
     *
     * @return MessageInterface
     */
    public function setSender($sender):MessageInterface
    {
        $this->attributes['sender'] = $sender;

        return $this;
    }

    /**
     * getSender
     *
     * @return string
     */
    public function getSender():string
    {
        return (string)$this->getAttribute('sender');
    }

    /**
     * Set recipients
     *
     * @param array $recipients
     *
     * @return MessageInterface
     */
    public function addRecipients(array $recipients):MessageInterface
    {
        foreach ($recipients as $recipient) {
            $this->attributes['recipient'][] = $recipient;
        }

        return $this;
    }

    /**
     * getRecipients
     *
     * @return array
     */
    public function getRecipients():array
    {
        return (array)$this->getAttribute('recipient');
    }

    /**
     * setSubject
     *
     * @param string $subject
     *
     * @return MessageInterface
     */
    public function setSubject($subject):MessageInterface
    {
        $this->attributes['subject'] = $subject;

        return $this;
    }

    /**
     * getSubject
     *
     * @return string
     */
    public function getSubject():string
    {
        return (string)$this->getAttribute('subject');
    }

    /**
     * setBody
     *
     * @param string $body
     *
     * @return MessageInterface
     */
    public function setBody($body):MessageInterface
    {
        $this->attributes['body'] = $body;

        return $this;
    }

    /**
     * getBody
     *
     * @return string
     */
    public function getBody():string
    {
        return (string)$this->getAttribute('body');
    }

    /**
     * setAttributes
     *
     * @param array $attributes
     *
     * @return MessageInterface
     */
    public function addAttributes(array $attributes):MessageInterface
    {
        $this->attributes = $attributes + $this->attributes;

        return $this;
    }

    /**
     * getAttributes
     *
     * @return array
     */
    public function getAttributes():array
    {
        return $this->attributes;
    }

    /**
     * Set attribute
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return MessageInterface
     */
    public function setAttribute(string $name, $value):MessageInterface
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Get attribute
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getAttribute(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Magic call
     * (new Message)->setTags(['tag1', 'tag2'])->addTags('tag3');
     *
     * @param string $name Attribute name
     * @param array  $args Arguments
     *
     * @return $this|mixed
     */
    public function __call($name, $args)
    {
        $method    = substr($name, 0, 3);
        $attribute = lcfirst(substr($name, 3));

        switch ($method) {
            case 'add':
                $this->attributes[$attribute][] = $args[0];
                return $this;
            case 'get':
                return $this->getAttribute($attribute);
            case 'set':
                $this->attributes[$attribute] = $args[0];
                return $this;
        }

        throw new \InvalidArgumentException('Unknown method name');
    }
}
