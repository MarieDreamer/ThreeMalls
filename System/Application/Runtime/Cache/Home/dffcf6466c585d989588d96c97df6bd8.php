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
                            
                            <h1>提现审核</h1>
                            <table data-toggle="table" class="table table-hover"  data-mobile-responsive="true">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th align="center">用户名</th>
                                        <th align="center">金额</th>
                                        <th align="center">状态</th>
                                        <th align="center">审核备注</th>
                                        <th align="center">创建时间</th>
                                        <th align="center">审核时间</th>
                                        <th align="center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if(is_array($results)): $i = 0; $__LIST__ = $results;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="sid_user" rel="<?php echo ($vo['id']); ?>">
                                        <td class="id"><?php echo ($vo['id']); ?></td>
                                        <td><?php echo ($vo['user_id']); ?></td>
                                        <td><?php echo ($vo['money']); ?></td>
                                        <td><?php echo ($vo["status_name"]); ?></td>
                                        <td><?php echo ($vo["note"]); ?></td>
                                        <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                                        <td><?php echo ($vo["review_time"]); ?></td>
                                        <td>
                                            <?php if($vo["status"] == 0){ ?>
                                                <a href="/Refund/review?id=<?php echo ($vo['id']); ?>">审核</a>
                                            <?php }else{ ?>
                                                <div style="font-size:12px">已审核</p>
                                            <?php } ?>
                                            
                                            <!-- <a title="删除" class="btnDel">删除</a>&nbsp;&nbsp;&nbsp; -->
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
    $(document).on('click','.fail',function(){
        if(confirm("确定审核失败吗？")){
            var id=$(this).parent().siblings('.id').text();
            $.ajax({
                url:'/Refund/review_do', 
                data:{
                    "id":id,
                    "status":2
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data);
                    if(data.status){
                        alert('审核成功');
                        window.location="/Refund/lists";
                    }else{
                        alert(data.message)
                    }
                },
            });
        }
    })

    $(document).on('click','.pass',function(){
        if(confirm("确定审核通过吗？")){
            var id=$(this).parent().siblings('.id').text();
            $.ajax({
                url:'/Refund/review_do', 
                data:{
                    "id":id,
                    "status":1
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data);
                    if(data.status){
                        alert('审核成功');
                        window.location="/Refund/lists";
                    }else{
                        alert(data.message)
                    }
                },
            });
        }
    })
    
</script>
</body>