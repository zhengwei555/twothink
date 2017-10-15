<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 14:33
 */
namespace app\home\validate;
use think\Validate;

class Renzheng extends Validate{
    protected $rule=[
        ['sn', 'require', '住户标号不能为空'],
        ['name', 'require', '名字不能为空'],
        ['tel', 'require', '电话不能为空'],
        ['area_name', 'require', '小区地址不能为空'],
        ['ID_card', 'require', '身份证不能为空'],
        ['relationship', 'require', '关系不能为空'],
        ['status', 'integer'],
    ];
}
