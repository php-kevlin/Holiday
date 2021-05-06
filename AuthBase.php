<?php
namespace app\api\controller;



class AuthBase extends ApiBase{

    public $accessToken = "";
    public $userId =0;
    public function initialize()
    {
        parent::initialize();
        $this->accessToken = $this->request->header("Access-Token");

        if (!$this->accessToken || !$this->islogin()){
            return $this->show(-1,"没有登陆");
        }
    }

    /**
     * 判断用户是否登陆
     * @return bool
     */
    public function islogin()
    {
        $userinfo = cache(config('redis.token_pre').$this->accessToken);
        if (!$userinfo){
            return false;
        }
        if (!empty($userinfo['id'])){
            $this->userId = $userinfo['id'];
            return true;
        }
        return false;
    }
}
