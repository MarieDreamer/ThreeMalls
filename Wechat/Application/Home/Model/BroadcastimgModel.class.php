<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class BroadcastimgModel extends CommonMAbstract {

    //取轮播图
    public function lists(){
        extract(generateRequestParamVars());
        $conditions=[];
        //0是删除 1是显示
        $conditions['status_delete']=1;
        $conditions['class']=$class;
        $lists = $this->where($conditions)->order('id asc')->field('id,img,url')->select();

        foreach ($lists as $key => $value) {
            $lists[$key]['img'] = json_decode($lists[$key]['img'],true);
        }
        return $lists;
    }
   
}