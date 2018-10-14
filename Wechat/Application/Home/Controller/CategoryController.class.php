<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CategoryController extends Controller{


    // static $Photo_Album='PhotoAlbum';
    static $COUPON_MODEL='coupon';
    static $CATEGORY_MODEL='category';
    static $WECHAT_USER_MODEL='WechatUser';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    //获取商品类别
    public function lists(){
        try{
            $lists = D(self::$CATEGORY_MODEL)->lists();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['lists']=$lists;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

}

    