<?php

use app\modules\account\services\UserIdentity;

class UserIdentityTest extends \Codeception\Test\Unit
{
    private $user;

    private $userIdentity;
    
    protected function _before()
    {
        $userStorage = Yii::createObject('app\modules\account\storages\interfaces\IUserStorage');
        $this->user = $userStorage->findOne(3);
        $this->userIdentity = new UserIdentity($this->user);
    }

    protected function _after()
    {
    }

    // tests
    public function testProperties()
    {
        $this->assertEquals($this->userIdentity->getId(), $this->user->id);
        $this->assertEquals($this->userIdentity->getAuthKey(), $this->user->auth_key);
        $this->assertEquals($this->userIdentity->getUsername(), $this->user->username);
        $this->assertEquals($this->userIdentity->getBalance(), $this->user->balance);
    }
}