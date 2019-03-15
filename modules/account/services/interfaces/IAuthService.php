<?php

namespace app\modules\account\services\interfaces;

use yii\web\IdentityInterface;

interface IAuthService
{
    /**
     * login user in system
     * 
     * @param IdentityInterface $user
     * @param bool $rememberMe
     */
    public function login(IdentityInterface $user, $rememberMe = false);

    /**
     * logout current authorized user
     * 
     * @return bool
     */
    public function logout();

    /**
     * generates random string for auth key
     * 
     * @return string
     */
    public function generateAuthKey();

    /**
     * returns authorized user identity
     * 
     * @return IdentityInterface
     */
    public function getCurrentUserIdentity();
}