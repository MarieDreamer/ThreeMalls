<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class CouponModel extends CommonMAbstract {

    static $COUPON_USER = 'coupon_user';

    public function lists(){
        extract(generateRequestParamVars());
        $conditions=[];
        $conditions['status_delete']=1;
        $conditions['mall_id']=$mall_id;
        $lists = $this->where($conditions)->select();
        foreach($lists as $key => $value){
            $cond = [];
            $cond['user_id'] = $user_id;
            $cond['coupon_id'] = $lists[$key]['id'];
            $cond['status_delete'] = 1;
            if(D(self::$COUPON_USER)->where($cond)->find()){
                $lists[$key]['has_get'] = 1;
            }else{
                $lists[$key]['has_get'] = 0;
            }
        }
        return $lists;
    }

}