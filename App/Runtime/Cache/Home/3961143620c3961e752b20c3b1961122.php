<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap3/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap3/css/bootstrap-theme.min.css" />
     <!--jquery资源引入-->
  <script type="text/javascript" src="__PUBLIC__/lib/jquery-1.8.1.min.js"></script>
  <!--弹出对话框-->
    <link rel="stylesheet" href="__PUBLIC__/artDialog/css/ui-dialog.css">
    <script src="__PUBLIC__/artDialog/dist/dialog-plus.js"></script>
    <!-- 表单体交 -->
    <script type="text/javascript" src="__PUBLIC__/lib/jquery.form.js"></script>
    <style>
    .wrap{
    	width:700px;
    	margin: 0 auto;
      margin-top: 20px;

    }
    </style>
</head>
<body>
<div class="wrap">
<div class="page-header">
  <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;用户注册<small style="float:right;">党员发展评估系统</small></h1>
</div>
  <div class="panel panel-primary ">
      <div class="panel-heading">通过邮箱注册</div>
      <div class="panel-body">
      <center>
    <form class="form-inline">
    <div class="form-group">
      <label  for="exampleInputName2">邮箱号</label>&nbsp;&nbsp;
      <input type="email" class="form-control" id="email" placeholder="请输入邮箱号">
    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" id="register" class="btn btn-default">发送激活链接</button>
    </form>
    </center>
  </div>
  </div>
 
<script>
 $(document).ready(function(){
        //发送密码重置邮件
        $("#register").click(function(){
        if($("#email").val()!=''){
             //正在发送对话框
                 var dosave = dialog({content: '正在发送邮件，请稍等下啊-)'});
                     dosave.show();
                $.ajax({
                  type:'post',
                  dataType:'json',
                  url:'<?php echo U("Home/Login/emailregisterHandle");?>',
                  data:{'type':'find','email':$("#email").val()},
                  success:function(data){
                    dosave.close().remove();
                    if(data == 'sended'){
                      var d = dialog({
                                content: '恭喜，邮件发送成功咯,快去登陆邮箱查看吧;-)'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                                window.location.href="http://www.hao123.com/mail";
                            }, 3000); 
                    }else if(data == 'sendfail'){
                       var d = dialog({
                                content: '哎呀，邮件发送失败啦 -_-!,请检查你的邮箱格式，否则请联系管理员检查SMTP配置'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 3000);
                    }else if(data == 'hademail'){
                      var d = dialog({
                                content: '这个邮箱已经被用嘞，换一个呗'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 3000);
                    }else if(data == 'dbfail'){
                       var d = dialog({
                                content: '数据库操作失败'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 3000);
                    }else{
                      var d = dialog({
                                content: '天啊，我也不知道哪儿出错啦！-+=-！@#￥%'
                            });
                            d.show();
                            setTimeout(function () {
                                d.close().remove();
                            }, 3000);
                    }
                  }
                });
        }else{
          var d = dialog({ content: '你没有写自己的邮箱啊 -_-!,我都不知道该发给谁'});
              d.show();
              setTimeout(function () {
                d.close().remove();
              }, 3000);
        }
      });


 });
</script>
</body>
</html>