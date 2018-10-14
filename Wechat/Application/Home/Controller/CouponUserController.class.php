<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CouponUserController extends Controller{

    static $COUPON_USER='coupon_user';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    public function lists(){
        try{
            $lists = D(self::$COUPON_USER)->lists();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$lists;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function getCoupon(){
        try{
            D(self::$COUPON_USER)->getCoupon();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

}

    