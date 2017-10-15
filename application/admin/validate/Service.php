<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/7
 * Time: 15:30
 */
namespace app\admin\validate;

use think\Validate;

class Service extends Validate{
    protected $rule=[
        ['title', 'require|length:1,80', '标题不能为空|标题长度不能超过80个字符'],
        ['content','require','内容不能为空'],
        ['name','require','发布者必填'],
        ['description','require','描述必填 ']

    ];
}