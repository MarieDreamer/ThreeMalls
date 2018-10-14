<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class OrderModel extends CommonMAbstract {

    static $ADDRESS_MODEL = 'address';
    static $ORDER_DETAIL = 'order_detail';
    static $COMMODITY_MODEL = 'commodity';
    static $SPELL_GROUP = 'spell_group';
    static $SPELL_GROUP_CODE = 'spell_group_code';
    static $SIZE_MODEL = 'size';
    static $CART_MODEL = 'cart';

    //我的订单
    //参数 $user_id $mall_id
    public function getList(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['user_id'] = $user_id;
        $conditions['mall_id'] = $mall_id;
        if($spell_status != null){
            $conditions['group_id'] = array('neq','null');
        }
        if($status != null && $status !=4){
            $conditions['status'] = $status;
        }
        $order = $this->where($conditions)->order('create_time desc')->select();
        $delete = [];
        for($i = 0 ; $i < count($order); $i ++){
            //如果找拼团
            if($spell_status != null){
                $spell_group_code = D(self::$SPELL_GROUP_CODE)->where('order_id='.$order[$i]['id'])->find();
                if($spell_group_code['group_status'] == $spell_status){
                    $order_detail = D(self::$ORDER_DETAIL)->where('order_id='.$order[$i]['id'])->select();
                    for($j = 0; $j < count($order_detail); $j ++){
                        $commodity = D(self::$COMMODITY_MODEL)->find($order_detail[$j]['commodity_id']);
                        $order_detail[$j]['commodity_name'] = $commodity['shop_name'];
                        $a = json_decode($commodity['shop_index_image'],true);
                        $order_detail[$j]['commodity_image'] = $a[0];
                    }
                    $order[$i]['order_detail'] = $order_detail;
                    $order[$i]['spell_detail'] = $spell_group_code;
                    $order[$i]['order_detail_num'] = count($order_detail);
                }else{
                    $delete[] = $i;
                }
            }else{
                $order_detail = D(self::$ORDER_DETAIL)->where('order_id='.$order[$i]['id'])->select();
                for($j = 0; $j < count($order_detail); $j ++){
                    $commodity = D(self::$COMMODITY_MODEL)->find($order_detail[$j]['commodity_id']);
                    $order_detail[$j]['commodity_name'] = $commodity['shop_name'];
                    $a = json_decode($commodity['shop_index_image'],true);
                    $order_detail[$j]['commodity_image'] = $a[0];
                }
                $order[$i]['order_detail'] = $order_detail;
                $order[$i]['order_detail_num'] = count($order_detail);
            }
        }
        for($i=0;$i<count($delete);$i++){
            unset($order[$delete[$i]]);
        }
        $order = array_values($order);

        return $order;
    }

    //get order and order_detail by order_id
    public function getDetail(){
        extract(\generateRequestParamVars());
        $order = $this->find($id);
        return $order;
    }

    //下单
    //参数 $user_id $mall_id $total_price $address_id
    //    $message $coupon_id $discount
    public function adds_do(){
        extract(generateRequestParamVars());
        $total_num = 0;
        $total_fee = 0;
        $cart_ids = explode('_',$cart_id);
        for($i=0;$i<count($cart_ids);$i++){
            $cart = D(self::$CART_MODEL)->find($cart_ids[$i]);
            $total_num += $cart['num'];
            $type = D(self::$SIZE_MODEL)->find($cart['type_id']);
            $total_fee += $cart['num']*$type['price'];
        }
        $address = D(self::$ADDRESS_MODEL)->find($address_id);
        $data = [];
        $data['user_id'] = $user_id;
        $data['mall_id'] = $mall_id;
        $data['address'] = $address['province'].' '.$address['address'].' '.$address['name'].' '.$address['phone'];
        $data['status'] = 0;
        $data['message'] = $message;
        $data['total_fee'] = $total_fee;
        $data['total_num'] = $total_num;
        $data['final_fee'] = $total_fee;
        //如果用了优惠券
        if($coupon_id != null){
            $data['coupon_id'] = $coupon_id;
            $data['discount'] = $discount;
            $data['final_fee'] = $total['total_fee'] - $discount;
        }
        $data['create_time'] = time();
        if(!$order_id = $this->add($data)){
            throw new \Exception('下单失败'.$this->_sql());
        }
        return $order_id;
        
    }

    //立即下单
    //参数 $user_id $commodity_id $num $address_id $message 
        //$group_id(可选) $coupon_id(可选) $discount(可选) $color(可选) $size(可选) $type(可选)
    public function buy_now(){
        extract(generateRequestParamVars());
        $data = [];
        $data['user_id'] = $user_id;
        $data['mall_id'] = $mall_id;
        $data['message'] = $message;
        $data['status'] = 0;
        $data['create_time'] = time();
        $data['total_num'] = $num;
        $address = D(self::$ADDRESS_MODEL)->find($address_id);
        $data['address'] = $address['province'].' '.$address['address'].' '.$address['name'].' '.$address['phone'];
        if($buy_type == 0){ //立即购买
            $data['total_fee'] = $num * $price;
            $data['final_fee'] = $num * $price;
        }else if($buy_type == 1){   //开团
            $spell_group = D(self::$SPELL_GROUP)->where('commodity_id=' . $commodity_id)->find();
            $data['group_id'] = $spell_group['id'];
            $data['order_size'] = $spell_group['order_size'];
            $data['total_fee'] = $num * $spell_group['group_price'];
            $data['final_fee'] = $num * $spell_group['group_price'];
        }else if($buy_type == 2){    //参团
            $data['group_id'] = $group_id;
            $spell_group = D(self::$SPELL_GROUP)->find($group_id);
            $data['order_size'] = $spell_group['order_size'];
            $data['total_fee'] = $num * $spell_group['group_price'];
            $data['final_fee'] = $num * $spell_group['group_price'];
        }
        if($coupon_id != null){     //使用优惠券
            $data['coupon_id'] = $coupon_id;
            $data['discount'] = $discount;
            $data['final_fee'] = $total['total_fee'] - $discount;
        }
        if(!$order_id = $this->add($data)){
            throw new \Exception('下单失败'.$this->_sql());
        }
        return $order_id;
    }

    public function pay(){
        extract(generateRequestParamVars());
        $data = [];
        $data['status'] = 1;
        if($this->where('id='.$id)->save($data) === false){
            throw new \Exception('支付失败'.$this->_sql());
        }
    }

}