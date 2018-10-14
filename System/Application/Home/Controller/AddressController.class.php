<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class AddressController extends Controller{


    static $ADDRESS_MODEL='Address';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        list($paging, $results) = D(self::$ADDRESS_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }


    public function dele_do(){
        try{
            // echo "123";
            validateUnLoginRedirect();
            checkAjaxAccess('commodity','delete');
            D(self::$ADDRESS_MODEL)->dele();
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
        $result=D(self::$ADDRESS_MODEL)->getResultByConditions(array('id'=>I('get.id')));
        $result['content']=json_decode($result['content'],true);
        // var_dump($category);
        $this->assign('category',$category);
        $this->assign('result',$result);
        $this->display();
    }

    public function raedit_do(){
        try{
            // echo "123123132";
            validateUnLoginRedirect();
            D(self::$ADDRESS_MODEL)->raedit();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }



    

}

    