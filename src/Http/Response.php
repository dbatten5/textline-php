<?php

namespace Textline\Http;

class Response
{
    /**
     * @var mixed
     */
    protected $statusCode;

    /**
     * @var mixed
     */
    protected $content;

    public function __construct($statusCode, $content)
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
    }

    /**
     * Getter for statusCode
     *
     * @return string
     * @author Dom Batten <db@mettrr.com>
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Getter for content
     *
     * @return string
     * @author Dom Batten <db@mettrr.com>
     */
    public function getContent($object = false)
    {
        return json_decode($this->content, $object);
    }

    /**
     * Return whether the response was successful
     *
     * @return bool
     * @author Dom Batten <db@mettrr.com>
     */
    public function successful()
    {
        return $this->statusCode < 400;
    }
}
