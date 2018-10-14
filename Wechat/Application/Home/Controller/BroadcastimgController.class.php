<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class BroadcastimgController extends Controller{


    // static $Photo_Album='PhotoAlbum';
    static $BROADCASTIMG_MODEL='Broadcastimg';
    

    //取轮播图
    public function lists(){
    try{
        $lists = D(self::$BROADCASTIMG_MODEL)->lists();

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

    