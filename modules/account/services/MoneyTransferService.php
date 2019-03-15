<?php

namespace app\modules\account\services;

use app\modules\account\forms\MoneyTransferForm;
use app\modules\account\services\interfaces\IAuthService;
use app\modules\account\storages\interfaces\IUserStorage;
use app\custom\services\transaction\ITransaction;
use app\modules\account\AccountModule as M;

class MoneyTransferService
{
    private $authService;

    private $userStorage;

    private $transaction;

    public function __construct(
        IUserStorage $userStorage,
        IAuthService $authService,
        ITransaction $transaction
    ) {
        $this->userStorage = $userStorage;
        $this->authService = $authService;
        $this->transaction = $transaction;
    }
 
    public function createForm()
    {
        $userIdentity = $this->authService->getCurrentUserIdentity();
        return new MoneyTransferForm($userIdentity->getBalance());
    }

    public function transfer(MoneyTransferForm $form)
    {
        $sender = $this->getSenderModel();
        $recipient = $this->userStorage->findByUsername($form->recipient);
        if(!$this->isRecipientValid($sender, $recipient, $form)) {
            return false;
        }
    
        return $this->sendMoney($sender, $recipient, $form);
    }

    private function getSenderModel()
    {
        $userIdentity = $this->authService->getCurrentUserIdentity();
        if($sender = $this->userStorage->findOne($userIdentity->getId())) {
            return $sender;
        }

        throw new \yii\web\ForbiddenHttpException('Permission denied.');
    }

    private function isRecipientValid($sender, $recipient, MoneyTransferForm $form)
    {
        if(!$recipient) {
            $form->addError('recipient', M::t('Recipient is not found.'));
            return false;
        }

        if($recipient->id == $sender->id) {
            $form->addError('recipient', M::t('Cannot send money to yourself.'));
            return false;
        }

        return true;
    }

    private function sendMoney($sender, $recipient, MoneyTransferForm $form)
    {
        $this->transaction->begin();
        $sender->balance -= $form->transferSum;
        $recipient->balance += $form->transferSum;
        if($this->userStorage->save($sender) && $this->userStorage->save($recipient)) {
            $form->balance = $sender->balance;
            $this->transaction->commit();
            return true;
        }

        $this->transaction->rollback();
        return false;
    }
}