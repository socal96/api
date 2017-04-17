<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_balance".
 *
 * @property string $id
 * @property double $balance
 * @property integer $user_id
 *
 * @property User $id0
 */
class UserBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance','user_id'], 'required'],
            [['balance'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'balance' => Yii::t('app', 'Balance'),
        ];
    }

}
