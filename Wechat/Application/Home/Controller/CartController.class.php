<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CartController extends Controller{

    static $CART_MODEL='cart';
    static $COMMODITY_MODEL='commodity';
    static $SIZE_MODEL='size';

    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }
    
    //获取购物车列表
    //参数 $user_id $mall_id
    public function getList(){
        try{
            $data = D(self::$CART_MODEL)->getList();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function getCart(){
        try{
            $data = D(self::$CART_MODEL)->getCart();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //加入购物车
    //参数 $user_id $mall_id $commodity_id $size $color $type $num
    public function adds_do(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            D(self::$SIZE_MODEL)->reduce();//$commodity_id $size $color $num
            D(self::$COMMODITY_MODEL)->reduce();//$commodity_id $num
            D(self::$CART_MODEL)->adds_do();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            
            $flag = 1;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败,'.$e->getMessage();
            $flag = 2;
        }
        if($flag == 1) {
            $model->commit();
        }else if($flag == 2){
            $model->rollback();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //购物车删除
    //参数 $cart_id
    public function delete_do(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            D(self::$SIZE_MODEL)->increase();
            D(self::$COMMODITY_MODEL)->increase();
            D(self::$CART_MODEL)->delete_do();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $flag = 1;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败,'.$e->getMessage();
            $flag = 2;
        }
        if($flag == 1) {
            $model->commit();
        }else if($flag == 2){
            $model->rollback();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

        
}

    