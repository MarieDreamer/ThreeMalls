<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class WechatUserSmokeController extends Controller{


    // static $Photo_Album='PhotoAlbum';
    static $COUPON_MODEL='coupon';
    static $CATEGORY_MODEL='category';
    static $WECHAT_USER_MODEL='WechatUserSmoke';
    
   
    //用户列表
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        checkAccess('category','view');
        list($paging, $results) = D(self::$WECHAT_USER_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }

   

    

}

    