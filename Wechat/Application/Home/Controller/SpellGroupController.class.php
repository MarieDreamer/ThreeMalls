<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class SpellGroupController extends Controller{

    static $SPELL_GROUP='spell_group';

    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }
    
    public function adds_do(){
        try{
            D(self::$SPELL_GROUP)->adds_do();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

        
}

    