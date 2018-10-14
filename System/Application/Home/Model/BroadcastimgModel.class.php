<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class BroadcastimgModel extends CommonMAbstract {
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
                if($results[$key]['class']==1){
                    $results[$key]['class']="食品商城首页轮播图";
                }elseif ($results[$key]['class']==2) {
                    $results[$key]['class']="食品商城活动展示图";
                }elseif ($results[$key]['class']==3) {
                    $results[$key]['class']="衣服商城首页轮播图";
                }elseif ($results[$key]['class']==4) {
                    $results[$key]['class']="衣服商城活动展示图";
                }elseif ($results[$key]['class']==5) {
                    $results[$key]['class']="烟酒商城首页轮播图";
                }elseif ($results[$key]['class']==6) {
                    $results[$key]['class']="烟酒商城活动展示图";
                }
            }
            
            
            return array($paging,$results);
        }

       
        public function raedit(){
            extract(generateRequestParamVars());
            //正整数正则
            $shuziyz='/^\d+$/';
                    $data=array();
                    if($img){
                        $data['img']=json_encode($img);
                    }
                    $data['url']=$url;
                    if($class){
                        $data['class']=$class;
                    }
                    $data['modify_time']=time();
                    $conditions=array();
                    $conditions['id']=$id;
                    if(!$this->where($conditions)->save($data)){
                        // echo $this->_sql();
                        throw new \Exception(L('OPERATION_FAILED'));
                    }
            
        }

     
    public function adds(){
        extract(generateRequestParamVars());
        //正整数正则
        $shuziyz='/^\d+$/';
        if($img){
                $data=array();
                $data['img']=json_encode($img);
                $data['url']=$url;
                $data['class']=$class;
                $data['status_delete']=1;
                $data['create_time']=time();
                if(!$this->add($data)){
                    // echo $this->_sql();
                    throw new \Exception(L('OPERATION_FAILED'));
                }
                
        }else{
            throw new \Exception(L('缺少数据'));
            }
        
    }

  
   
}