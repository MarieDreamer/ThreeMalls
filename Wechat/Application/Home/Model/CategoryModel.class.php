<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class CategoryModel extends CommonMAbstract {

      public function lists(){
        extract(generateRequestParamVars());

        $conditions=[];
        //0是删除 1是显示
        $conditions['status_delete']=1;
        $conditions['mall_id']=$mall_id;

        //是否主类
        if($pid != null){
            $conditions['pid']=$pid;
        }
        $lists = $this->where($conditions)->order('id asc')->select();
        foreach($lists as $key => $value){
            $lists[$key]['category_img'] = json_decode($lists[$key]['category_img'],true);
        }

        return $lists;
    }

}