<?php

use app\modules\account\exceptions\AccountException;
use app\modules\account\forms\MoneyTransferForm;

class MoneyTransferFormTest extends \Codeception\Test\Unit
{ 
    const INITIAL_BALANCE = 300;

    private $form;
    
    protected function _before()
    {
        $this->form = new MoneyTransferForm(self::INITIAL_BALANCE);
    }

    public function testWrongBalance()
    {
        try {
            new MoneyTransferForm(new \stdClass());
        } catch(AccountException $e) {
            $this->assertEquals(get_class($e), AccountException::class);
        }
    }

    public function testMaxTransferSum()
    {
        $this->assertEquals($this->form->getMaxTransferSum(), self::INITIAL_BALANCE - MoneyTransferForm::MIN_BALANCE);
    }

    public function testRecipientEmpty()
    {
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('recipient', $this->form->errors);
    }

    public function testTransferSumEmpty()
    {
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('transferSum', $this->form->errors);
    }

    public function testTransferSumTooSmall()
    {
        $this->form->transferSum = MoneyTransferForm::MIN_TRANSFER_SUM - 0.01;
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('transferSum', $this->form->errors);
    }

    public function testTransferSumTooBig()
    {
        $this->form->transferSum = $this->form->getMaxTransferSum() + 0.01;
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('transferSum', $this->form->errors);
    }

    public function testTransferSumAsString()
    {
        $this->form->transferSum = 'string';
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('transferSum', $this->form->errors);
    }

    public function testTransferSumAsInvalidNumber()
    {
        $this->form->transferSum = '16,38';
        $this->assertFalse($this->form->validate());
        $this->assertArrayHasKey('transferSum', $this->form->errors);
    }

    public function testValidForm()
    {
        $this->form->recipient = 'valid_name';
        $this->form->transferSum = 28.29;
        $this->assertTrue($this->form->validate());
    }
}