<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class EvaluationModel extends CommonMAbstract {

    public function lists(){
        extract(generateRequestParamVars());
        $conditions=[];
        $conditions['status_delete']=1;
        $conditions['commodity_id']=$commodity_id;
        if($star_level != null){
            $conditions['star_level'] = $star_level;
        }
        $lists = $this->where($conditions)->order('create_time desc')->select();
        foreach($lists as $key => $value){
            $lists[$key]['image'] = json_decode($lists[$key]['image'],true);
        }
        return $lists;
    }

}