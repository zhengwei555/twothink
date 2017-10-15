<?php

namespace app\admin\controller;

use think\Request;

class Renzheng extends Admin{
    /**
     * 频道列表
     */
    public function index(){
        $map = array();
        $list = $this->lists('renzheng', $map,'id');
        int_to_string($list);
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->assign('list', $list);
       // $this->assign('meta_title' , '报修管理');
        return $this->fetch();
    }
    //添加报修
    public function add(){
        if(request()->isPost()){ //post提交
            $baoxiu=model('renzheng');
            $post_data=$this->request->post();
            $post_data['status']=1;
            //自动验证
            $validate = validate('renzheng');
           if(!$validate->check($post_data)){//验证失败,返回错误信息
             //   var_dump(21);die;
                return $this->error($validate->getError());
            }
            $data = $baoxiu->insert($post_data); //保存
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
            return $this->fetch('edit');
        }
    }
    //修改
    public function edit($id=0){
      //  var_dump($id);die;
        if(request()->isPost()){ //post提交
            $post_data=$this->request->post();
            $baoxiu = \think\Loader::model('renzheng');
         //   $baoxiu = \think\Db::name("baoxiu");
            $data = $baoxiu->update($post_data); //保存
            //  var_dump($validate);die;
            if($data!==false){
                $this->success('编辑成功', url('index'));//跳转到列表页
           } else {
            //    var_dump(1);die;
                $this->error('编辑失败');
            }
        }else{
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('renzheng')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
        //    $this->meta_title = '编辑导航';
            return $this->fetch();
        }
    }

    //删除
    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('renzheng')->where($map)->delete()){
            cache('db_renzheng_data',null);
            //记录行为
            action_log('update_renzheng','renzheng',$id,UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }


}