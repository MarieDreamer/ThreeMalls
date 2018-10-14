<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SizeModel extends CommonMAbstract {

    static $CART_MODEL = 'cart';
    
    //获取所有尺码和颜色信息
    //参数 $commodity_id
    public function getSize(){
        extract(generateRequestParamVars());
        $type=$this->where('commodity_id='.$commodity_id)->field("id,size,color,num,price")->select();
        return $type;
    }

    //获取烟的类型
    //参数 $commodity_id
    public function getType(){
        extract(generateRequestParamVars());
        $type=$this->where('commodity_id='.$commodity_id)->field("id,type,num,price")->select();
        return $type;
    }

    //根据颜色找数量
    //参数 $commodity_id
    public function getNumByColor(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['commodity_id'] = $commodity_id;
        $num=$this->where($conditions)->field('color,sum(num) as num')->group('color')->select();
        
        return $num;
    }

    //根据颜色和尺码找数量
    //参数 $commodity_id
    public function getNum(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['commodity_id'] = $commodity_id;
        $num=$this->where($conditions)->field('color,size,num')->select();
        return $num;
    }

    //减少库存
    //参数 $commodity_id $size $color $num 
    public function reduce(){
        extract(generateRequestParamVars());
        if($size != null || $color != null || $type != null){
            $conditions = [];
            $conditions['commodity_id'] = $commodity_id;
            if($size != null && $size != 'null'){
                $conditions['size'] = $size;
            }
            if($color != null && $color != 'null'){
                $conditions['color'] = $color;
            }
            if($type != null && $type != 'null'){
                $conditions['type'] = $type;
            }
            $size_model = $this->where($conditions)->find();
            if(!$size_model){
                throw new \Exception('该商品规格不存在');
            }
            if($size_model['num'] < $num){
                throw new \Exception('size库存不足');
            }
            if($this->where($conditions)->setDec('num',$num) === false){
                throw new \Exception('减少库存失败');
            }
        }
    }

    //增加库存
    //参数 $cart_id 
    public function increase(){
        extract(generateRequestParamVars());
        $cart = D(self::$CART_MODEL)->find($cart_id);
        if($cart['size'] != null || $cart['color'] != null ){
            $conditions = [];
            $conditions['commodity_id'] = $cart['commodity_id'];
            if($cart['size'] != null){
                $conditions['size'] = $cart['size'];
            }
            if($cart['color'] != null){
                $conditions['color'] = $cart['color'];
            }
            if($type != null){
                $conditions['type'] = $type;
            }
            if($this->where($conditions)->setInc('num',$cart['num']) === false){
                throw new \Exception('OPERATION FAILED');
            }
        }
        
    }

}