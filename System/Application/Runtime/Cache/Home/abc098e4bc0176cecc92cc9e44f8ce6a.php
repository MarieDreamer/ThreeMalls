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
                        <h2><div  class="col-sm-2"></div>订单详情</h2>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订单编号</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['order_number']); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['user_name']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">收货地址</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['address_region']); ?> <?php echo ($order_detail[0]['address_address']); ?>
                                <br>
                                <?php echo ($order_detail[0]['address_consignee']); ?> <?php echo ($order_detail[0]['address_mobile']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">配送方式</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['shipping_name']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">优惠券使用</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['coupon_id']); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">买家留言</label>
                            <div class="col-sm-8">
                                <?php echo ($order_detail[0]['user_note']); ?>
                            </div>
                        </div>

                        <?php if(is_array($order_detail[1])): $i = 0; $__LIST__ = $order_detail[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="border:2px solid #eee;padding: 20px;border-radius: 10px;margin-bottom: 10px;">
                                
                                <div class="form-group">
                                    <img src="<?php echo ($vo['shop_img']); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品名称</label>
                                    <div class="col-sm-8">
                                        <?php echo ($vo['shop_name']); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品价格</label>
                                    <div class="col-sm-8">
                                        <?php echo ($vo['shop_num']); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">商品数量</label>
                                    <div class="col-sm-8">
                                        <?php echo ($vo['num']); ?>
                                    </div>
                                </div>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <a href="/Order/lists"><button class="btn btn-white" type="button">返回</button></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Js/jquery.min.js?v=2.1.4"></script>
</body>
</html>