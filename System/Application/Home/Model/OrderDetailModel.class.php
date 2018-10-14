<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class OrderDetailModel extends CommonMAbstract {

    public function lists(){
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['order_id'] = $order_id;
        $results = $this->where($conditions)->select();
        return $results;
    }
   
}