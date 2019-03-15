<?php

namespace app\modules\account\tests\_support\storages;

use app\modules\account\storages\interfaces\IUserStorage;
use app\modules\account\models\User;

class UserStorage implements IUserStorage
{
    /**
     * @inheritdoc
     */
    public function findByUsername($username)
    {
        $items = require __DIR__ . '/../../_data/users.php';
        foreach($items as $item) {
            if($item['username'] == $username) {
                return new User($item);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function findOne($id)
    {
        $items = require __DIR__ . '/../../_data/users.php';
        foreach($items as $item) {
            if($item['id'] == $id) {
                return new User($item);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function save(User $model)
    {
        return true;
    }
}