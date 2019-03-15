<?php

namespace app\custom\services\transaction;

interface ITransaction
{
    public function begin();

    public function commit();

    public function rollback();
}