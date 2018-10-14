<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class CouponUserModel extends CommonMAbstract {

    static $COUPON_MODEL = 'coupon';

    public function lists(){
        extract(generateRequestParamVars());
        $conditions=[];
        $conditions['status_delete']=1;
        $conditions['mall_id']=$mall_id;
        $conditions['user_id']=$user_id;
        $lists = $this->where($conditions)->select();
        foreach($lists as $key => $value){
            $coupon = D(self::$COUPON_MODEL)->find($lists[$key]['coupon_id']);
            $lists[$key]['coupon'] = $coupon;
            $lists[$key]['start_time'] = date('Y-m-d',$lists[$key]['start_time']);
            $lists[$key]['end_time'] = date('Y-m-d',$lists[$key]['end_time']);
        }
        return $lists;
    }

    public function getCoupon(){
        extract(generateRequestParamVars());
        $data=[];
        $data['status_delete']=1;
        $data['mall_id']=$mall_id;
        $data['coupon_id']=$coupon_id;
        $data['user_id']=$user_id;
        $data['start_time']=time();
        $data['status']=0;
        $coupon = D(self::$COUPON_MODEL)->find($coupon_id);
        $data['end_time'] = $data['start_time'] + $coupon['valid_time']*24*60*60;
        $data['create_time'] = time();
        if($this->add($data) === false){
            throw new \Exception('添加优惠券失败');
        }
    }

}