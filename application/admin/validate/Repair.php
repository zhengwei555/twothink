<?php
namespace app\admin\validate;
use think\Validate;
/**
 *  模型验证模型
 */
class Repair extends Validate{
    protected $rule = [
        ['tel', 'require', '电话不能为空'],
        ['address', 'require', '地址不能为空'],
        ['name', 'require', '名字不能为空'],
        ['title', 'sale', '主题不能为空'],
        ['problem', 'require', '问题不能为空'],
    ];
}