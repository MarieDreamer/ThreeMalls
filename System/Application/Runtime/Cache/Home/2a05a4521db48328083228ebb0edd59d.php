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
                        <h2><div  class="col-sm-2"></div>添加药品</h2>
                        
                        

                        <div class="form-group">
                            <label class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="name" value="<?php echo $result['name'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">厂家</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="manufactor" value="<?php echo $result['manufactor'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最大价格</label>
                            <div class="col-sm-8">
                                <input  type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="firstprice" value="<?php echo $result['firstprice'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">最小价格</label>
                            <div class="col-sm-8">
                                <input  type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="leastprice" value="<?php echo $result['leastprice'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">文字号</label>
                            <div class="col-sm-8">
                                <input  type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="number" value="<?php echo $result['number'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">治疗疾病</label>
                            <div class="col-sm-8">
                                <textarea placeholder="<?php echo $result['treatment'];?>" rows="6" cols="30" type="text" size="30" name="class1"  size="80" minlength="6" maxlength="60" class="form-control"  id="treatment" value=""/></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">功能</label>
                            <div class="col-sm-8">
                                <textarea placeholder="<?php echo $result['effect'];?>" rows="6" cols="30" type="text" size="30" name="class1"  size="80" minlength="6" maxlength="60" class="form-control"  id="effect" value=""/></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">说明书</label>
                            <div class="col-sm-8">
                                <textarea placeholder="<?php echo $result['instructions'];?>" rows="6" cols="30" type="text" size="30" name="class1"  size="80" minlength="6" maxlength="60" class="form-control"  id="instructions" value=""/></textarea>
                            </div>
                        </div>
                        
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">封面图片上传：</label>
                                <div class="col-sm-10">
                                    <div id="file_upload" ></div>
                                </div>
                            </div>
                        </div>
                        

                        
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Drugs/lists"><button class="btn btn-white" type="button">取消</button></a>
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
    $('#file_upload').diyUpload({
        url:'/Drugs/upload_do',
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
        fileNumLimit:1,
        fileSizeLimit:500000 * 1024,
        fileSingleSizeLimit:50000 * 1024,
        accept: {}
    });


    $("#adds").click(function(){
    });

    $(document).on('click','#adds',function(){
        var name=$('#name').val();
        var manufactor=$('#manufactor').val();
        var firstprice=$('#firstprice').val();
        var leastprice=$('#leastprice').val();
        var number=$('#number').val();
        var treatment=$('#treatment').val();
        var effect=$('#effect').val();
        var instructions=$('#instructions').val();
        // console.log(album_class);
        // console.log(category_id);

        if(image_url[1]){
            alert("只能上传一张图片")
        }else{
            $.ajax({
                url:'/Drugs/adds_do', 
                data:{
                    "drugsimg":image_url,
                    "name":name,
                    "manufactor":manufactor,
                    "firstprice":firstprice,
                    "leastprice":leastprice,
                    "number":number,
                    "treatment":treatment,
                    "effect":effect,
                    "instructions":instructions
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    if(data.status){
                        
                        alert('添加成功');
                        // window.location="/Drugs/lists";
                    }else{
                        alert(data.message)
                    }
                }
            });
        }
        
        
    })
</script>
</body>
</html>