<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bui-bootstrap/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bui-bootstrap/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bui-bootstrap/Css/style.css" />
    <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/Js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/Js/bootstrap.js"></script>
    <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/Js/ckform.js"></script>
    <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/Js/common.js"></script>
    <!--fancybox资源引入-->
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/fancybox/source/jquery.fancybox.css" />
  <script type="text/javascript" src="__PUBLIC__/fancybox/source/jquery.fancybox.pack.js"></script>
  <script type="text/javascript" src="__PUBLIC__/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
  <!--弹出对话框-->
    <link rel="stylesheet" href="__PUBLIC__/artDialog/css/ui-dialog.css">
    <script src="__PUBLIC__/artDialog/dist/dialog-plus.js"></script>
    <script type="text/javascript" src="__PUBLIC__/lib/jquery.form.js"></script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>
<form class="form-inline definewidth m20" action="#" method="get">  
    视频标题：
    <input type="text" name="rolename" id="rolename"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <a href="<?php echo U('Admin/Video/addVideo');?>" type="button" class="btn btn-success various" data-fancybox-type="iframe">新增视频</a>
</form>
  <table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="10%">视频标题</th>
        <th width="24%">视频介绍</th> 
        <th width="24%">视频Flash地址</th>
        <th width="8%">是否有效</th>
        <th width="8%">标签</th>
        <th width="8%">发布人</th>
        <th width="8%">发布时间</th> 
        <th width="10%">操作</th>
    </tr>
    </thead>
	     <?php if(is_array($video)): foreach($video as $key=>$v): ?><tr>
                <td><?php echo ($v["title"]); ?></td>
                <td><?php echo ($v["content"]); ?></td>
                <td><?php echo ($v["url"]); ?></td>
                <td><?php if($v["effective"]): ?>开启<?php else: ?>关闭<?php endif; ?></td>
                <td><?php echo ($v["category"]); ?></td>
                <td><?php echo ($v["releaser"]); ?></td> 
                <td><?php echo ($v["releaser_time"]); ?></td>
                <td>
                    <a href="<?php echo U('Admin/Video/editVideo',array('id'=>$v['id']));?>" class="various" data-fancybox-type="iframe">修改</a>
                    &nbsp;&nbsp;&nbsp;
                    <a class="del" delid="<?php echo ($v['id']); ?>">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
    </table>
<script>
$(document).ready(function(){
    $(".various").fancybox({
      maxWidth  : 800,
      maxHeight : 600,
      fitToView : false,
      width   : '50%',
      height    : '87%',
      autoSize  : false,
      closeClick  : true,
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      openSpeed  : 150,
      closeSpeed  : 150,
      scrolling : 'no',
      preload   : true
      
    });
    $(".del").click(function(){
      var delid = $(this).attr("delid");
      $.post("<?php echo U('Admin/Video/delVideo');?>",{delid:""+delid+""},function(status){
        if(status){
          var d = dialog({
                                content: '恭喜，删除成功咯;-)'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 2000);
                            location.reload();

        }else{
          var d = dialog({
                                content: '哎呀，删除失败啦-_-!'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 2000);

        }

      })
    });
});
</script>
</body>
</html>