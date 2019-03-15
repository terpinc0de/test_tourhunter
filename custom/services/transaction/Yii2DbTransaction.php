<?php

namespace app\custom\services\transaction;

use Yii;
use app\custom\services\transaction\ITransaction;

class Yii2DbTransaction implements ITransaction
{
    private $transaction;

    public function begin()
    {
        $this->transaction = Yii::$app->db->beginTransaction();
    }

    public function commit()
    {
        if($this->transaction) {
            $this->transaction->commit();
        }
    }

    public function rollback()
    {
        if($this->transaction) {
            $this->transaction->rollback();
        }
    }
}