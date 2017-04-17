<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transactions`.
 */
class m170417_151933_create_transactions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transactions', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'user_id'=>\yii\db\pgsql\Schema::TYPE_BIGINT." NOT NULL",
            'beneficiary_id'=>\yii\db\pgsql\Schema::TYPE_BIGINT." NOT NULL",
            'value'=>\yii\db\pgsql\Schema::TYPE_FLOAT." NOT NULL",
            'create_datetime'=>\yii\db\pgsql\Schema::TYPE_TIMESTAMP." NOT NULL",
            'create_user'=>\yii\db\pgsql\Schema::TYPE_BIGINT." NOT NULL",
        ]);
        $this->addForeignKey("transactions_beneficiary_id_fkey",'transactions',"beneficiary_id","user","id","Cascade");
        $this->addForeignKey("transactions_user_id_fkey",'transactions',"user_id","user","id","Cascade");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('transactions');
    }
}
