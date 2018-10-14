<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SpellGroupCodeModel extends CommonMAbstract {

    static $SPELL_GROUP = 'spell_group';
    static $ORDER_MODEL = 'order';

    //$user_id $mall_id $commodity_id
    public function adds_do($order_id){
        extract(generateRequestParamVars());
        $order = D(self::$ORDER_MODEL)->find($order_id);
        if($order['group_id'] && $buy_type == 1){
            $spell_group = D(self::$SPELL_GROUP)->where('commodity_id=' . $commodity_id)->find();
            $data = [];
            $data['group_user_id'] = $user_id;
            $data['order_id'] = $order_id;
            $data['mall_id'] = $mall_id;
            $data['group_id'] = $spell_group['id'];
            $data['group_code'] = $this->code();
            $data['group_num'] = 1;
            $data['group_status'] = 1;
            $data['create_time'] = time();
    
            if($this->add($data) === false){
                throw new \Exception('添加group失败');
            }
        }
        
    }

    //生成无序
    public function code(){
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $code = substr($charid, 0, 10);
        return $code;
    }


}