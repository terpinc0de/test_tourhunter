<?php

namespace app\modules\account\migrations;

use yii\db\Migration;

/**
 * Class m180922_070326_user_create_table
 */
class m180922_070326_user_create_table extends Migration
{
    const NAME = 'account_user';
    const PREFIXED = '{{%' . self::NAME . '}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::PREFIXED, [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'balance' => $this->decimal(8, 2)->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::PREFIXED);
    }
}
