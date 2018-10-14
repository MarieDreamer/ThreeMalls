<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class SpellGroupController extends Controller{


    static $SPELLGROUP_MODEL='SpellGroup';
    static $COMMODITY_MODEL='commodity';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }
    
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        list($paging, $results) = D(self::$SPELLGROUP_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }


    public function dele_do(){
        try{
            // echo "123";
            validateUnLoginRedirect();
            checkAjaxAccess('commodity','delete');
            D(self::$SPELLGROUP_MODEL)->dele();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function raedit(){
        validateUnLoginRedirect();
        checkAccess('category','edit');
        $result=D(self::$SPELLGROUP_MODEL)->getResultByConditions(array('id'=>I('get.id')));
        $result['start_time']=date("Y-m-d H:i:s",$result['start_time']);
        $result['end_time']=date("Y-m-d H:i:s",$result['end_time']);
        $this->assign('category',$category);
        $this->assign('result',$result);
        $this->display();
    }

    public function raedit_do(){
        try{
            // echo "123123132";
            validateUnLoginRedirect();
            D(self::$SPELLGROUP_MODEL)->raedit();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';

        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function adds_do(){
        extract(generateRequestParamVars());
        try{
            validateUnLoginRedirect();
            $is_spell_group=D(self::$SPELLGROUP_MODEL)->adds();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['is_spell_group']=$is_spell_group;
            // $ajaxReturnData['id']=$id;
            if($is_spell_group==1){
                $ajaxReturnData['id']=$id;
                $data=array();
                $data['is_spell_group']=1;
                $conditions=array();
                $conditions['id']=$id;
                if(!D(self::$COMMODITY_MODEL)->where($conditions)->save($data)){
                    echo $this->_sql();
                    throw new \Exception(L('OPERATION_FAILED'));
                }

            }

        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

     public function timeeetection(){
        try{
            // echo "123123132";
            validateUnLoginRedirect();
            $nowtime=D(self::$SPELLGROUP_MODEL)->timeeetection();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['nowtime']=$nowtime;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }



    

}

    