<?php

use Yii;
use app\modules\account\models\User;

class UserStorageTest extends \Codeception\Test\Unit
{
    private $userStorage;
    
    protected function _before()
    {
        $this->userStorage = Yii::createObject('app\modules\account\storages\UserStorage');
        $this->fillTable();
    }

    protected function _after()
    {
        User::deleteAll();
    }

    // tests
    public function testFindByExistentUsername()
    {
        $username = 'user_2';
        $user = $this->userStorage->findByUsername($username);
        $this->assertEquals($user->username, $username);
    }

    public function testFindByNonExistentUsername()
    {
        $username = 'non_existent_username';
        $user = $this->userStorage->findByUsername($username);
        $this->assertNull($user);
    }

    public function testFindByExistentId()
    {
        $id = 3;
        $user = $this->userStorage->findOne($id);
        $this->assertEquals($user->id, $id);
    }

    public function testFindByNonExistentId()
    {
        $id = 99;
        $user = $this->userStorage->findOne($id);
        $this->assertNull($user);
    }

    public function testSaveUser()
    {
        $balance = 100.39;
        $user = $this->userStorage->findOne(2);
        $user->balance = $balance;
        $this->assertTrue($this->userStorage->save($user));
    }

    private function fillTable()
    {
        $fixtures = require __DIR__ . '/../_data/users.php';
        Yii::$app->db
            ->createCommand()
            ->batchInsert(User::tableName(), [
                'id',
                'username',
                'auth_key',
                'balance'
            ], $fixtures)
            ->execute();
    }
}