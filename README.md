# QiniuTranscoding

七牛云视频转码。哈哈自己写的第一个轮子，紧张ing，很多代码有点糟糕。这个轮子的使用限制条件很多，已经上传到七牛的视频发起异步转码操作 .

# 安装

```
composer require coconing/transcoding
```

# 使用

```
require_once  './vendor/autoload.php';

$config = [
    'access_key' => '七牛云AK',
    'secret_key' => ‘七牛云SK',
    'bucket' => '空间名',
    'pipeline' => '转码是使用的队列名称。 https://portal.qiniu.com/mps/pipeline,你也可以为空，使用默认的转码队列',
    'notifyUrl' => '转码完成后异步通知到你的业务服务器',
    'fops' => "要进行转码的转码操作。 http://developer.qiniu.com/docs/v6/api/reference/fop/av/avthumb.html"
];

$transcoding = new \CocoNing\Transcoding\Prepare($config);

list($id, $err) = $transcoding->videoTranscoding('cocoyo.qlv');

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($id);
}
```
你还可以这样:

```
$transcoding = new \CocoNing\Transcoding\Prepare();
$transcoding->setConfig($config);
```

注意这里会返回一个数组,转码错误的话`$err`就不是`null`，`$id`类似这样的:z2.59219169e3d0041bf8086900,你可以根据这个`id`去查询转码状态

```
http://api.qiniu.com/status/get/prefop?id=z2.59219169e3d0041bf8086900
```

在`laravel`中使用:

```
 //provider
 \CocoNing\Transcoding\TranscodingServiceProvider::class,
```

