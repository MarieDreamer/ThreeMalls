<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class DistributorModel extends CommonMAbstract {

    //获取分销状态
    //参数 $user_id $mall_id
    public function getStatus(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['user_id'] = $user_id;
        $conditions['mall_id'] = $mall_id;
        $destributor = $this->where($conditions)->find();
        if(!$destributor){
            $status = 3;
        }else{
            $status = $destributor['status'];
        }
        return $status;
    }

    //添加分销员
    //参数 $user_id $mobile $mall_id
    public function adds_do(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['user_id'] = $user_id;
        $conditions['mall_id'] = $mall_id;
        if($this->where('user_id='.$user_id)->find()){
            throw new \Exception('重复申请');
        }
        $data = [];
        $data['user_id'] = $user_id;
        $data['mall_id'] = $mall_id;
        $data['mobile'] = $mobile;
        $data['status'] = 0;
        $data['create_time'] = time();
        if($this->add($data) === false){
            throw new \Exception($this->_sql());
        }
    }

    

}