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
</head>
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
<form class="form-inline definewidth m20" action="role.html" method="get">  
    角色名称：
    <input type="text" name="rolename" id="rolename"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <a href="<?php echo U('Admin/Rbac/addRole');?>" type="button" class="btn btn-success various" data-fancybox-type="iframe">新增角色</a>
</form>
  <table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>角色id</th>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>状态</th>
        <th width="20%">操作</th>
    </tr>
    </thead>
	     <?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
                <td><?php echo ($v["id"]); ?></td>
                <td><?php echo ($v["name"]); ?></td>
                <td><?php echo ($v["remark"]); ?></td>
                <td>
                    <?php if($v["status"]): ?>开启<?php else: ?>关闭<?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo U('Admin/Rbac/access',array('rid'=>$v['id']));?>" class="various" data-fancybox-type="iframe">配置权限</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?php echo U('Admin/Rbac/manage',array('rid'=>$v['id']));?>" class="various" data-fancybox-type="iframe">管理范围</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?php echo U('Admin/Rbac/editRole',array('rid'=>$v['id']));?>" class="various" data-fancybox-type="iframe">修改</a>
                    &nbsp;&nbsp;&nbsp;
                    <a roleid="<?php echo ($v['id']); ?>" class="del">删除</a>
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
      height    : '80%',
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
       var roleid = $(this).attr("roleid");
      var d = dialog({
        title: '提示',
        content: '确定要删除？？',
        okValue: '确定',
        ok: function () {
                $.post("<?php echo U('Admin/Rbac/delRole','','');?>",{id:""+roleid+""},function(status){
                    if(status){
                        var d = dialog({
                                            content: '恭喜，删除成功咯;-)'
                                        });
                                        d.show();
                                        setTimeout(function () {
                                            d.close().remove();
                                            location.reload();
                                        }, 2000);
                                        
                    }else{
                        var d = dialog({
                                            content: '哎呀，删除失败啦-_-!'
                                        });
                                        d.show();
                                        setTimeout(function () {
                                            d.close().remove();
                                        }, 2000);
                    }

                });
            return;
        },
        cancelValue: '取消',
        cancel: function () {}
    });
    d.show();
        

    });
});
</script>
</body>
</html>