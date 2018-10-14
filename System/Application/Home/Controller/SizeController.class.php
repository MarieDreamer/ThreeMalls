<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class SizeController extends Controller{


    // static $Photo_Album='PhotoAlbum';
    static $COUPON_MODEL='coupon';
    static $CATEGORY_MODEL='category';
    static $COMMODITY_MODEL='commodity';
    static $WECHAT_USER_MODEL='WechatUser';
    static $SIZE_MODEL='Size';

    

    public function raedit(){
        validateUnLoginRedirect();
        $result=D(self::$SIZE_MODEL)->getResultByConditions(array('id'=>I('get.id')));
        $result['content']=json_decode($result['content'],true);
        $this->assign('result',$result);
        $this->display();
    }

    //商品管理页面显示
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        list($paging, $results) = D(self::$SIZE_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }

    //提交修改
    public function raedit_do(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            validateUnLoginRedirect();
            D(self::$SIZE_MODEL)->raedit();
            $total=D(self::$SIZE_MODEL)->totalfun($commodity_id);
            $minimum_price=D(self::$SIZE_MODEL)->minimum_pricefun($commodity_id);
            D(self::$COMMODITY_MODEL)->update_total($total,$commodity_id,$minimum_price);
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

    //size页面单独添加size
    public function sizeadds_do(){
        $model = new Model();
        $model->startTrans();
        $flag = 0;
        try{
            validateUnLoginRedirect();
            //取此商品的商城类型
            $mall_id=D(self::$COMMODITY_MODEL)->mall_id_lists();
            //添加数据
            D(self::$SIZE_MODEL)->sizeadds_do($mall_id);

            $total=D(self::$SIZE_MODEL)->totalfun($commodity_id);
            $minimum_price=D(self::$SIZE_MODEL)->minimum_pricefun($commodity_id);
            D(self::$COMMODITY_MODEL)->update_total($total,$commodity_id,$minimum_price);
            
            $ajaxReturnData['mall_id']=$mall_id;
            $ajaxReturnData['total']=$total;
            $ajaxReturnData['minimum_price']=$minimum_price;
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $flag = 1;
        }catch(\Exception $e){
            $ajaxReturnData['commodity_id']=$commodity_id;
            $ajaxReturnData['mall_id']=$mall_id;
            $ajaxReturnData['total']=$total;
            $ajaxReturnData['minimum_price']=$minimum_price;
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


   
}

    