<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>CheckIndex</title>
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
        select{
        width:150px;
     }


    </style>
</head>
<body>
  <form id="query-su" action="<?php echo U('Admin/Check/activityList');?>" method="post" target="query-show">
	<table>
	    <tr>
            
            <td>
                <select name="check_comp">
                    <option value="-1">所有</option>
                    <option value="0" selected="selected">待审核</option>
                    <option value="1">审核未通过</option>
                    <option value="2">审核通过</option> 
                </select>&nbsp;&nbsp;
                <select name="entrance">
                    <option option value="-1" >所有年级</option>
                    <?php if(is_array($entranceRange)): foreach($entranceRange as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
                </select>

                <?php if($college): ?><select name="college" id="college">
                <option value="-1" >所有学院</option>
                    <?php if(is_array($college)): foreach($college as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"<?php if($userinfo['college']==$v['name']): ?>selected="selected"<?php endif; ?>><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                </select>&nbsp;&nbsp;<?php endif; ?>
                <?php if($major): ?><select name="major" id="major">
                <option value="-1"  class="stay">所有专业</option>
                    <?php if(is_array($major)): foreach($major as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                </select>&nbsp;&nbsp;<?php endif; ?>

                <?php if($class): ?><select name="class" id="class">
                <option value="-1" class="stay">所有班级</option>
                    <?php if(is_array($class)): foreach($class as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"<?php if($userinfo['class']==$v['name']): ?>selected="selected"<?php endif; ?>><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                </select>&nbsp;&nbsp;<?php endif; ?>
            </td>
            <td>
            <button class="btn btn-primary" type="submit">查询</button>
            </td>
	    </tr>
	</table>
	
  </form>
	<iframe id="query-list" name="query-show"  src="<?php echo U('Admin/Check/activityList');?>" marginheight="0" marginwidth="0" frameborder="0" scrolling="no" width="100%" height="100%" onLoad="iFrameHeight()" ></iframe>

<script>
$(document).ready(function(){
	$("select[name='college']").change(function(){
            $("#major").children().remove("[class!='stay']");
            $("#class").children().remove("[class!='stay']");
            $.post("<?php echo U('Index/Task/college','','');?>",{col:$(this).val().trim()},function(data){
                    //alert(data[0].name);
                    var circle = '' ;
                    for(var i=0;data[i]!=null;i++){
                        circle+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                    }
                    //alert(circle);
                    $("#major").append(circle);

            })
         });
    //选择了专业后的动作
        $("#major").change(function(){
            $("#class").children().remove("[class!='stay']");
            $.post("<?php echo U('Index/Task/major','','');?>",{col:$(this).val().trim()},function(data){
                    //alert(data[0].name);
                    var circle = '' ;
                    for(var i=0;data[i]!=null;i++){
                        circle+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                    }
                    //alert(circle);
                    $("#class").append(circle);

            })
        });
        $("query-su").submit(function(){

               return false; //阻止表单默认提交  

        });
        $("#open").click(function(){
            alert("qwrew");

        });
        $(".various").fancybox({
      maxWidth  : 800,
      maxHeight : 600,
      fitToView : true,
      autoScale : true,
      centerOnScroll : true,
      width   : '50%',
      height    : '87%',
      autoSize  : true,
      closeClick  : true,
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      openSpeed  : 150,
      closeSpeed  : 150,
      scrolling : 'no',
      preload   : true
      
    });
});
function iFrameHeight() {

        var ifm= document.getElementById("query-list");

        var subWeb = document.frames ? document.frames["query-show"].document :

ifm.contentDocument;

            if(ifm != null && subWeb != null) {

            ifm.height = subWeb.body.scrollHeight;

            }

    }
</script>
</body>
</html>