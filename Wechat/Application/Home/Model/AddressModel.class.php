<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class AddressModel extends CommonMAbstract {

    //修改地址&添加地址
    public function modify_do(){
        extract(generateRequestParamVars());
        if($name && $phone && $province && $address && $id && $default){
            if($default == 'true'){
                $data = [];
                $data['default'] = 0;
                $condition = [];
                $condition['default'] = 1;
                if($this->where($condition)->save($data)===false){
                    throw new \Exception('取消其他默认地址失败');
                }
            }
            $data=array();
            $data['name']=$name;
            $data['phone']=$phone;
            $data['province']=$province;
            $data['address']=$address;
            $data['default']=$default == 'true'?1:0;
            $condition=array();
            $condition['id']=$id;
            if($this->where($condition)->save($data)===false){
                throw new \Exception('添加地址失败');
            }
            
        }else{
            throw new \Exception(L("缺少数据"));
        }
            

    }

    public function getAddress(){
        extract(generateRequestParamVars());
        $data = $this->find($id);
        return $data;
    }

    //取保存的地址
    public function lists(){
        extract(generateRequestParamVars());
        $conditions=[];
        //0是删除 1是显示
        $conditions['status_delete']=1;
        $conditions['mall_id']=$mall_id;
        $conditions['userid']=$userid;
        $lists = $this->where($conditions)
        ->order(array('default'=>'desc','id'=>'desc'))
        ->select();
        return $lists;
    }

    //默认地址修改
    public function defaultchange(){
        extract(generateRequestParamVars());
        $conditions=array();
        $conditions['userid']=$userid;
        $conditions['default']=1;
        $conditions['status_delete']=1;
        $lists = $this->where($conditions)->order('id desc')->select();

        foreach ($lists as $key => $value) {
            $lists = $lists[$key]['id'];
        }

        if($lists){
            $data=array();
            $data['default']=0;
            $conditionsfirst=array();
            $conditionsfirst['id']=$lists;
            if(!$this->where($conditionsfirst)->save($data)){
                echo $this->_sql();
                throw new \Exception(L('OPERATION_FAILED'));
            }
        }

        if($userid && $id){
            $dataecond=array();
            $dataecond['default']=1;
            $conditionsecond=array();
            $conditionsecond['id']=$id;
            $conditionsecond['userid']=$userid;
            if(!$this->where($conditionsecond)->save($dataecond)){
                // echo $this->_sql();
                throw new \Exception(L('OPERATION_FAILED'));
            }
        }else{
            throw new \Exception(L('缺少数据'));
            }
    }

    ///删除地址
    public function deletefun(){
        extract(generateRequestParamVars());
        //正整数正则
        // $shuziyz='/^\d+$/';
        if($id){
            $data=array();
            $data['status_delete']=0;
            $conditions=array();
            $conditions['id']=$id;
            if(!$this->where($conditions)->save($data)){
                throw new \Exception('地址逻辑删除失败');
            }
        }else{
            throw new \Exception(L('缺少数据'));
        }
    }

    //添加地址
    public function adds(){
        extract(generateRequestParamVars());
        if($default == 'true'){
            $default = 1;
        }
        if($default == 'false'){
            $default = 0;
        }
        //如果是第一次添加，设置为默认
        $conditions=[];
        $conditions['status_delete']=1;
        $conditions['userid']=$userid;
        $conditions['mall_id']=$mall_id;
        $lists = $this->where($conditions)->select();
        if(!$lists){
            $default = 1;
        }
        //如果设为默认，设置其他为非默认
        if($default){
            $data = [];
            $data['default'] = 0;
            $condition = [];
            $condition['default'] = 1;
            $condition['userid'] = $userid;
            $condition['mall_id'] = $mall_id;
            if($this->where($condition)->save($data)===false){
                throw new \Exception('取消其他默认地址失败');
            }
        }
        if($userid && $name && $phone && $province && $address && $mall_id){
            $data=array();
            $data['userid']=$userid;
            $data['name']=$name;
            $data['phone']=$phone;
            $data['province']=$province;
            $data['address']=$address;
            $data['default']=$default;
            $data['mall_id']=$mall_id;
            $data['status_delete']=1;
            $data['create_time']=time();
            if(!$this->add($data)){
                throw new \Exception('添加地址失败');
            }
        }else{
            throw new \Exception(L('缺少数据'));
        }
        
    }

}