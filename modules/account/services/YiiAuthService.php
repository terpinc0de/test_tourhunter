<?php

namespace app\modules\account\services;

use Yii;
use yii\web\IdentityInterface;
use app\modules\account\services\interfaces\IAuthService;

class YiiAuthService implements IAuthService
{
    /**
     * @inheritdoc
     */
    public function login(IdentityInterface $user, $rememberMe = false)
    {
        return Yii::$app->user->login($user, $rememberMe ? Yii::$app->params['auth.lifeTime'] : 0);
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
        return Yii::$app->user->logout();
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUserIdentity()
    {
        return Yii::$app->user->identity;
    }
}