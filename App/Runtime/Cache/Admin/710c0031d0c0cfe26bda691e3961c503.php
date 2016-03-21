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
    用户名称：
    <input  type="text" name="search"class="abc input-default" placeholder="请输入用户名/学号/姓名">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; 
    <a href="<?php echo U('Admin/Rbac/addUser');?>" type="button" class="btn btn-success various" id="addnew" data-fancybox-type="iframe">新增用户</a>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>用户id</th>
        <th>用户名称</th>
        <th>学号</th>
        <th>真实姓名</th>
        <th>邮箱</th>
        <th>角色</th>  
        <th>最后登录时间</th>
        <th>是否锁定</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["username"]); ?></td>
            <td><?php echo ($v["number"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php echo ($v["email"]); ?></td>
            <td>
              <ul>
                  <?php if($v["username"] == C("RBAC_SUPERADMIN")): ?><li>超级管理员</li>
                  <?php else: ?>
                        <?php if(is_array($v["role"])): foreach($v["role"] as $key=>$r): ?><li><?php echo ($r["name"]); ?>(<?php echo ($r["remark"]); ?>)</li><?php endforeach; endif; endif; ?>
              </ul>
               
            </td>
            <td><?php echo (date("Y-m-d H:i:s",$v["logintime"])); ?></td>
            <td>
                <?php if($v['lock']): ?>是<?php else: ?>否<?php endif; ?>
            </td>
            <td>
                <a class="various" data-fancybox-type="iframe" href="<?php echo U('Admin/Rbac/editUser');?>?uid=<?php echo ($v['id']); ?>">编辑</a> &nbsp;&nbsp;
                <a userid="<?php echo ($v['id']); ?>" class="del">删除</a>              
            </td>
        </tr><?php endforeach; endif; ?>	
</table>
</body>
</html>
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
       var userid = $(this).attr("userid");
      var d = dialog({
        title: '提示',
        content: '确定要删除？？',
        okValue: '确定',
        ok: function () {
                $.post("<?php echo U('Admin/Rbac/delUser','','');?>",{uid:""+userid+""},function(status){
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