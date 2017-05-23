# QiniuTranscoding

七牛云视频转码。很多代码有点糟糕。使用限制条件很多，已经上传到七牛的视频发起异步转码操作 .

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
list($id, $err) = $transcoding->videoTranscoding('cocoyo.qlv');
```

注意这里会返回一个数组,转码错误的话`$err`就不是`null`，`$id`类似这样的:z2.59219169e3d0041bf8086900,你可以根据这个`id`去查询转码状态

```
http://api.qiniu.com/status/get/prefop?id=z2.59219169e3d0041bf8086900
```

在`laravel`中使用，在你的`config/app.php`的`provider`添加如下：

```
 CocoNing\Transcoding\TranscodingServiceProvider::class,
```

# 使用:

```
$transcoding = app('transcoding');
$transcoding->setConfig($config);
```

`laravel`你可以不需要传递`access_key`和` secret_key`,默认是取:

```
'access_key' => config('filesystems.disks.qiniu.access_key'),
'secret_key' => config('filesystems.disks.qiniu.secret_key'),
```
