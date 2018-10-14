<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>后台</title>
    <link href="/Css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Css/animate.min.css" rel="stylesheet">
    <link href="/Css/style.min.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/Css/diyUpload.css">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="form-horizontal m-t" id="commentForm">
                        <h2><div  class="col-sm-2"></div>修改优惠券</h2>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户ID</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="user_id" value="<?php echo $result['user_id'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品ID</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="shop_id" value="<?php echo $result['shop_id'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券标题</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" size="80" minlength="6" maxlength="60" class="form-control"  id="title" value="<?php echo $result['title'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券简介</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="message" value="<?php echo $result['message'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">使用状态</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="status" value="<?php echo $result['status'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券开始时间</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="effective_start_date" value="<?php echo $result['effective_start_date'];?>"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券结束时间</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="effective_end_date" value="<?php echo $result['effective_end_date'];?>"/>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">二维码</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="code_url" value="<?php echo $result['code_url'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">无序码</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="code" value="<?php echo $result['code'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">创建时间</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="create_time" value="<?php echo $result['create_time'];?>"/>
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Coupon/lists"><button class="btn btn-white" type="button">取消</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    alert($ajaxReturnData['data'])
    
</script>
<script src="/Js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript">
    $("#adds").click(function(){
    });
    $(document).on('click','#adds',function(){
        // alert(1);
        var id=$('#id').val();
        var user_id=$('#user_id').val();
        var shop_id=$('#shop_id').val();
        var title=$('#title').val();
        var message=$('#message').val();
        var status=$('#status').val();
        var effective_start_date=$('#effective_start_date').val();
        var effective_end_date=$('#effective_end_date').val();
        var code_url=$('#code_url').val();
        var code=$('#code').val();




        // console.log(album_class);
        
        $.ajax({
            url:'/Coupon/raedit_do', 
            data:{
                "id":id,
                "user_id":user_id,
                "shop_id":shop_id,
                "title":title,
                "message":message,
                "status":status,
                "effective_start_date":effective_start_date,
                "effective_end_date":effective_end_date,
                "code_url":code_url,
                "code":code

            },
            type:'post',
            dataType:"json",
            success:function(data){
                if(data.status){
                    
                    alert('编辑成功');
                    window.location="/Coupon/lists";
                }else{
                    alert(data.message)
                }
            }
        });
    })
</script>
</body>
</html>