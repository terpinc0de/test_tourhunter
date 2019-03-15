<?php

namespace app\modules\account\services;

use app\modules\account\forms\EntryForm;
use app\modules\account\storages\interfaces\IUserStorage;
use app\modules\account\services\interfaces\IAuthService;
use app\modules\account\services\UserIdentity;
use app\modules\account\mappers\UserMapper;
use app\modules\account\exceptions\AccountException;

class SignInService
{
    private $userStorage;

    private $authService;

    private $userMapper;

    public function __construct(
        IUserStorage $userStorage,
        IAuthService $authService,
        UserMapper $userMapper
    ) {
        $this->userStorage = $userStorage;
        $this->authService = $authService;
        $this->userMapper = $userMapper;
    }

    public function signIn(EntryForm $form)
    {
        $user = 
            $this->userStorage->findByUsername($form->username) ?:
            $this->createUser($form);
        
        return $this->authService->login(new UserIdentity($user), $form->rememberMe);
    }

    public function createUser(EntryForm $form)
    {
        $user = $this->userMapper->getUserModelFromEntryForm($form);
        $user->auth_key = $this->authService->generateAuthKey();
        if($this->userStorage->save($user)) {
            return $user;
        }

        throw new AccountException('Could not save new user.');
    }
}