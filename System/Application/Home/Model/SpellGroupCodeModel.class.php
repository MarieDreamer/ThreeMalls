<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SpellGroupCodeModel extends CommonMAbstract {

    public function lists(){
            extract(generateRequestParamVars());
            
            $conditions=array();
            $conditions['group_user_id']=$id;
            $conditions['mall_id']=$mall_id;
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
                if($results[$key]['mall_id']==1){
                    $results[$key]['mall_id']="食品";
                }else if($results[$key]['mall_id']==2){
                    $results[$key]['mall_id']="阔色";
                }else if($results[$key]['mall_id']==3){
                    $results[$key]['mall_id']="烟酒";
                }
                if($results[$key]['group_status']==0){
                    $results[$key]['group_status']="已删除";
                }
                if($results[$key]['group_status']==1){
                    $results[$key]['group_status']="正在拼团";
                }
                if($results[$key]['group_status']==2){
                    $results[$key]['group_status']="拼团成功";
                }
                if($results[$key]['group_status']==3){
                    $results[$key]['group_status']="拼团失败";
                }
            }
            

            return array($paging,$results);
        }
   
    //by 吴俊锋 2018-8-27 11：02
    public function get_unstatus(){
        $conditions=array();
        $conditions['group_status']=1;
        $results=$this->where($conditions)->field('id,group_num,group_id')->select();
        return $results;
    }

    //by 单宇瀚 2018-8-27 16：40
    public function group_status_change($change_id){
        $data=array();
        $data['group_status']=3;
        $conditions=array();
        $conditions['group_id']=$change_id;
        if($this->where($conditions)->save($data)===false){
            echo $this->_sql();
            throw new \Exception($this->_sql());
        }
    }
    
    public function timeeetection(){

        $nowtime = time();
        $a=array();

        $conditions=array();
        $conditions['group_status']=1;
        $results=$this->where($conditions)->field('id,group_num,group_id')->select();

        if($results){
            foreach ($results as $key => $value) {
                $conditionss=array();
                $conditionss['status_delete']=1;
                $conditionss['id']=$results[$key]['group_id'];

                // var_dump($results[$key]['group_id']);
                $spellgrouplists=D('SpellGroup')->where($conditionss)->field('id,order_size')->select();

                foreach ($spellgrouplists as $k => $v) {

                    //满足拼团条件
                    if($results[$key]['group_num']==$spellgrouplists[$k]['order_size']){
                        $data=array();
                        $data['group_status']=2;
                        $conditionsss=array();
                        $conditionsss['id']=$results[$key]['id'];
                        if(!$this->where($conditionsss)->save($data)){
                            // echo $this->_sql();
                            throw new \Exception(L('OPERATION_FAILED1'));
                        }
                        // var_dump("111111111111111");
                        // $conditionss2=array();
                        // $conditionss2['group_id']=$results[$key]['group_id'];
                        // $orderlists=D('Order')->where($conditionss2)->field('id')->select();

                        // foreach ($orderlists as $ko => $vo) {
                        //     array_push($a,$orderlists[$ko]['id']);
                        // }
                        // $data2=array();
                        // $data2['status']=0;
                        // $conditionsso=array();
                        // $conditionsso['group_id']=array('in',$a);
                        // if(!D('Order')->where($conditionsso)->save($data2)){
                        //     // echo $this->_sql();
                        //     throw new \Exception(L('OPERATION_FAILED'));
                        // }

                    }

                    // 到达时间以后不满足人数
                    if ($results[$key]['group_num']<$spellgrouplists[$k]['order_size'] && $spellgrouplists[$k]['end_time']<$nowtime) {
                        $data=array();
                        $data['group_status']=3;
                        $conditionsss=array();
                        $conditionsss['id']=$results[$key]['id'];

                        if(!$this->where($conditionsss)->save($data)){
                            // echo $this->_sql();
                            throw new \Exception(L('OPERATION_FAILED2'));
                        }

                        // var_dump("dsadasdasd");

                        $conditionssss=array();
                        $conditionssss['group_id']=$spellgrouplists[$k]['id'];
                        // echo $this->_sql();
                        $orderlists=D('order')->where($conditionssss)->select();
                        foreach ($orderlists as $ko => $vo) {
                            array_push($a,$orderlists[$ko]['id']);
                        }

                        $data2=array();
                        $data2['status']=3;
                        $conditionsso=array();
                        $conditionsso['id']=array('in',$a);
                        if(D('order')->where($conditionsso)->save($data2)===false){
                            // echo D('order')->_sql();
                            throw new \Exception(D('order')->_sql());
                        }
                    }
                }
            }
        }else{
            throw new \Exception(L('OPERATION_FAILED3'));
        }
        

        

        // $a=array();
        // foreach ($results as $key => $value) {
        //     array_push($a,$results[$key]['id']);
            
        // }

        // $conditionss=array();
        // $conditionss['group_id']=array('in',$a);
        // $conditionss['status_delete']=1;
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

        $nowtime = $orderlists;
         return $nowtime;

    }

  
   
}