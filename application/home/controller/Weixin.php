<?php
namespace app\home\controller;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Text;
use think\Controller;
use EasyWeChat\Foundation\Application;
class Weixin extends Controller {
    private      $_options=[
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => true,
        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id'  => 'wx0d95f4f31607eeb6',         // AppID
        'secret'  => 'd3787b53137160c2d67a58e3beebf306',     // AppSecret
        'token'   => 'weixin',          // Token
        'aes_key' => '',                    // EncodingAESKey，安全模式下请一定要填写！！！
        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => '/www/wwwroot/tp/runtime/log/easywechat.log',
        ],
        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/examples/oauth_callback.php',
        ],
        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id'        => 'your-mch-id',
            'key'                => 'key-for-signature',
            'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ],
        /**
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],
    ];

    public function index(){
        $app = new Application($this->_options);
// 从项目实例中得到服务端应用实例。
        $server = $app->server;
        //回复消息
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            # code...
                            break;
                        case 'CLICK'://点击菜单
                            /*if($message->EventKey == 'a'){
                            //执行a业务逻辑
                            }elseif ($message->EventKey == 'b'){
                                //...
                            }*/
                            return '你点击了'.$message->EventKey;
                            break;
                        default:
                            # code...
                            break;
                    }
                    break;
                case 'text':
                    if($message->Content=='活动'){
                        $news1 = new News([
                            'title'       => '前台首页',
                            'description' => '...',
                            'url'         => 'http://zwphp5.jackpuls.top/',
                            'image'       => 'http://zwphp5.jackpuls.top/image/index.png',
                            // ...
                        ]);
                        $news2 = new News([
                            'title'       => '后台首页',
                            'description' => '...',
                            'url'         => 'http://zwphp5.jackpuls.top/admin',
                            'image'       => 'http://img3.imgtn.bdimg.com/it/u=4166721891,1503444760&fm=27&gp=0.jpg',
                            // ...
                        ]);
                        return [$news1,$news2];
                    }elseif ($message->Content=='菜单'){
                        $text = new Text(['content' => '这是菜单']);
                        return $text;
                    }
                    return $message->Content;
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
            // ...
        });


        $response = $server->serve();
        $response->send(); // Laravel 里请使用：return $response;

    }

    //设置菜单
    public function setMenu(){
        $app = new Application($this->_options);
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }

    public function getMenu(){
        $app = new Application($this->_options);
        $menu = $app->menu;
        $menus=$menu->all();
        var_dump($menus);
    }


}
