<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>个人中心</title>
	<!--jquery资源引入--><!-- 
  <script type="text/javascript" src="__PUBLIC__/lib/jquery-1.10.1.min.js"></script> -->
  <!--bootstrap3资源引入-->
	
<!--fancybox资源引入-->
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/fancybox/source/jquery.fancybox.css" />
  <script type="text/javascript" src="__PUBLIC__/fancybox/source/jquery.fancybox.pack.js"></script>
  <script type="text/javascript" src="__PUBLIC__/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<!-- <script type="text/javascript" src="__PUBLIC__/bootstrap3/js/bootstrap.min.js"></script> -->
	<link href="__PUBLIC__/bui-bootstrap/assets/css/bs3/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/bui-bootstrap/assets/css/bs3/bui.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/bui-bootstrap/assets/css/page-min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/bootstrap3/css/bootstrap.min.css" />
	<style>
	body{
			width: 800px;
			margin: 0 auto;
      		height: auto;
		}
	.bui-grid-hd-inner{
		overflow: visible;
	}
	tr th {
		height: 40px;
	}
	</style>
</head>
<body>
<div class="container-fluid">
<div class="page-header">
  <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;个人中心 <small style="float:right;"> 党员发展评估系统</small></h1>
</div>
	<div class="row">
	  <div class="col-md-2">
		  <ul class="nav nav-pills nav-stacked">
		  <li role="presentation"><a href="<?php echo U('Index/Index/index');?>">主页</a></li>
		  <li role="presentation"  class="active"><a href="<?php echo U('Home/Index/index');?>">业务</a></li>
		  <li role="presentation"  ><a href="<?php echo U('Index/Video/index');?>">视频学习</a></li>
		  <li role="presentation"><a href="<?php echo U('Index/Task/activityList');?>?type=1">活动/荣誉/心得</a></li>
		  <li role="presentation" ><a href="<?php echo U('Home/Account/userinfo');?>">账户</a></li>
		 
		  </ul>

	  </div>
	  <div class="col-md-10">

	  <div class="panel panel-success">
		  <div class="panel-heading">个人任务查询</div>
		  <div class="panel-body">
		    
		       
    <form id="searchForm" action="<?php echo U('Admin/Check/checklist');?>" method="post" target="query-show" class="form-horizontal">
      
                <select name="task_comp">
                    <option value="-1">所有</option>
                    <option value="0" >待审核</option>
                    <option value="1">审核未通过</option>
                    <option value="2" selected="selected">审核通过</option> 
                </select>&nbsp;&nbsp;
                
           
            
          	<button style="margin-left:30px;" type="button" id="btnSearch" class="button button-primary">搜索</button>
        	
        
      </div>
    </form>
		   
			    <div class="search-grid-container">
			      <div id="grid"></div>
			    </div>
			  </div>   
		</div>
	  </div>
	</div>
</div>
<script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/bui-min.js"></script>
<script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/config-min.js"></script>
<script type="text/javascript">
  
  BUI.use(['common/search','common/page'],function (Search) {
    var enumObj = {"1":"C","2":"B","3":"B+","4":"A","5":"A+"},
      columns = [
          
          {title:'任务名',dataIndex:'title',width:150},
          {title:'提交时间',dataIndex:'post_time',width:100},
          {title:'审核人',dataIndex:'name',width:80},
          //
          {title:'审核时间',dataIndex:'check_time',width:100},
          {title:'审核结果',dataIndex:'check_result',width:80,renderer:BUI.Grid.Format.enumRenderer(enumObj)},
          {title:'审核意见',dataIndex:'check_feedback',width:200}
        ],
      store = Search.createStore("<?php echo U('Home/Index/userTaskList');?>"),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [BUI.Grid.Plugins.AutoFit], // 插件形式引入多选表格

      });
 
    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');
  });
$(document).ready(function(){
    $(".various").fancybox({
    padding: 5,
    openEffect : 'elastic',
    openSpeed  : 150,
    closeEffect : 'elastic',
    closeSpeed  : 150,
    closeClick : true,
    scrolling : 'no', 
    'width'       : '960px',
    'height'      : '600px',
    'autoScale'       : false,
    'transitionIn'    : 'none',
    'transitionOut'   : 'none',
    'type'        : 'iframe',
    helpers : {
          overlay : null
        },
      
    });
});
</script>
</body>
</html>