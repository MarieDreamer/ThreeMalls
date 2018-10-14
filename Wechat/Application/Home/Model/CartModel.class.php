<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class CartModel extends CommonMAbstract {

    static $COMMODITY_MODEL = 'commodity';
    static $SIZE_MODEL = 'size';

    //名创优品/食品 获取购物车列表
    //参数 $user_id $mall_id
    public function getList(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['user_id'] = $user_id;
        $conditions['mall_id'] = $mall_id;
        $data = $this->where($conditions)->order('create_time desc')->select();
        foreach ($data as $key => $value) {
            $commodity = D(self::$COMMODITY_MODEL)->find($data[$key]['commodity_id']);
            $image = json_decode($commodity['shop_index_image'],true);
            $data[$key]['commodity_image']=$image[0];
            $data[$key]['commodity_name']=$commodity['shop_name'];
            $type = D(self::$SIZE_MODEL)->find($data[$key]{'type_id'});
            $data[$key]['type']=$type['type'];
            $data[$key]['color']=$type['color'];
            $data[$key]['size']=$type['size'];
            $data[$key]['single_price']=$type['price'];

        }
        return $data;
    }

    //获取购物车
    //参数 $cart_id
    public function getCart(){
        extract(generateRequestParamVars());
        $cart_id = explode('_',$cart_id);
        $conditions = [];
        $conditions['id'] = array('in',$cart_id);
        $data = $this->where($conditions)->select();
        foreach ($data as $key => $value) {
            $commodity = D(self::$COMMODITY_MODEL)->find($data[$key]['commodity_id']);
            $image = json_decode($commodity['shop_index_image'],true);
            $data[$key]['commodity_image']=$image[0];
            $data[$key]['commodity_name']=$commodity['shop_name'];
            $type = D(self::$SIZE_MODEL)->find($data[$key]{'type_id'});
            $data[$key]['type']=$type['type'];
            $data[$key]['color']=$type['color'];
            $data[$key]['size']=$type['size'];
            $data[$key]['single_price']=$type['price'];
        }
        return $data;
    }

    //名创优品加入购物车
    //参数 $user_id $mall_id $commodity_id $type_id $num
    public function adds_do(){
        extract(generateRequestParamVars());
        $commodity = D(self::$COMMODITY_MODEL)->find($commodity_id);

        $conditions = [];
        $conditions['user_id'] = $user_id;
        $conditions['commodity_id'] = $commodity_id;
        $conditions['type_id'] = $type_id;

        $cart = $this->where($conditions)->find();
        if($cart){
            if($this->where($conditions)->setInc('num',$num) === false){
                throw new \Exception('购物车增加数量失败');
            }
        }else{
            $commodity = D(self::$COMMODITY_MODEL)->find($commodity_id);
            $data = [];
            $data['user_id'] = $user_id;
            $data['mall_id'] = $mall_id;
            $data['commodity_id'] = $commodity_id;
            $data['type_id'] = $type_id;
            $data['num'] = $num;
            $data['status_delete'] = 1;
            $data['create_time'] = time();
            if($this->add($data) === false){
                throw new \Exception('购物车添加失败'.$this->_sql());
            }
        }
        
    }

    //加入购物车
    //参数 $user_id $mall_id $commodity_id $size $color $num
    // public function adds_do(){
    //     extract(generateRequestParamVars());
    //     $commodity = D(self::$COMMODITY_MODEL)->find($commodity_id);

    //     $conditions = [];
    //     $conditions['user_id'] = $user_id;
    //     $conditions['commodity_id'] = $commodity_id;
    //     if($size != null){
    //         $conditions['size'] = $size;
    //     }
    //     if($color != null){
    //         $conditions['color'] = $color;
    //     }
    //     if($type != null){
    //         $conditions['type'] = $type;
    //     }

    //     $cart = $this->where($conditions)->find();
    //     if($cart){
    //         if($this->where($conditions)->setInc('num',$num) === false){
    //             throw new \Exception('购物车增加数量失败');
    //         }
    //         if($this->where($conditions)->setInc('price',$num * $price) === false){
    //             throw new \Exception('购物车增加数量失败');
    //         }
    //     }else{
    //         $commodity = D(self::$COMMODITY_MODEL)->find($commodity_id);
    //         $data = [];
    //         $data['user_id'] = $user_id;
    //         $data['mall_id'] = $mall_id;
    //         $data['commodity_id'] = $commodity_id;
    //         // $data['commodity_name'] = $commodity['shop_name'];
    //         // $data['commodity_image'] = $commodity['shop_index_image'];
    //         $data['size'] = $size;
    //         $data['color'] = $color;
    //         $data['type'] = $type_id;
    //         $data['num'] = $num;
    //         $data['single_price'] = $price;
    //         $data['price'] = $price * $num;
    //         $data['status_delete'] = 1;
    //         $data['create_time'] = time();
    //         if($this->add($data) === false){
    //             throw new \Exception('购物车添加失败'.$this->_sql());
    //         }
    //     }
        
    // }

    //购物车删除
    //参数 $cart_id
    public function delete_do(){
        extract(generateRequestParamVars());
        if($cart_id != null){
            $cart_id = explode('_',$cart_id);
            for($i=0;$i<count($cart_id);$i++){
                if($this->delete($cart_id[$i]) === false){
                    throw new \Exception('删除失败');
                }
            }
        }
    }


}