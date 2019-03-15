<?php

use app\modules\account\models\User;
use app\modules\account\forms\EntryForm;
use app\modules\account\mappers\UserMapper;

class UserMapperTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
    }

    // tests
    public function testGetUserModelFromEntryForm()
    {
        $form = new EntryForm();
        $form->username = 'some_name';
        $mapper = new UserMapper();
        $user = $mapper->getUserModelFromEntryForm($form);
        $this->assertEquals($user->username, $form->username);
    }
}