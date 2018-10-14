<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CommodityController extends Controller{

    static $COMMODITY_MODEL='commodity';
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    public function lists(){
        try{
            $data = D(self::$COMMODITY_MODEL)->lists();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function listsfind(){
        try{
            $data = D(self::$COMMODITY_MODEL)->listsfind();
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

    