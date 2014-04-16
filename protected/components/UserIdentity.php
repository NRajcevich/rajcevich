<?php

class UserIdentity extends CUserIdentity {
    const ERROR_USERNAME_NOT_ACTIVE = 3;

    protected $_id;

    public function authenticate(){
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if(($user===null) || (md5($this->password)!==$user->password)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if($user->block == 0){
            $this->errorCode=self::ERROR_USERNAME_NOT_ACTIVE;
        }
        else {

            $this->_id = $user->id;

            $this->username = $user->first_name.' '.$user->last_name;

            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;;
    }

    public function getId(){
        return $this->_id;
    }
}