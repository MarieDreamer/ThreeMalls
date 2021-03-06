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
                        <h2><div  class="col-sm-2"></div>修改类目</h2>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">pid</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="pid" value="<?php echo $result['pid'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品类别名称</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="name" value="<?php echo $result['name'];?>"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品类别介绍</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="introduce" value="<?php echo $result['introduce'];?>"/>
                            </div>
                        </div>
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">类别图片上传：</label>
                                <div class="col-sm-10">
                                    <div id="file_upload" >
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="form-horizontal" id="step2">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">当前图片：<br>(上传图片将覆盖原有图片)</label>
                                    <div class="col-sm-10">
                                            <img style="height: 200PX;" src="<?php echo $result['category_img']?>" alt="<?php echo json_decode($result['category_img'],true) ?>">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        
                        
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Category/listspid?id=<?php echo $result['pid'];?>"><button class="btn btn-white" type="button">取消</button></a>
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
    var image_url="<?php echo $result['category_img']?>";
     $('#file_upload').diyUpload({
        url:'/Commodity/upload_do',
        success:function( data ) {
            console.log(data);
            image_url=data._raw;
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
    $("#adds").click(function(){
    });
    $(document).on('click','#adds',function(){
        // alert(1);
        var id=$('#id').val();
        var pid=$('#pid').val();
        var name=$('#name').val();
        var introduce=$('#introduce').val();
        
        $.ajax({
            url:'/Category/raedit_do2', 
            data:{
                "id":id,
                "pid":pid,
                "name":name,
                "category_img":image_url,
                "introduce":introduce

            },
            type:'post',
            dataType:"json",
            success:function(data){
                if(data.status){
                    
                    alert('编辑成功');
                    window.location="/Category/lists";
                }else{
                    alert(data.message)
                }
            }
        });
    })
</script>
</body>
</html>