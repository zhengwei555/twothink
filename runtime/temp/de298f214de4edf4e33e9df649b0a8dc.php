<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\www\twothink\public/../application/home/view/default/document\ajaxpage.html";i:1507434896;}*/ ?>
<?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
没有更多数据了
<?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$document): $mod = ($i % 2 );++$i;?>
<div class="row noticeList">
    <a href="<?php echo url('details?id='.$document['id']); ?>">
        <div class="col-xs-2">
            <img class="noticeImg" src="/image/index.png" />
        </div>
        <div class="col-xs-10">
            <p class="title"><?php echo $document['title']; ?></p>
            <p class="intro"><?php echo $document['description']; ?></p>
            <p class="info">浏览量:<?php echo $document['view']; ?> <span class="pull-right"><?php echo date("Y-m-d H:i:s",$document['create_time']); ?></span> </p>
        </div>
    </a>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<button class="btn btn-default btn-block btn_load" onclick="loadPage(<?php echo $num; ?>)">获取更多</button>
<?php endif; ?>

