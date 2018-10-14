<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CouponController extends Controller{

    static $COUPON_MODEL='coupon';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    public function lists(){
        try{
            $lists = D(self::$COUPON_MODEL)->lists();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['data']=$lists;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

}

    