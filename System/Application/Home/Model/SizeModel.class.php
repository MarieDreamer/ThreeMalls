<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SizeModel extends CommonMAbstract {

    static $CART_MODEL = 'cart';

    public function raedit(){
            extract(generateRequestParamVars());
            //正整数正则
            $shuziyz='/^\d+$/';
            if($id && $color && $price && $num){
                
                if(preg_match($shuziyz, $num)){
                    $data=array();
                    $data['color']=$color;
                    $data['size']=$size;
                    $data['type']=$type;
                    $data['price']=$price;
                    $data['num']=$num;
                    if($img){
                        $data['img']=$img;
                    }
                    $conditions=array();
                    $conditions['id']=$id;
                    if(!$this->where($conditions)->save($data)){
                        // echo $this->_sql();
                        throw new \Exception(L('OPERATION_FAILED'));
                    }
                }else{
                    throw new \Exception(L('数据不合法'));
                }
            }else{
                throw new \Exception(L('缺少数据'));
                }
            
        }

    public function lists(){
            extract(generateRequestParamVars());
            
            $conditions=array();
            //0是删除 1是显示
            $conditions['commodity_id']=$id;
            if(!$conditions){
                $count=$this->count();
            }else{
                $count=$this->where($conditions)->count();
            }

            if(!$numPerPage=I('param.numPerPage')){
                $numPerPage=C('NUM_PER_PAGE');
            }

            $page=new \Think\Page($count,$numPerPage);
            $paging=$page->show();

            
            if(!$conditions){
                $results=$this->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
            }else{
                $results=$this->where($conditions)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
            }
            return array($paging,$results);
        }

    //添加数据并且取此商品所有类别数量之和
    public function adds($commodity_id){
        extract(generateRequestParamVars());

        for( $fori = 0; $fori<count($size_group_a); $fori++){
            $data=array();
            $data['commodity_id']=$commodity_id;
            $data['color']=$size_group_a[$fori];
            if($mall_id==2){
                $data['size']=$size_group_b[$fori];
            }else{
                $data['type']=$size_group_b[$fori];
            }
            $data['num']=$size_group_c[$fori];
            $data['price']=$size_group_d[$fori];
            $data['img']=$size_group_img_url[$fori];
            $data['mall_id']=$mall_id;
            $data['create_time']=time();
            if(!$this->add($data)){
                echo $this->_sql();
                throw new \Exception(L('OPERATION_FAILED'));
            }
        }
        $conditions=array();
        $conditions['commodity_id']=$commodity_id;
        $results=$this->where($conditions)->sum('num');

        $total = $results;

        return $total;

    }

    // 添加数据
    public function sizeadds_do($mall_id){
        extract(generateRequestParamVars());
        $shuziyz='/^\d+$/';

        if($color && $size && $price && $num && $img){
            if(preg_match($shuziyz, $num)){
                $data=array();
                $data['color']=$color;
                if($mall_id==2){
                    $data['size']=$size; 
                }else{
                    $data['type']=$size; 
                }
                $data['commodity_id']=$commodity_id;
                $data['price']=$price;
                $data['num']=$num;
                $data['img']=$img;
                $data['mall_id']=$mall_id;
                $data['create_time']=time();
                if(!$this->add($data)){
                    echo $this->_sql();
                    throw new \Exception(L('OPERATION_FAILED'));
                }

            }else{
                throw new \Exception(L('提交的数量需要纯阿拉伯数字'));
            }
            
        }else{
            throw new \Exception(L('缺少必要数据'));
        }


    }

    // 取此商品所有类别数量之和
    public function totalfun($commodity_id){
        extract(generateRequestParamVars());
        $conditions=array();
        $conditions['commodity_id']=$commodity_id;
        $results=$this->where($conditions)->sum('num');

        $total = $results;

        return $total;
    }


    public function minimum_pricefun($commodity_id){
        extract(generateRequestParamVars());
        // throw new \Exception(' '.$commodity_id);
        $conditions=array();
        $conditions['commodity_id']=$commodity_id;
        $results=$this->where($conditions)->order('id asc')->select();
        $minimum_price=$results[0]['price'];
        return $minimum_price;

    }
    
   

}