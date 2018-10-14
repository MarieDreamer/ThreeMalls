<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class DistributorController extends Controller{

    static $DISTRIBUTOR_MODEL='distributor';

    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    //获取分销状态
    //参数 $user_id $mall_id
    public function getStatus(){
        try{
            $data = D(self::$DISTRIBUTOR_MODEL)->getStatus();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$data;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败,'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //申请分销
    //参数 $user_id $mobile $mall_id
    public function adds_do(){
        try{
            D(self::$DISTRIBUTOR_MODEL)->adds_do();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败,'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    
        
}

    