<?php

namespace app\modules\account\forms;

use yii\base\Model;
use app\modules\account\AccountModule as M;
use app\modules\account\exceptions\AccountException;

class MoneyTransferForm extends Model
{
    const MIN_TRANSFER_SUM = 0.01;
    const MIN_BALANCE = -1000;

    public $recipient;

    public $balance;

    public $transferSum; 

    public function __construct($balance, $config = [])
    {
        if(!is_numeric($balance)) {
            throw new AccountException('Balance cannot be not a number.');
        }

        parent::__construct($config);
        $this->balance = $balance;
    }

    public function rules()
    {
        return [
            [['recipient', 'transferSum'], 'required', 'message' => M::t('Field cannot be blank.')],
            [['recipient'], 'string'],
            [['transferSum'], 'double', 'min' => self::MIN_TRANSFER_SUM, 'max' => $this->getMaxTransferSum(), 'tooBig' => M::t('Transfer amount must be no greater than {max}', [
                'max' => $this->getMaxTransferSum(),
            ])],
        ];
    }

    public function attributeLabels()
    {
        return [
            'recipient' => M::t('Who is the recipient?'),
            'balance' => M::t('Your balance'),
            'transferSum' => M::t('Transfer amount'),
            'maxTransferSum' => M::t('Max transfer sum'),
        ];
    }

    public function getMaxTransferSum()
    {
        return floatval(number_format($this->balance - self::MIN_BALANCE, 2, '.', ''));
    }

    public function getFormattedBalance()
    {
        return number_format($this->balance, 2, '.', ' ');
    }

    public function getFormattedMaxTransferSum()
    {
        return number_format($this->getMaxTransferSum(), 2, '.', ' ');
    }
}