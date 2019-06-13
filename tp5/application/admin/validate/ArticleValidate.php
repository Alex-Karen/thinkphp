<?php

namespace app\admin\validate;

use think\Validate;

class ArticleValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'title' => 'require|token',
        'desn'  => 'require',
        'body'  => 'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'title.require' => '标题必须填写',
        'desn.require'  => '描述必须填写',
        'body.require'  => '内容必须填写',
    ];
}
