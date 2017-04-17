<?php

use yii\db\Migration;

/**
 * Handles the creation of table `balance`.
 */
class m170417_151922_create_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_balance', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'balance'=>\yii\db\pgsql\Schema::TYPE_FLOAT,
            'user_id'=>\yii\db\pgsql\Schema::TYPE_BIGINT
        ]);
        $this->insert('user_balance',["balance"=>0,"user_id"=>999999]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_balance');
    }
}
