<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\www\twothink\public/../application/home/view/default/market\ajaxpage.html";i:1507705799;}*/ ?>
<?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
没有更多数据了
<?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$market): $mod = ($i % 2 );++$i;?>
<div class="row noticeList">
    <a href="<?php echo url('details?id='.$market['id']); ?>">
        <div class="col-xs-2">
            <img class="noticeImg" src="../image/1.png" />
        </div>
        <div class="col-xs-10">
            <p class="title"><?php echo $market['title']; ?></p>
            <p class="intro"><?php echo $market['description']; ?></p>
            <p class="info">浏览量:<?php echo $market['view']; ?> <span class="pull-right"><?php echo date("Y-m-d H:i:s",$market['create_time']); ?></span> </p>
        </div>
    </a>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<button class="btn btn-default btn-block btn_load" onclick="loadpage(<?php echo $num; ?>)">获取更多</button>
<?php endif; ?>
