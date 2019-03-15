<?php

namespace app\modules\account\storages\interfaces;

use app\modules\account\models\User;

interface IUserStorage
{
    /**
     * finds user by user name
     * 
     * @param string $username
     * @return User
     */
    public function findByUsername($username);

    /**
     * finds user by user id
     * 
     * @param int $id
     * @return User
     */
    public function findOne($id);

    /**
     * saves user model
     * 
     * @param User $model
     * @return bool
     */
    public function save(User $model);
}