<?php
namespace Home\Model;
use Home\Abstracts\CommonMAbstract;

class WechatUserFoodModel extends CommonMAbstract {

    public function login_do($userid)
    {
        $conditions = array();
        $conditions['id'] = $userid;
        $data = array();
        $data['login_time'] = time();
        if($user=$this->where($conditions)->save($data)===false){
            echo $this->_sql();
            throw new \Exception('OPERATION_FAILED');
        }
    }

    public function save_do()
    {
        extract(generateRequestParamVars());
        $conditions = array();
        $conditions['id'] = $id;
        $data = array();
        $data['nickname']=$nickname;
        $data['imageurl']=$imageurl;
        $data['gender']=$gender;
        $data['province']=$province;
        $data['city']=$city;
        $data['country']=$country;
        if($this->where($conditions)->save($data)===false){
            echo $this->_sql();
            throw new \Exception('OPERATION_FAILED');
        }
        // echo $this->_sql();
    }

    public function adds_do($open_id)
    {
        $data = array();
        $data['openid'] = $open_id;
        $data['status_delete'] = 1;
        $data['create_time'] = time();
        $data['login_time'] = time();
        $user = $this->add($data);
        if ($user === false) {
            // echo $this->_sql();
            throw new \Exception('OPERATION_FAILED');
        }
        return $user;
    }

    public function share_do()
    {
        extract(generateRequestParamVars());
        $conditions = [];
        $conditions['id'] = $user_id;
        $data = array();
        $data['is_share'] = 1;
        if ($this->where($conditions)->save($data) === false) {
            throw new \Exception('OPERATION_FAILED');
        }
    }

}