<?php

namespace app\modules\account\tests\_support\services;

use Yii;
use yii\web\IdentityInterface;
use app\modules\account\services\interfaces\IAuthService;
use app\modules\account\models\User;
use app\modules\account\services\UserIdentity;

class AuthService implements IAuthService
{
    /**
     * @inheritdoc
     */
    public function login(IdentityInterface $user, $rememberMe = false)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function generateAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function logout()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUserIdentity()
    {
        $items = require __DIR__ . '/../../_data/users.php';
        return new UserIdentity(new User($items[0]));
    }
}