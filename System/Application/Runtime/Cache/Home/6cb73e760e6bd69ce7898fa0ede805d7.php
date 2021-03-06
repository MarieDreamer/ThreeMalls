<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>医疗管理系统</title>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="/Css/login.css" />
	<script src="/Js/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<section id="content">
			<div class="button" style="font-size:22px;">
				医疗管理系统
			</div> 
			<form id="login_form">
				<h1>后台登录</h1>
				<div>
					<input type="text" placeholder="账号" name="account" id="account" />
				</div>
				<div>
					<input type="password" placeholder="密码" name="password" id="password" />
				</div>
				<div>
					<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>
				</div> 
				<div>
					<input type="button" value="登 录" class="btn" id="js-btn-login"/>
				</div>
			</form>
		</section>
	</div>

	<script>
	
	$(function(){
		$('#js-btn-login').bind('click',function(){
			var account=$('#account').val();
			var password=$('#password').val();
			//validate
			var account_rule = new RegExp(/^\w{6,20}$/);
			if(!account_rule.test(account)){
				$('#account').val('');
				$('#account').focus();
				return ;
			}

			var password_rule = new RegExp(/^.{6,20}$/);
			if(!password_rule.test(password)){
				alert('请输入6-20位长度密码');
				$('#password').val('');
				$('#password').focus();
				return ;
			}

			//request
			$.post('/EmployeeSystem/login_do', $("form").serialize(),function(response){
	            if(response.status=='1'){
	            	// console.log(response);
	            	alert('登陆成功');
					location.href=response.login_success_request_url;
	            }else{
	            	alert(response.message);
	            }
        	});
		});
	})
	</script>
</body>


</html>