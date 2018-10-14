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
                        <h2><div  class="col-sm-2"></div>修改商品</h2>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品名称</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="shop_name" value="<?php echo $result['shop_name'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品编号</label>
                            <div class="col-sm-8"> 
                                <input type="text" size="30" size="80" minlength="6" maxlength="60" class="form-control"  id="shop_id" value="<?php echo $result['shop_id'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品总数</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="shop_num" value="<?php echo $result['shop_num'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">已销售商品数</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="shop_sale" value="<?php echo $result['shop_sale'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品详细</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="shop_introduce" value="<?php echo $result['shop_introduce'];?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">商品价格</label>
                            <div class="col-sm-8">
                                <input type="text" size="30"  size="80" minlength="6" maxlength="60" class="form-control"  id="shop_price"  value="<?php echo $result['shop_price'];?>"/>
                            </div>
                        </div>
                        
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">封面图片上传:<br>(最多三张,重新上传图片将全部被覆盖)：</label>
                                <div class="col-sm-10">
                                    <div id="file_upload" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">当前封面：</label>
                                <div class="col-sm-10">
                                        <?php
 $urls=json_decode($result['shop_index_image'],true); foreach ($urls as $key => $value) { ?>
                                        <a href="<?php echo ($value); ?>" target="_blank"><img  class="shop_index_images" style="height: 100px;"  src="<?php echo ($value); ?>"></a>
                                        <?php
 } ?>
                                </div>
                            </div>
                        </div>
                            

                        </volist>
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">内容图片上传：<br>(重新上传图片将全部被覆盖)</label>
                                <div class="col-sm-10">
                                    <div id="img_upload" ></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal" id="step2">
                            <div class="form-group">
                                <label class="control-label col-sm-2">当前内容图片：</label>
                                <div class="col-sm-10">
                                        <?php
 $urls=json_decode($result['shop_image'],true); foreach ($urls as $key => $value) { ?>
                                    <a href="<?php echo ($value); ?>" target="_blank"><img class="shop_images" style="height: 100px;"  src="<?php echo ($value); ?>"></a>
                                    <?php
 } ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">选择商城</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="mail_id" >
                                    <option value ="0">请选择</option>    
                                    <option value ="1">food</option>
                                    <option value ="2">kuose</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group leibie" style="display: none;">
                            <label class="col-sm-2 control-label">选择类别</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="categoryid" >
                                    <option value ="0">请选择</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group pidleibie" style="display: none;">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <select class="form-control" id="categorypid" >
                                    <option value ="0">请选择</option>
                                </select>
                            </div>
                        </div>



                        <!-- <div class="form-group rem" attr_value='1' >
                            <label class="col-sm-2 control-label">重新选择商品类别：</label>
                            <div class="col-sm-8">
                                    <select class="form-control category categoryid" >
                                        <option value ="-1">请选择</option>
                                        <?php foreach ($category as $key => $value) {?>
                                        <option class="op" value ="<?php echo $value['id'];?>">
                                        <?php echo $value['name'];?>
                                        </option>
                                    <?php } ?>
                                    </select>
                            </div>
                        </div> -->
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Commodity/lists"><button class="btn btn-white" type="button">取消</button></a>
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
<script type="text/javascript" src="/Js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/Js/diyUpload.js"></script>
<script type="text/javascript">
     $(document).on('change','#mail_id',function(){
        var checkText=$("#mail_id").find("option:selected").text(); 
        var checkValue=$("#mail_id").val();
        if(checkValue!=0){
            $.ajax({
                url:'/Category/listsmail_id', 
                data:{
                    "mail_id":checkValue,
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data.lists)
                    if(data.lists){
                        $('.leibie').show();
                        var listsmail_idsnumber = (data.lists.length);
                        var classhtml='';
                        var classhtml0= '';
                        for (var i=0; i<listsmail_idsnumber; i++){
                            console.log(i);
                            classhtml = classhtml
                            +'<option value ="'+data.lists[i].id+'">'+data.lists[i].name+'</option>'
                        }
                        classhtml0 = classhtml0
                        +'<option value ="0">请选择</option>'
                        $("#categoryid").html(classhtml0+classhtml)
                    }else{
                        $('.leibie').hide();
                        $('.pidleibie').hide();
                    }
                },
            });
        }else{
            $('.leibie').hide();
            $('.pidleibie').hide();
        }
    });

    $(document).on('change','#categoryid',function(){
        var checkText=$("#categoryid").find("option:selected").text(); 
        var checkValue=$("#categoryid").val();

        if(checkValue!=0){

            $.ajax({
                url:'/Category/listscategory_id', 
                data:{
                    "category_id":checkValue,
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data.lists)
                    if(data.lists){
                        $('.pidleibie').show();
                        var listsmail_idsnumber = (data.lists.length);
                        var classhtml='';
                        var classhtml0= '';
                        for (var i=0; i<listsmail_idsnumber; i++){
                            console.log(i);
                            classhtml = classhtml
                            +'<option value ="'+data.lists[i].id+'">'+data.lists[i].name+'</option>'
                        }
                        classhtml0 = classhtml0
                        +'<option value ="0">请选择</option>'
                        $("#categorypid").html(classhtml0+classhtml)
                    }else{
                        $('.pidleibie').hide();
                    }
                },
            });

        }else{
            $('.pidleibie').hide();
        }
    });

    $(document).on('change','.category',function(){
        var that=$(this)
        var attr_value=that.parent().parent('.form-group').attr('attr_value');
        console.log(attr_value);
        
        $(".rem").each(function(){
            attrvalue=$(this).attr("attr_value");
            // console.log(attrvalue);
            if (attrvalue>attr_value) {
                $(this).remove();
            };
        });
        var category_id=$(this).val();
        // console.log(category_id);
        attr_value++;
        $.ajax({
            url:'/Category/get_do', 
            data:{
                "category_id":category_id
            },
            type:'post',
            dataType:"json",
            success:function(data){
                if(data.status){
                    if (data.results) {
                        console.log(data);
                        var html_de='<div class="form-group rem" attr_value='+attr_value+'><label class="col-sm-2 control-label"></label><div class="col-sm-8"><select class="form-control category categorypid"><option value ="0">请选择</option>';
                        for (var i = 0; i < data.results.length; i++) {
                            html_de+='<option class="op" value ="'+data.results[i].id+'">'+data.results[i].name+'</option>'
                        }
                        html_de+='</select></div></div>';
                        that.parent().parent('.form-group').after(html_de);
                    }
                }else{
                    
                } 
            },
        });
    })
    var image_url=[];
    var img_url=[];
    var image_urls=[];
    var img_urls=[];
    $('.shop_index_images').each(function(){
        // alert($(this).text())
        console.log($(this).attr('src'));
        image_url.push($(this).attr('src'));
    });
    console.log(image_url);
    
    $('.shop_images').each(function(){
        // alert($(this).text())
        console.log($(this).attr('src'));
        img_url.push($(this).attr('src'));
    });
    console.log(img_url);
    

    
    $('#file_upload').diyUpload({
        url:'/Commodity/upload_do',
        success:function( data ) {
            image_urls.push(data._raw);
            console.log(image_urls);
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
        url:'/Commodity/upload_do',
        success:function( data ) {
            img_urls.push(data._raw);
            console.log(img_urls);
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
        var mail_id=$("#mail_id").val();
        var pid=$('#categoryid').val();
        var shop_type=$('#categorypid').val();
        var id=$('#id').val();
        var shop_name=$('#shop_name').val();
        var shop_id=$('#shop_id').val();
        var shop_num=$('#shop_num').val();
        var shop_sale=$('#shop_sale').val();
        var shop_introduce=$('#shop_introduce').val();
        var shop_price=$('#shop_price').val();
        var mail_id=$('#mail_id').val();


        if(!shop_type){
            shop_type = 0;
        }
        var fmtp = '';
        var nrtp = '';
        if(image_urls.length){
            fmtp = image_urls
        }else{
            fmtp = image_url
        }

        if(img_urls.length){
            nrtp = img_urls
        }else{
            nrtp = img_url
        }

        if(!shop_type){
            shop_type = 0;
        }
        if(shop_type == 0){
            shop_typesend=0;
        }else{
            shop_typesend = shop_type;
        }
        
        if(mail_id==0){
            alert("请选择商城类型")
        }else{
            $.ajax({
                url:'/Commodity/raedit_do', 
                data:{
                    "mail_id":mail_id,
                    "id":id,
                    "image_url":fmtp,
                    "img_url":nrtp,
                    "pid":pid,
                    "shop_name":shop_name,
                    "shop_id":shop_id,
                    "shop_type":shop_typesend,
                    "shop_num":shop_num,
                    "shop_sale":shop_sale,
                    "shop_introduce":shop_introduce,
                    "shop_price":shop_price,

                },
                type:'post',
                dataType:"json",
                success:function(data){
                    if(data.status){
                        
                        alert('编辑成功');
                        window.location="/Commodity/lists";
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