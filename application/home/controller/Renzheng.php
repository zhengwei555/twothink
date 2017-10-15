<?php

namespace app\home\controller;

use think\Request;

class Renzheng extends Home {
    public function add(){
        if(request()->isPost()){ //post提交
            $baoxiu=model('Renzheng');
          //  var_dump(1);die;
            $post_data=$this->request->post();
            $post_data['status']=0;
            $baoxiu->sn=rand(1000,9999);
            //自动验证
            $validate = validate('renzheng');
            if(!$validate->check($post_data)){//验证失败,返回错误信息
                //   var_dump(21);die;
                return $this->error($validate->getError());
            }
            $data = $baoxiu->create($post_data); //保存
            //  var_dump($validate);die;
            if($data){
                $this->success('新增成功', url('index'));//跳转到列表页
                //记录行为
                action_log('update_renzheng', 'renzheng', $data->id, UID);
            } else {
                $this->error($baoxiu->getError());
            }
        }else{
            $this->assign('info',null);
            //   $this->assign('meta_title', '新增导航');
            return $this->fetch('renzheng');
        }
    }

}