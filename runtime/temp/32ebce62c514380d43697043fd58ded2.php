<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\www\twothink\public/../application/home/view/default/service\ajaxpage.html";i:1507708471;}*/ ?>
<?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
没有更多数据了
<?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$service): $mod = ($i % 2 );++$i;?>
<div class="row noticeList">
    <a href="<?php echo url('lists?id='.$service['id']); ?>">
        <div class="col-xs-2">
            <img class="noticeImg" src="/home/image/1.png" />
        </div>
        <div class="col-xs-10">
            <p class="title"><?php echo $service['title']; ?></p>
            <p class="intro"><?php echo $service['description']; ?></p>
            <p class="info"><?php echo $service['view']; ?><span class="pull-right"><?php echo date("Y-m-d H:i:s",$service['create_time']); ?></span> </p>
        </div>
    </a>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<button class="btn btn-default btn-block btn_load" onclick="loadpage(<?php echo $num; ?>)">获取更多</button>
<?php endif; ?>

