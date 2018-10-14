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
                        <h2><div  class="col-sm-2"></div>药品管理</h2>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">药品搜索</label>
                            <div class="col-sm-8">
                                <input type="text" size="30" name="class1" size="80" minlength="6" maxlength="60" class="form-control"  id="drugsname" value=""/>
                                <div style="height: 20px;"></div>
                                <button id="drugssearch" type="submit" class="btn btn-primary">查询</button>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">搜索结果</label>
                            <div  class="col-sm-8">
                                <div id="ssover" class="form-contro">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div  class="col-sm-8">
                                <div  class="form-contro">
                                    <div style="border-top:1px solid #000"></div>
                                </div>
                            </div>
                        </div>

                        <div class="chazaoid" class="form-group">
                            <label class="col-sm-2 control-label">选择</label>
                            <div  class="col-sm-8">
                                <div class="form-contro sschoice">
                                </div>

                            </div>
                        </div>

                        
                        
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <input type="hidden" id='id' value="<?php echo I('param.id');?>">
                                <button class="btn btn-primary" type="button" id="adds">提交</button>
                                <a href="/Disease/lists"><button class="btn btn-white" type="button">取消</button></a>
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

    $(function(){ 
        var id=$('#id').val();
        $.ajax({
            url:'/Disease/diseaselists', 
                data:{
                    "id":id,
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    // console.log(data.diseaselists[0].id);
                    // console.log(data.diseaselists[0].name);
                    // console.log(data.diseaselists.length);
                    let choicetext='';
                        // console.log(data.diseaselists.length);
                    if(data.diseaselists[0]){
                        for (var i=0; i<data.diseaselists.length; i++){
                        

                            choicetext = choicetext
                            +'<div type="submit" class="btn btn-primary xzname" attr_value="'+data.diseaselists[i].id+'">'
                            +data.diseaselists[i].name
                            +'</div> '
                            // console.log(choicetext);
                            
                        }
                        $(".sschoice").after(choicetext);
                    }
                    
                }
            });
    }); 
    

    $("#drugssearch").click(function(event) {
        // alert('2321321321321');
        var drugsname=$("#drugsname").val();
        console.log(drugsname);
        if(drugsname){
            $.ajax({
            url:'/Drugs/drugslists', 
                data:{
                    "name":drugsname,
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data.drugslists);
                    let drugstext='';
                    console.log(data.drugslists.length);
                    if(data.drugslists){
                        for (var i=0; i<data.drugslists.length; i++){
                        // console.log(2222222222222);

                        drugstext = drugstext
                        +'<div id="clickdrugs" type="submit" class="btn btn-primary" attr_value="'+data.drugslists[i].id+'">'
                        +data.drugslists[i].name
                        +'</div> '
                        $("#ssover").html(drugstext)
                        }
                    }
                }
            });
        }else{
            alert('未输入搜索关键词');
        }

        $(document).on("click","#clickdrugs",function(){
            var clickdrugsname=$(this).attr('attr_value');
            console.log(clickdrugsname);

            $.ajax({
            url:'/Drugs/choicelists', 
                data:{
                    "id":clickdrugsname,
                    
                },
                type:'post',
                dataType:"json",
                success:function(data){
                    console.log(data.choicelists[0].name);
                    let choicetext='';

                    if(data.choicelists[0].name){
                        let flag=0;
                        $(".xzname").each(function(){
                            if($(this).text()==data.choicelists[0].name){
                                flag=1;
                            }
                          console.log($(this).text());
                          console.log(data.choicelists[0].name);
                        });
                        if (flag==1) {
                            alert('已选择');
                        }else{
                            choicetext = choicetext
                            +'<div type="submit" class="btn btn-primary xzname" attr_value="'+data.choicelists[0].id+'">'
                            +data.choicelists[0].name
                            +'</div> '
                            $(".sschoice").after(choicetext);
                        }

                        // choicetext = choicetext
                        // +'<div id="xzname" type="submit" class="btn btn-primary" attr_value="'+data.choicelists[0].id+'">'
                        // +data.choicelists[0].name
                        // +'</div> '
                        // $("#sschoice").after(choicetext);
                    }
                }
            });
        });

            
    });

    $(document).on("click",".xzname",function(){
        // var shanchuid=$(this).attr('attr_value');
        //     console.log(shanchuid);  
            $(this).remove();
    }) 
    
    
    $(document).on('click','#adds',function(){
        var id=$('#id').val();    
        sendarray=[];

        $(".xzname").each(function(){
          // console.log($(this).text());
          // sendarray=$(this).text(); 
          sendarray.push($(this).attr('attr_value'));
          
        });
        console.log(sendarray);
        
            $.ajax({
            // url:'/Disease/choiceadd_do', 
                data:{
                    "id":id,
                    "drug":sendarray,

                },
                type:'post',
                dataType:"json",
                success:function(data){
                    // if(data.status){
                        
                    //     alert('修改成功');
                    //     window.location="/Disease/lists";
                    // }else{
                    //     alert(data.message);
                    // }
                }
            });

        
        
    })
</script>
</body>
</html>