<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content=cetial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>后台</title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link href="/Css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Css/animate.min.css" rel="stylesheet">
    <link href="/Css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="/Css/paging.css" rel="stylesheet">

</head>
<body>
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        
        <div class="ibox-content">
            <div class="row row-lg">
                <div class="col-sm-12">
                    <!-- Example Toolbar -->
                    <div class="example-wrap">
                        <div class="example">
                            <div class="btn-group" role="group">
                                <a href="/Disease/adds" class="btn btn-outline btn-default">
                                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 添加病理
                                </a>
                            </div>
                            <h1>病理管理</h1>
                            <table data-toggle="table" class="table table-hover"  data-mobile-responsive="true">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th align="center">名称</th>
                                        <th align="center">首字母</th>
                                        <th align="center">科室</th>
                                        <th align="center">身体部位</th>
                                        <th align="center">简介</th>
                                        <th align="center">创建时间</th>

                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if(is_array($results)): $i = 0; $__LIST__ = $results;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="sid_user" rel="<?php echo ($vo['id']); ?>">
                                        <td class="id"><?php echo ($vo['id']); ?></td>
                                        <td><?php echo ($vo['name']); ?></td>
                                        <td><?php echo ($vo['first_letter']); ?></td>
                                        <td><?php echo ($vo['department']); ?></td>
                                        <td><?php echo ($vo['body_position']); ?></td>
                                        <td><?php echo ($vo['summarize']); ?></td>
                                        <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                                        <td>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="/Disease/raedit?id=<?php echo ($vo['id']); ?>">编辑</a>
                                            <a href="/Disease/raeditdrug?id=<?php echo ($vo['id']); ?>">药品管理</a>
                                            <!-- <a href="/Department/adds2?id=<?php echo ($vo['id']); ?>">添加子科室</a> -->
                                            <!-- <a href="/Department/listspid?id=<?php echo ($vo['id']); ?>">查看</a> -->
                                            <a title="删除" class="btnDel">删除</a>&nbsp;&nbsp;&nbsp;
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                           <div class="paggings">
                           <?php echo ($paging); ?>
                        </div>
                    </div>
                </div>    
                    <!-- End Example Toolbar -->
                </div>
            </div>
        </div>
        
    </div>
    
</div> 
<div class="modal fade" id="ajax_container" tabindex="-1" role="dialog" aria-labelledby="ajax_container" aria-hidden="true"> 
</div>
<script src="/Js/jquery.min.js?v=2.1.4"></script>
<script src="/Js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).on('click','.btnDel',function(){
        if(confirm("确定要删除吗？")){
            var id=$(this).parent().siblings('.id').text();
            $.ajax({
                url:'/Disease/dele_do', 
                data:{
                    "id":id,
                },
                type:'get',
                dataType:"json",
                success:function(data){
                    // alert(data);
                    if(data.status){
                        alert('删除成功');
                        window.location="/Disease/lists";
                    }else{
                        alert(data.message)
                    }
                },
            });
        }
    })
    
</script>
</body>