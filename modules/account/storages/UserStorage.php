<?php

namespace app\modules\account\storages;

use app\modules\account\storages\interfaces\IUserStorage;
use app\modules\account\models\User;

class UserStorage implements IUserStorage
{
    /**
     * @inheritdoc
     */
    public function findByUsername($username)
    {
        return User::find()
            ->where(['username' => $username])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function findOne($id)
    {
        return User::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public function save(User $model)
    {
        return $model->save();
    }
}