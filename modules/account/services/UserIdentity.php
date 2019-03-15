<?php

namespace app\modules\account\services;

use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use app\modules\account\storages\UserStorageBuilder;
use app\modules\account\models\User;

class UserIdentity implements IdentityInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user->auth_key;
    }

    public function getUsername()
    {
        return $this->user->username;
    }

    public function getBalance()
    {
        return $this->user->balance;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $userStorageBuilder = new UserStorageBuilder();
        $userStorage = $userStorageBuilder->build();
        if($user = $userStorage->findOne($id)) {
            return new self($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
}