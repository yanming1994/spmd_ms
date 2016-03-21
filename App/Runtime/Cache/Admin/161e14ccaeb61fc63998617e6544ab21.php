<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>表格单元格编辑</title>
<!-- 此文件为了显示Demo样式，项目中不需要引入 -->
 <link href="__PUBLIC__/bui-bootstrap/assets/css/bs3/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/bui-bootstrap/assets/css/bs3/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="__PUBLIC__/bui-bootstrap/assets/css/page-min.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
  <div class="demo-content">
    
    <form id="searchForm" action="<?php echo U('Admin/Assess/gridShow');?>" method="post" target="query-show" class="form-horizontal well">
      <table>
      <tr>
            
            <td>
            <input type="hidden" name="search" value='1'></input>
                <select name="entrance">
                    <option value="-1">所有年级</option>
                    <?php if(is_array($entranceRange)): foreach($entranceRange as $key=>$v): ?><option value="<?php echo ($v); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
                </select>
                <select name="time">
                    <option value="-1">所有学期</option>
                    <option value="1">第1学期</option>
                    <option value="2">第2学期</option>
                    <option value="3">第3学期</option>
                    <option value="4">第4学期</option>
                    <option value="5">第5学期</option>
                    <option value="6">第6学期</option>
                    <option value="7">第7学期</option>
                    <option value="8">第8学期</option>
                    
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
                <option value="-1" <?php if($userinfo['class']==null): ?>selected="selected"<?php endif; ?> class="stay">所有班级</option>
                    <?php if(is_array($class)): foreach($class as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"<?php if($userinfo['class']==$v['name']): ?>selected="selected"<?php endif; ?>><?php echo ($v['name']); ?></option><?php endforeach; endif; ?>
                </select>&nbsp;&nbsp;<?php endif; ?>
            </td>
            <td>
            
            <a style="margin-left:30px;" id="btnSearch" class="button button-primary">搜索</a>
          
          </td>
      </tr>
  </table>
        
      </div>
    </form>
    <div class="row">
      <div class="span16">
        <div id="grid">
          
        </div>
      </div>
    </div>

    <p class="row">
     <center> <button type="sumbmit" id="btnSave" class="button button-primary">提交</button>
     </center>
    </p>
    
 
  <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/bui-bootstrap/assets/js/config-min.js"></script>
    <script type="text/javascript">
        BUI.use(['bui/grid','bui/data','bui/form'],function(Grid,Data,Form){
          var 
          college = $("[name='college']").val(),
          major = $("[name='major']").val(),
          classes = $("[name='class']").val(),
          entrance = $("[name='entrance']").val(),
          time = $("[name='time']").val(),
          Store = Data.Store,
          enumObj = {"1" : "选项一","2" : "选项二","3" : "选项三"},
          columns = [<?php echo ($tr); ?>],
          data = [];
        function valid(value){
          if(value === '1'){
            return '不能选择1';
          }
        }
        var editing = new Grid.Plugins.CellEditing({
          triggerSelected : false //触发编辑的时候不选中行
        }),
          store = new Store({
            url : '<?php echo U('Admin/Assess/gridShow');?>',
            autoLoad:true,
            
            params : {         //设置请求时的参数
                type : '1'
              },
            sortInfo : {
              field : 'a',
              direction : 'ASC' //升序ASC，降序DESC
            },  
            remoteSort: true  // 开启异步排序
          }),
          grid = new Grid.Grid({
            render:'#grid',
            columns : columns,
             loadMask: true,
            width : '1000',
            forceFit : true,
            /*tbar:{ //添加、删除
                items : [{
                  btnCls : 'button button-small',
                  text : '<i class="icon-plus"></i>添加',
                  listeners : {
                    'click' : addFunction
                  }
                },*/
          
            plugins : [editing],//,Grid.Plugins.CheckSelection
            store : store
          });
 
        grid.render();
 
        
        
        function validFn (value,obj) {
          var records = store.getResult(),
            rst = '';
          BUI.each(records,function (record) {
            if(record.a == value && obj != record){
              rst = '文本不能重复';
              return false;
            }
          });
          return rst;
        }
 
       /* //添加记录
        function addFunction(){
          var newData = {b : 0};
          store.addAt(newData,0);
          editing.edit(newData,'a'); //添加记录后，直接编辑
        }
        */
       
        $('#btnSave').on('click',function(){
             var r = confirm("确定保存修改？");
             if(r == true){
                  if(editing.isValid()){ //判断是否通过验证，如果在表单中，那么阻止表单提交
                    var records = store.getResult();
                      $.ajax({
                    url : '<?php echo U('Admin/Assess/gridSaveHandle');?>',
                    dataType : 'json',
                    type : 'post',
                    data : {records : records,type:1},
                    success : function(data){
                      if(data<0){ //操作成功
                        store.load();
                        BUI.Message.Alert('保存成功');
                      }else{ //操作失败
                        BUI.Message.Alert('操作失败！');
                      }
                    }
                }); 
              }else{
                return false;
              }
             }else{

             }

          }); 
          //搜索表单处理
         $('#btnSearch').on('click',function(){
           
          college = $("[name='college']").val();
          major = $("[name='major']").val();
          classes = $("[name='class']").val();
          entrance = $("[name='entrance']").val();
          time = $("[name='time']").val();
          //重新加载数据
         store.load({college:college,major:major,classes:classes,entrance:entrance,time:time,type : '1',search:'1'});
         //store.load();
         });
        

       


      });

      
   //选择了学院后的动作
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

    </script>
<!-- script end -->
  </div>
</body>
</html>