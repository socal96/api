<?php

namespace app\models;

use Yii;
use yii\db\Transaction;

/**
 * This is the model class for table "transactions".
 *
 * @property string $id
 * @property string $user_id
 * @property string $beneficiary_id
 * @property double $value
 * @property string $create_datetime
 * @property string $create_user
 *
 * @property User $user
 * @property User $beneficiary
 */
class Transactions extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->create_datetime))
            {
                $this->create_datetime=date("Y-m-d H:i:s");
                $this->create_user=Yii::$app->user->id;
            }
        }
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'beneficiary_id', 'value'], 'required'],
            [['user_id', 'beneficiary_id', 'create_user'], 'default', 'value' => null],
            [['user_id', 'beneficiary_id', 'create_user'], 'integer'],
            [['value'], 'number'],
            [['create_datetime'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['beneficiary_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['beneficiary_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'beneficiary_id' => Yii::t('app', 'Beneficiary ID'),
            'value' => Yii::t('app', 'Value'),
            'create_datetime' => Yii::t('app', 'Create Datetime'),
            'create_user' => Yii::t('app', 'Create User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficiary()
    {
        return $this->hasOne(User::className(), ['id' => 'beneficiary_id']);
    }
    /**
     * @return string
     */
    public function getBenefeciaryName()
    {
        return User::findOne($this->beneficiary_id)->username;
    }
    /**
     * @return string
     */
    public function getUserName()
    {
        return User::findOne($this->user_id)->username;
    }
    /**
     * @return number
     */
    public static function getTotalIncome()
    {
        $transactions = (new \yii\db\Query())
            ->select(['SUM(value) as total'])
            ->from(self::tableName())
            ->where(['beneficiary_id' => Yii::$app->user->id])
            ->one();

        if(!empty($transactions["total"]))
        {
            return $transactions["total"];
        }else
            return 0;
    }
    /**
     * @return number
     */
    public static function getTotalOutcome()
    {
        $transactions = (new \yii\db\Query())
            ->select(['SUM(value) as total'])
            ->from(self::tableName())
            ->where(['user_id' => Yii::$app->user->id])
            ->one();

        if(!empty($transactions["total"]))
        {
            return $transactions["total"];
        }else

            return 0;

    }
}
