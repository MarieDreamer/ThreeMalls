<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class OrderModel extends CommonMAbstract {

    //订单列表
    public function lists(){
        extract(generateRequestParamVars());
        
        $conditions=array();
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
            if($results[$key]['status']==0){
                $results[$key]['status']="未付款";
            }else if($results[$key]['status']==1){
                $results[$key]['status']="待发货";
            }else if($results[$key]['status']==2){
                $results[$key]['status']="待收货";
            }else if($results[$key]['status']==3){
                $results[$key]['status']="已完成";
            }
        }
        

        return array($paging,$results);
    }

    public function detail(){
        extract(generateRequestParamVars());
        $results = $this->find($order_id);
        return $results;
    }
   
    //by 吴俊锋 2018-8-27 11：02
    public function get_order_number($ids){
        $conditions=array();
        $conditions['group_id']=array('in',$ids);
        $results=$this->where($conditions)->field('group_id,order_size,count(group_id)')->group('group_id,order_size')->select();
        return $results;
    }

    //by 单宇瀚 2018-8-27 16：40
    public function group_status_change($change_id){
        $data=array();
	    $data['status']=3;
	    $conditions=array();
	    $conditions['group_id']=$change_id;
	    if(D('order')->where($conditions)->save($data)===false){
	        // echo D('order')->_sql();
	        throw new \Exception(D('order')->_sql());
	    }
    }

    //修改物流（订单）状态
    public function changeStatus()
    {
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['id'] = $id;
        $data = [];
        $data['status'] = $status;
        if($this->where($conditions)->save($data) === false){
            throw new \Exception("OPERATION_FAILED");
        }
    }

    public function editAddress()
    {
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['id'] = (int)$order_id;
        $data = [];
        $data['address'] = $value;
        if($this->where($conditions)->save($data) === false){
            throw new \Exception("OPERATION_FAILED");
        }
    }
}