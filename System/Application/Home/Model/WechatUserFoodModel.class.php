<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class WechatUserFoodModel extends CommonMAbstract {

      

        //用户列表
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
                if($results[$key]['mall_id']==1){
                    $results[$key]['mall_id']="食品";
                }else if($results[$key]['mall_id']==2){
                    $results[$key]['mall_id']="阔色";
                }else if($results[$key]['mall_id']==3){
                    $results[$key]['mall_id']="烟酒";
                }
            }
            

            return array($paging,$results);
        }

     

}