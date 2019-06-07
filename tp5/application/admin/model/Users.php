<?php

namespace app\admin\model;

use think\Model;

class Users extends Model
{
    /**
     * @param array $data
     * @return bool
     */
    public function checkUser(array $data)
    {
        $ret = $this->where('username', $data['username'])->find();
        if (!$ret) {
            return false;
        }
        $pwd = $ret['password'];
        $inputPassword = md5($data['password']);
        if ($pwd != $inputPassword) {
            return false;
        }
        session('admin.user', $ret);
        return true;
    }
}
