<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class CommodityModel extends CommonMAbstract {

    static $CART_MODEL = 'cart';
    static $SPELL_GROUP = 'spell_group';
    static $SIZE_MODEL = 'size';
    
    public function lists(){
        extract(generateRequestParamVars());

        $numPerPage=6;
        $page=new \Think\Page($count,$numPerPage);
        $paging=$page->show();
        $conditions=[];
        //0是删除 1是显示
        $conditions['status_delete']=1;
        $conditions['mall_id']=$mall_id;

        //类别筛选
        if($main_class != null){
            $conditions['main_class']=$main_class;
        }
        //如果有关键字
        if($key != null){
            $conditions['shop_name']=array('like','%' . $key . '%');
        }
        //是否拼团
        if($is_spell_group != null && $is_spell_group != 2){
            $conditions['is_spell_group'] = $is_spell_group;
        }
        $lists = $this->where($conditions);
        //排序方式
        if($order != null){
            if($order == 'shop_price' && $price_order == 1){
                $lists->order($order);
            }else{
                $lists->order($order.' desc');
            }
        }
        $data = $lists->limit($page->firstRow.','.$page->listRows)->select();
        for($i=0;$i<count($data);$i++){
            $data[$i]['shop_image'] = json_decode($data[$i]['shop_image'],true);
            $data[$i]['shop_index_image'] = json_decode($data[$i]['shop_index_image'],true);
            $data[$i]['date'] = convertDate($data[$i]['create_time']);
            if($is_spell_group != null && $is_spell_group == 1){
                $spell_group = D(self::$SPELL_GROUP)->where('commodity_id='.$data[$i]['id'])->find();
                $data[$i]['order_size'] = $spell_group['order_size'];
                $data[$i]['group_price'] = $spell_group['group_price'];
            }
        }
        // json_decode($moments[$i]['images'],true);
        return $data;
    }

    public function listsfind(){
        extract(generateRequestParamVars());
        $data=$this->find($id);
        if($data['is_spell_group']){
            $data['spell'] = D(self::$SPELL_GROUP)->where('commodity_id='.$id)->find();
            //进行中
            if($data['spell']['start_time']<=time() && time()<=$data['spell']['end_time']){
                $times = $data['spell']['end_time'] - time();
                $data['spell']['status'] = 1;
            //未开始
            }else if(time()<=$data['spell']['start_time']){
                $times = $data['spell']['start_time'] - time();
                $data['spell']['status'] = 0;
            //已结束
            }else{
                $times = 0;
                $data['spell']['status'] = 2;
            }
            // 天数
            $day = floor($times/86400);
            // 小时
            $hour = floor(($times-86400 * $day)/3600);
            // 分钟
            $minute = floor(($times-86400 * $day-3600 * $hour)/60);
            //秒
            $second = floor($times-86400 * $day-3600 * $hour - 60 * $minute);
            $data['spell']['day'] =  $day;
            $data['spell']['hour'] = $hour;
            $data['spell']['minute'] = $minute;
            $data['spell']['second'] = $second;
        }
        $data['shop_image'] = json_decode($data['shop_image'],true);
        $data['shop_index_image'] = json_decode($data['shop_index_image'],true);
        return $data;
    }
    
    //减少总库存
    //参数 $commodity_id $num
    public function reduce(){
        extract(generateRequestParamVars());
        $commodity = $this->find($commodity_id);
        if($commodity['shop_num'] < $num){
            throw new \Exception('commodity库存不足');
        }
        if($this->where('id='.$commodity_id)->setDec('shop_num',$num) === false){
            throw new \Exception('减少总库存失败');
        }
    }

    //增加总库存
    //参数 $cart_id
    public function increase(){
        extract(generateRequestParamVars());
        $cart = D(self::$CART_MODEL)->find($cart_id);
        $conditions = [];
        $conditions['id'] = $cart['commodity_id'];
        if($this->where($conditions)->setInc('shop_num',$cart['num']) === false){
            throw new \Exception('OPERATION FAILED');
        }
    }

    //增加销售额
    //参数 $cart_id
    public function add_sale(){
        extract(generateRequestParamVars());
        if($cart_id != null){
            $cart_ids = explode('_',$cart_id);
            for($i=0;$i<count($cart_ids);$i++){
                $cart = D(self::$CART_MODEL)->find($cart_ids[$i]);
                if($this->where('id='.$cart['commodity_id'])->setInc('shop_sale',$cart['num']) === false){
                    throw new \Exception('增加销售额失败');
                }
            }
        }else if($commodity_id != null){
            if($this->where('id='.$commodity_id)->setInc('shop_sale',$num) === false){
                throw new \Exception('增加销售额失败');
            }
        }
        
    }

}