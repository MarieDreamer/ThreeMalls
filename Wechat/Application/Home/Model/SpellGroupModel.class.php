<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class SpellGroupModel extends CommonMAbstract {

    public function adds_do(){
        extract(generateRequestParamVars());
        $data = [];
        $data['group_user_id'] = $user_id;
        $data['mall_id'] = $mall_id;
        $data['group_id'] = $group_id;
        $data['group_num'] = 1;
        $data['group_status'] = 1;

        if($this->add($data) === false){
            throw new \Exception('添加group失败');
        }
    }

}