<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class OrderController extends Controller{


    static $SPELL_GROUP_CODE_MODEL='SpellGroupCode';
    static $SPELL_GROUP_MODEL='SpellGroup';
    static $ORDER_MODEL='Order';
    static $COMMODITY_MODEL='commodity';
    static $ORDER_DETAIL = 'order_detail';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    //订单列表
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        list($paging, $results) = D(self::$ORDER_MODEL)->lists();
        $this->assign('mall_id', $mall_id);
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }

    //订单详情
    public function detail(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        $order = D(self::$ORDER_MODEL)->detail();
        $order_detail = D(self::$ORDER_DETAIL)->lists();
        $this->assign('mall_id', $mall_id);
        $this->assign('order', $order);
        $this->assign('order_detail', $order_detail);
        $this->display();
    }

    public function changeStatus()
    {
        validateUnLoginRedirect();
        try{
            D(self::$ORDER_MODEL)->changeStatus();
            $ajaxReturnData['status'] = 1;
            $ajaxReturnData['message'] = '操作成功';
        }catch (\Exception $e){
            $ajaxReturnData['status'] = 0;
            $ajaxReturnData['message'] = '操作失败';
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function editAddress()
    {
        validateUnLoginRedirect();
        try{
            D(self::$ORDER_MODEL)->editAddress();
            $ajaxReturnData['status'] = 1;
            $ajaxReturnData['message'] = '操作成功';
        }catch (\Exception $e){
            $ajaxReturnData['status'] = 0;
            $ajaxReturnData['message'] = '操作失败';
        }
        $this->ajaxReturn($ajaxReturnData);
    }

}

    