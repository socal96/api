<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $username
 * @property string $id
 * @property string $create_datetime
 * @property string $update_datetime
 * @property string $create_user
 * @property string $update_user
 * @property string $admin
 *
 * @property Transactions[] $transactions
 * @property Transactions[] $transactions0
 * @property UserBalance $userBalance
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(empty($this->admin))
            {
                $this->admin=0;
            }
            if (empty($this->create_datetime))
            {
                $this->create_datetime=date("Y-m-d H:i:s");
                $this->create_user=Yii::$app->user->id;
            }
            $this->update_datetime=date("Y-m-d H:i:s");
            $this->update_user=Yii::$app->user->id;

        }
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['create_datetime', 'update_datetime'], 'safe'],
            [['create_user', 'update_user', 'admin'], 'default', 'value' => null],
            [['create_user', 'update_user', 'admin'], 'integer'],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'id' => Yii::t('app', 'ID'),
            'create_datetime' => Yii::t('app', 'Create Datetime'),
            'update_datetime' => Yii::t('app', 'Update Datetime'),
            'create_user' => Yii::t('app', 'Create User'),
            'update_user' => Yii::t('app', 'Update User'),
            'admin' => Yii::t('app', 'Admin'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions0()
    {
        return $this->hasMany(Transactions::className(), ['beneficiary_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserBalance()
    {
        return $this->hasOne(UserBalance::className(), ['id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Return user->admin value
     *
     * @return boolean
     */
    public  static function isAdmin()
    {
        if(!Yii::$app->user->isGuest) {
            $user = self::findOne(Yii::$app->user->id);
            return $user->admin;
        }else
            return false;
    }
    public function getBalance()
    {
        $balance=UserBalance::findOne(["user_id"=>$this->id]);
        return $balance->balance;
    }


}
