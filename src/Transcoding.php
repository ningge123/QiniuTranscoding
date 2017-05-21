<?php

namespace Ning\Transoding;

use Ning\Transoding\Exceptions\TranscodingErrorException;
use Qiniu\Auth;
use Qiniu\Processing\PersistentFop;

class Transcoding
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var null
     */
    protected $error = null;

    /**
     * Transcoding constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;

    }

    /**
     * @param $key
     * @return array
     */
    public function videoTranscoding($key)
    {
        $this->initParam();

        $auth = new Auth($this->config['access_key'], $this->config['secret_key']);

        $pfop = new PersistentFop($auth, $this->config['bucket'], $this->config['pipeline'], $this->config['notifyUrl']);

        list($id, $err) = $pfop->execute($key, $this->config['fops']);

        $this->id = $id;

        $this->error = $err;

        return $this->response();
    }

    /**
     * @return array
     */
    public function initParam()
    {
        if (count($this->config) > 4) {
            return $this->config;
        }

        return array_merge($this->config,[
            'access_key' => config('filesystems.disks.qiniu.access_key'),
            'secret_key' => config('filesystems.disks.qiniu.secret_key'),
        ]);
    }

    /**
     * @return array
     */
    public function response()
    {
        return [$this->id, $this->error];
    }
}
