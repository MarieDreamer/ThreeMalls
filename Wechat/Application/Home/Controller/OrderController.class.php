<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class OrderController extends Controller{

    static $CART_MODEL='cart';
    static $ORDER_MODEL='order';
    static $ORDER_DETAIL='order_detail';
    static $SPELL_GROUP='spell_group';
    static $SPELL_GROUP_CODE='spell_group_code';
    static $SIZE_MODEL = 'size';
    static $COMMODITY_MODEL = 'commodity';

    public function __construct(){
        parent::__construct();
    }

    //我的订单
    //参数 $user_id $mall_id
    public function getList(){
        try{
            $data = D(self::$ORDER_MODEL)->getList();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //详情
    //参数 $id
    public function getDetail(){
        try{
            $order = D(self::$ORDER_MODEL)->getDetail();
            $data = D(self::$ORDER_DETAIL)->getDetail($order);
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //下单
    //参数 $user_id $mall_id $cart_id $address_id
    //    $message $coupon_id $discount
    public function adds_do(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            //增加销售额
            D(self::$COMMODITY_MODEL)->add_sale();//$cart_id
            //订单生成
            $order_id = D(self::$ORDER_MODEL)->adds_do();//$user_id $mall_id $address_id $message $coupon_id $discount
            //订单详情生成
            D(self::$ORDER_DETAIL)->adds_do($order_id);//$cart_id
            //购物车删除
            D(self::$CART_MODEL)->delete_do();//$cart_id
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $flag = 1;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
            $flag = 2;
        }
        if($flag == 1){
            $model->commit();
        }else if($flag == 2){
            $model->rollback();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //立即下单
    //参数 $user_id $commodity_id $type $num $address_id $message 
        //$group_id(可选) $coupon_id(可选) $discount(可选) $color(可选) $size(可选) $type(可选)
    public function buy_now(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            D(self::$COMMODITY_MODEL)->add_sale(); //$commodity_id $num
            $order_id = D(self::$ORDER_MODEL)->buy_now();
            D(self::$SPELL_GROUP_CODE)->adds_do($order_id);
            D(self::$ORDER_DETAIL)->adds_do($order_id);
            D(self::$SIZE_MODEL)->reduce();
            D(self::$COMMODITY_MODEL)->reduce();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $flag = 1;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
            $flag = 2;
        }
        if($flag == 1){
            $model->commit();
        }else if($flag == 2){
            $model->rollback();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function pay(){
        try{
            D(self::$ORDER_MODEL)->pay();
            $ajaxReturnData['status'] = 1;
            $ajaxReturnData['message'] = '操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status'] = 0;
            $ajaxReturnData['message'] = '操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }
        
}

    