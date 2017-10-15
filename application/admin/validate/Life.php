<?php
namespace app\admin\validate;
use think\Validate;
/**
 *  模型验证模型
 */
class Life extends Validate{
    protected $rule = [
        ['title', 'require', '标题不能为空'],
        ['content', 'require', '内容不能为空'],
        ['name', 'require', '名字不能为空'],
        ['description', 'require', '描述不能为空'],
        ['view', 'require', '点击量不能为空'],
        ['tel', 'require', '电话不能为空'],
    ];
}