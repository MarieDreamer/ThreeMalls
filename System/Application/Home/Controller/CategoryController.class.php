<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class CategoryController extends Controller{


    // static $Photo_Album='PhotoAlbum';
    static $COUPON_MODEL='coupon';
    static $CATEGORY_MODEL='category';
    static $WECHAT_USER_MODEL='WechatUser';
    
    public function __construct(){
        // validateUnLoginRedirect();
        parent::__construct();
    }

    public function listscategory_id(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        try{
            $lists = D(self::$CATEGORY_MODEL)->listscategory_id();

            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['lists']=$lists;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }



    public function listsmail_id(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        try{
            $lists = D(self::$CATEGORY_MODEL)->listsmail_id();

            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
            $ajaxReturnData['lists']=$lists;
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    
    public function get_do(){
        try {
            // validateUnLoginRedirect();
            $results=D(self::$CATEGORY_MODEL)->getzi();
            $ajaxReturnData['status'] = 1;
            $ajaxReturnData['message'] = '操作成功';
            $ajaxReturnData['results'] = $results;
        } catch (\Exception $e) {
            $ajaxReturnData['status'] = 0; 
            $ajaxReturnData['message'] = '操作失败,' . $e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);

    }

    //类别管理页面显示
    public function lists(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        checkAccess('category','view');
        list($paging, $results) = D(self::$CATEGORY_MODEL)->lists();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }

    //子类别管理页面显示
    public function listspid(){
        extract(generateRequestParamVars());
        validateUnLoginRedirect();
        checkAccess('category','view');
        list($paging, $results) = D(self::$CATEGORY_MODEL)->listspid();
        $this->assign('paging', $paging);
        $this->assign('results', $results);
        $this->display();
    }
    

    //图片删除
    public function dele_do(){
        try{
            // echo "123";
            validateUnLoginRedirect();
            checkAjaxAccess('category','delete');
            D(self::$CATEGORY_MODEL)->dele();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //修改类目页面显示
    public function raedit(){
        validateUnLoginRedirect();
        checkAccess('category','edit');
        $result=D(self::$CATEGORY_MODEL)->getResultByConditions(array('id'=>I('get.id')));
        $result['content']=json_decode($result['content'],true);
        $this->assign('result',$result);
        $this->display();
    }

    public function raedit2(){
        validateUnLoginRedirect();
        checkAccess('category','edit');
        $result=D(self::$CATEGORY_MODEL)->getResultByConditions(array('id'=>I('get.id')));
        $result['content']=json_decode($result['content'],true);
        $this->assign('result',$result);
        $this->display();
    }

    public function raedit_do(){
        try{
            validateUnLoginRedirect();
            D(self::$CATEGORY_MODEL)->raedit();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    public function raedit_do2(){
        try{
            // echo "123123132";
            validateUnLoginRedirect();
            D(self::$CATEGORY_MODEL)->raedit_do2();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }


    //添加类目页显示
    public function adds(){
        validateUnLoginRedirect();
        checkAccess('category','adds');
        $this->display();
    }
    //添加主类目
    public function adds_do(){
        try{
            validateUnLoginRedirect();
            D(self::$CATEGORY_MODEL)->adds();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    //添加子类
    public function adds_do2(){
        try{
            validateUnLoginRedirect();
            D(self::$CATEGORY_MODEL)->adds2();
            $ajaxReturnData['status']=1;
            $ajaxReturnData['message']='操作成功';
        }catch(\Exception $e){
            $ajaxReturnData['status']=0;
            $ajaxReturnData['message']='操作失败'.$e->getMessage();
        }
        $this->ajaxReturn($ajaxReturnData);
    }

    

}

    