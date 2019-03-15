<?php

namespace app\custom\services\transaction;

use app\custom\services\transaction\ITransaction;

class DummyTransaction implements ITransaction
{
    public function begin() {}

    public function commit() {}

    public function rollback() {}
}