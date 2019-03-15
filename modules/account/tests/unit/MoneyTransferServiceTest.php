<?php

use Yii;

class MoneyTransferServiceTest extends \Codeception\Test\Unit
{
    private $moneyTransferService;

    private $authService;

    private $form;

    protected function _before()
    {
        $this->moneyTransferService = Yii::createObject('app\modules\account\services\MoneyTransferService');
        $this->authService = Yii::createObject('app\modules\account\services\interfaces\IAuthService');
        $this->form = $this->moneyTransferService->createForm();
    }

    protected function _after()
    {
    }

    public function testCreateForm()
    {
        $this->assertInstanceOf('app\modules\account\forms\MoneyTransferForm', $this->form);
    }

    public function testTransferToSameAccount()
    {
        $this->form->transferSum = 20;
        $this->form->recipient = 'user_1';
        $this->assertFalse($this->moneyTransferService->transfer($this->form));
        $this->assertArrayHasKey('recipient', $this->form->errors);
    }

    public function testTransferToNonExistentAccount()
    {
        $this->form->transferSum = 20;
        $this->form->recipient = 'unknown_user';
        $this->assertFalse($this->moneyTransferService->transfer($this->form));
        $this->assertArrayHasKey('recipient', $this->form->errors);
    }

    public function testSuccessfullyTransfer()
    {
        $balance = $this->form->balance;
        $transferSum = 20;
        $this->form->transferSum = $transferSum;
        $this->form->recipient = 'user_2';
        $this->assertTrue($this->moneyTransferService->transfer($this->form));
        $this->assertEquals($this->form->balance, $balance - $transferSum);
    }
}