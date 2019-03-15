<?php

use Yii;
use app\modules\account\forms\EntryForm;

class SignInServiceTest extends \Codeception\Test\Unit
{
    private $signInService;
    
    protected function _before()
    {
        $this->signInService = Yii::createObject('app\modules\account\services\SignInService');
    }

    protected function _after()
    {
    }

    // tests
    public function testSignIn()
    {
        $form = new EntryForm();
        $form->username = 'user_2';
        $this->assertTrue($this->signInService->signIn($form));
    }

    public function testCreateUser()
    {
        $form = new EntryForm();
        $form->username = 'user_new';
        $form->rememberMe = 1;
        $user = $this->signInService->createUser($form);
        $this->assertEquals($user->username, $form->username);
        $this->assertNotEmpty($user->auth_key);
        $this->assertEquals($user->balance, 0);
    }
}