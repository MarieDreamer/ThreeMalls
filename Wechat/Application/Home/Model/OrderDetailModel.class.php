<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class OrderDetailModel extends CommonMAbstract {

    static $CART_MODEL = 'cart';
    static $COMMODITY_MODEL = 'commodity';
    static $SIZE_MODEL = 'size';

    public function getDetail($order){
        $order_detail = $this->where('order_id='.$order['id'])->select();
        foreach($order_detail as $key => $value){
            $commodity = D(self::$COMMODITY_MODEL)->find($order_detail[$key]['commodity_id']);
            $order_detail[$key]['commodity_name'] = $commodity['shop_name'];
            $order_detail[$key]['commodity_image'] = (json_decode($commodity['shop_index_image'],true))[0];
        }
        $order['order_detail'] = $order_detail;
        return $order;
    }
    //下单
    //参数  $cart_id
    public function adds_do($order_id){
        extract(generateRequestParamVars());
        if($cart_id != null){
            $cart_id = explode('_',$cart_id);
            for($i=0;$i<count($cart_id);$i++){
                $cart = D(self::$CART_MODEL)->find($cart_id[$i]);
                $data = [];
                $data['order_id'] = $order_id;
                $data['commodity_id'] = $cart['commodity_id'];
                $data['num'] = $cart['num'];
                $type = D(self::$SIZE_MODEL)->find($cart['type_id']);
                $data['type'] = $type['type'];
                $data['color'] = $type['color'];
                $data['size'] = $type['size'];
                $data['single_price'] = $type['price'];
                $data['price'] = $type['price'] * $cart['num'];
                $data['create_time'] = time();
                if($this->add($data) === false){
                    throw new \Exception('order_detail'.$this->_sql());
                }
            }
        }else{
            $data = [];
            $data['order_id'] = $order_id;
            $data['commodity_id'] = $commodity_id;
            if($size != null){
                $data['size'] = $size;
            }
            if($color != null){
                $data['color'] = $color;
            }
            if($type != null){
                $data['type'] = $type;
            }
            $data['num'] = $num;
            $data['single_price'] = $price;
            $data['price'] = $num * $price;
            $data['create_time'] = time();
            if($this->add($data) === false){
                throw new \Exception('立即购买失败');
            }
        }
        
    }

}