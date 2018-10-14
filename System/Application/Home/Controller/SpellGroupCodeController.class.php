<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class SpellGroupCodeController extends Controller{


    static $SPELL_GROUP_CODE_MODEL='SpellGroupCode';
    static $SPELL_GROUP_MODEL='SpellGroup';
    static $ORDER_MODEL='Order';
    static $COMMODITY_MODEL='commodity';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        checkAccess('category','view');
        list($paging, $results) = D(self::$SPELL_GROUP_CODE_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }


    //by 吴俊锋 2018-8-27 11：02
    //by 单宇瀚 2018-8-27 16：50
    public function timeeetection(){
        try{
            validateUnLoginRedirect();
            //取所有未完成
            $unstatus=D(self::$SPELL_GROUP_CODE_MODEL)->get_unstatus();
            if($unstatus){
                //获取拼团人数
                $time_ids=array();
                $ids=array();
                $a=array();
                foreach ($unstatus as $key => $value) {
                    array_push($ids,$value['group_id']);
                }
                $get_group_number=D(self::$SPELL_GROUP_MODEL)->get_group_number($ids);

                //获取订单数
                $ids=array();
                foreach ($unstatus as $key => $value) {
                    array_push($ids,$value['id']);
                }
                $get_order_number=D(self::$ORDER_MODEL)->get_order_number($ids);
                // var_dump($get_group_number);
                var_dump($get_order_number);

                foreach ($get_order_number as $order_number_key => $order_number_value) {

                    //如果实际人数不满足活动人数
                    if($get_order_number[$order_number_key]['order_size']>$get_order_number[$order_number_key]['count(group_id)']){
                        array_push($time_ids,$get_order_number[$order_number_key]['group_id']);

                        //查询活动是否过期
                        $get_group_time=D(self::$SPELL_GROUP_MODEL)->get_group_time($time_ids);

                        var_dump($get_group_time[0]);
                        if($get_group_time[0]['overdue']==1){

                            $change_id=$get_group_time[0]['id'];

                            //改变订单状态
                            D(self::$ORDER_MODEL)->group_status_change($change_id);

                            //改变活动状态
                            D(self::$SPELL_GROUP_CODE_MODEL)->group_status_change($change_id);
                        }
                    }
                }

            }else{
                echo "没有未完成的拼团单号";
                //如果有需要加一个.log日志。
            }
            // $nowtime=D(self::$SPELL_GROUP_CODE_MODEL)->timeeetection();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            // $ajaxReturnData['nowtime']=$nowtime;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }



    

}

    