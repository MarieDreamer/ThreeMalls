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

</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                	<div class="form-horizontal m-t" id="commentForm">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">当前密码：</label>
                            <div class="col-sm-8">
                                <input type="password" name="password_c" class="form-control" minlength="6" maxlength="20" placeholder="字母、数字、下划线 6-20位" id="password_c"/>
                            </div>
                        </div>
                       	<div class="form-group">
                            <label class="col-sm-2 control-label">新设密码：</label>
                            <div class="col-sm-8">
                                <input type="password" name="password_n" class="form-control" minlength="6" maxlength="20" placeholder="字母、数字、下划线 6-20位" id="password_n"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">确认密码：</label>
                            <div class="col-sm-8">
                                <input type="password" name="password_repeat" class="form-control" minlength="6" maxlength="20" placeholder="字母、数字、下划线 6-20位" id="password_repeat"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" id="password_edit">提交</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
</div>

<script src="/Js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript">
    $(document).on('click','#password_edit',function(){
        var password_c=$('#password_c').val();
        var password_n=$('#password_n').val();
        var password_repeat=$('#password_repeat').val();
        /*if(password_n != password_repeat){
            alert('输入密码不一致，请重新输入');
            return;
        }*/
        $.ajax({
            url:'/EmployeeSystem/password_edit_do', 
            data:{
                'password_c':password_c,
                'password_n':password_n,
                'password_repeat':password_repeat
            },
            type:'post',
            dataType:"json",
            success:function(data){
                if(data.status){
                    alert('修改成功');
                    window.location="/EmployeeSystem/password_edit";
                }else{
                    alert(data.message)
                }
            },
        });
    })
</script>
</body>
</html>