<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170417_151909_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'username'=>\yii\db\pgsql\Schema::TYPE_STRING.' NOT NULL',
            'admin'=>\yii\db\pgsql\Schema::TYPE_BIGINT.' NOT NULL DEFAULT 0',
            'create_datetime'=>\yii\db\pgsql\Schema::TYPE_TIMESTAMP." NOT NULL",
            'update_datetime'=>\yii\db\pgsql\Schema::TYPE_TIMESTAMP." NOT NULL",
            'create_user'=>\yii\db\pgsql\Schema::TYPE_BIGINT,
            'update_user'=>\yii\db\pgsql\Schema::TYPE_BIGINT,

        ]);
        $this->insert('user',["id"=>999999,"username"=>"startrek","admin"=>1,"create_datetime"=>"2017-04-12 16:12:38","update_datetime"=>"2017-04-12 16:12:38"]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
