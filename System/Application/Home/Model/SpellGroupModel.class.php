<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SpellGroupModel extends CommonMAbstract {


   
    //by 吴俊锋 2018-8-27 11：02
    public function get_group_number($ids){
        $nowtime = time();
        $conditions=array();
        $conditions['status_delete']=1;
        $conditions['id']=array('in',$ids);
        $results=$this->where($conditions)->field('id,order_size,end_time')->select();

        // var_dump($nowtime);
        foreach ($results as $key => $value) {
            if($results[$key]['end_time']>$nowtime){
                $results[$key]['overdue']=1;
            }
        }

        return $results;

    }

    public function get_group_time($time_ids){
        $nowtime = time();
        $conditions=array();
        $conditions['status_delete']=1;
        $conditions['id']=array('in',$time_ids);
        $results=$this->where($conditions)->field('id,order_size,end_time')->select();

        // var_dump($nowtime);
        foreach ($results as $key => $value) {
            if($results[$key]['end_time']>$nowtime){
                $results[$key]['overdue']=1;
            }
        }

        // var_dump($results);
        return $results;
    }

    
    public function get(){
        extract(generateRequestParamVars());
        $conditions=array();
        $conditions['status_delete']=1;//屏蔽逻辑删除
        $results=$this->where($conditions)->select();
        return $results;
    }

    
    

    public function dele(){
            extract(generateGetParamVars());
            if(!$id){
                throw new \Exception(L('MISSING_PARAMETER')); ;
            }
            $conditions['id']=intval($id);
            if(!$result=$this->where($conditions)->find()){
                throw new \Exception(L('NO_DATA'));
            }
            $conditions=array();
            $conditions['id']=$id;
            $data=array();
            $data['status_delete']=0;
            if($this->where($conditions)->save($data)===false){
               throw new \Exception(L('OPERATION_FAILED'));
            }
    }      


    public function lists(){
        extract(generateRequestParamVars());
        
        $conditions=array();
        //0是删除 1是显示
        $conditions['status_delete']=1;
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
        
        foreach ($results as $key => $value) {
            if($results[$key]['mail_id']==1){
                $results[$key]['mail_id']="food";
            }else if($results[$key]['mail_id']==2){
                $results[$key]['mail_id']="kuose";
            }else if($results[$key]['mail_id']==3){
                $results[$key]['mail_id']="smoke";
            }
        }
        
        return array($paging,$results);
    }

       
    public function raedit(){
        extract(generateRequestParamVars());

        $shuziyz='/^\d+$/';
        $xiaoshudian='/^\d+(\.\d+)?$/';
        if($id && preg_match($shuziyz,$order_size) && preg_match($xiaoshudian,$group_price) && preg_match($shuziyz,$start_time) && preg_match($shuziyz,$end_time)){
            $data=array();
            $data['order_size']=$order_size;
            $data['start_time']=$start_time;
            $data['end_time']=$end_time;
            $data['group_price']=$group_price;
            $conditions=array();
            $conditions['id']=$id;
            if(!$this->where($conditions)->save($data)){
                // echo $this->_sql();
                throw new \Exception(L('OPERATION_FAILED'));
            }
        }else{
            throw new \Exception(L('缺少数据或者不是数字'));
            }

    }

     
    public function adds(){
        extract(generateRequestParamVars());
        if($id){
            $conditions=array();
            $conditions['id']=$id;
            $result=D('commodity')->where($conditions)->find();

            if($result['is_spell_group']==1){
                throw new \Exception(L('此商品正在活动'));
            }else{
                $is_spell_group = 1;
                $shuziyz='/^\d+$/';
                $xiaoshudian='/^\d+(\.\d+)?$/';
                if($id && preg_match($shuziyz,$order_size) && preg_match($xiaoshudian,$group_price) && preg_match($shuziyz,$start_time) && preg_match($shuziyz,$end_time)){
                    $data=array();
                    $data['commodity_id']=$id;
                    $data['order_size']=$order_size;
                    $data['start_time']=$start_time;
                    $data['end_time']=$end_time;
                    $data['group_price']=$group_price;
                    $data['status_delete']=1;
                    $data['create_time']=time();
                    if(!$this->add($data)){
                        // echo $this->_sql();
                        throw new \Exception(L('OPERATION_FAILED'));
                    }
                }else{
                    throw new \Exception(L('缺少数据或者不是数字'));
                    }

            }
        }

        return $is_spell_group;
        
    }

    public function timeeetection(){

        $nowtime = time();
        $conditions=array();
        $conditions['status_delete']=1;//屏蔽逻辑删除
        $conditions['end_time']<$nowtime;
        $results=$this->where($conditions)->field('id,order_size')->select();

        

        $a=array();
        foreach ($results as $key => $value) {
            array_push($a,$results[$key]['id']);
            
        }

        $conditionss=array();
        $conditionss['group_id']=array('in',$a);
        $conditionss['status_delete']=1;//屏蔽逻辑删除
        // $codelists=D('SpellGroupCode')->where($conditionss)->field('id,order_size')->select();
        

        // $data=array();
        // $data['is_spell_group']=1;
        // $conditions=array();
        // $conditions['id']=$id;
        // if(!D(self::$COMMODITY_MODEL)->where($conditions)->save($data)){
        //     echo $this->_sql();
        //     throw new \Exception(L('OPERATION_FAILED'));
        // }


        // var_dump($orderselect);

        $nowtime = $results;
         return $nowtime;

    }

  
   
}