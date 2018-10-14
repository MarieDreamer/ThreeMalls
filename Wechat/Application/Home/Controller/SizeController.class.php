<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class SizeController extends Controller{

    static $SIZE_MODEL='size';

    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    //获取衣服尺码和颜色信息
    //参数 $commodity_id
    public function getSize(){
        try{
            $data = D(self::$SIZE_MODEL)->getSize();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //获取烟类型
    //参数 $commodity_id
    public function getType(){
        try{
            $data = D(self::$SIZE_MODEL)->getType();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //找数量
    //参数 $commodity_id
    public function getNum(){
        try{
            $data = D(self::$SIZE_MODEL)->getNum();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //根据颜色找数量
    //参数 $commodity_id
    public function getNumByColor(){
        try{
            $data = D(self::$SIZE_MODEL)->getNumByColor();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }


    //选择尺码后
    //参数 $commodity_id $size
    //返回存在的颜色及库存
    public function getColor(){
        try{
            $data = D(self::$SIZE_MODEL)->getColor();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

        
}

    