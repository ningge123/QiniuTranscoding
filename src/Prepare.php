<?php

namespace CocoNing\Transcoding;

use CocoNing\Transcoding\Transcoding;

class Prepare
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * Prepare constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $key
     * @return array
     */
    public function videoTranscoding($key)
    {
        $res = new Transcoding($this->config);

        return $res->videoTranscoding($key);
    }
}