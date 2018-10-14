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
                        <h2><div  class="col-sm-2"></div>添加商品</h2>
                        
                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">url</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="url"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">类型</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" size="80" minlength="6" maxlength="60" class="form-control"  id="class2" />
                            </div>
                        </div>
                        
                        
<!-- 
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">封面图片上传(最多三张)：</label>
                                <div class="col-sm-10">
                                    <div id="file_upload" ></div>
                                </div>
                            </div>
                        </div>
                         -->
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">图片上传：</label>
                                <div class="col-sm-10">
                                    <div id="img_upload" ></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Broadcastimg/lists"><button class="btn btn-white" type="button">取消</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // alert($ajaxReturnData['data'])
    
</script>
<script src="/Js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript" src="/Js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/Js/diyUpload.js"></script>
<script type="text/javascript">

    var image_url=[];
    var img_url=[];
    $('#file_upload').diyUpload({
        url:'/Broadcastimg/upload_do',
        success:function( data ) {
            image_url.push(data._raw);
            console.log(image_url);
        },
        error:function( err ) {
            console.info( err );    
        },
        buttonText : '选择文件',
        chunked:true,
        // 分片大小
        chunkSize:1024 * 1024,
        //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
        fileNumLimit:3,
        fileSizeLimit:500000 * 1024,
        fileSingleSizeLimit:50000 * 1024,
        accept: {}
    });

    $('#img_upload').diyUpload({
        url:'/Broadcastimg/upload_do',
        success:function( data ) {
            img_url.push(data._raw);
            console.log(img_url);
        },
        error:function( err ) {
            console.info( err );    
        },
        buttonText : '选择文件',
        chunked:true,
        // 分片大小
        chunkSize:1024 * 1024,
        //最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
        fileNumLimit:50,
        fileSizeLimit:500000 * 1024,
        fileSingleSizeLimit:50000 * 1024,
        accept: {}
    });

    $(document).on('click','#adds',function(){
        var url=$('#url').val();
        var class2=$('#class2').val();

        $.ajax({
            url:'/Broadcastimg/adds_do', 
            data:{
                "url":url,
                "img":img_url,
                "class2":class2,

            },
            type:'post',
            dataType:"json",
            success:function(data){
                if(data.status){
                    
                    alert('添加成功');
                    window.location="/Broadcastimg/lists";
                }else{
                    alert(data.message)
                }
            }
        });
    })
</script>
</body>
</html>