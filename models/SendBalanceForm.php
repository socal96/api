<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SendBalanceForm extends Model
{
    public $benefeciary;
    public $value;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // user, benefeciary and value are both required
            [['benefeciary', 'value'], 'required'],
            [['value'], 'number'],

        ];
    }

    /**Create new transaction and send balance
     * @return boolean
     */
    public function sendBalance(&$transaction_id)
    {
        if ($this->validate()) {
            if ($this->benefeciary != User::findOne(Yii::$app->user->id)->username) {
                $benefeciary = User::findOne(["username" => trim($this->benefeciary)]);
                //create new user if not registed in system
                if (empty($benefeciary)) {
                    $new_user = new User();
                    $new_user->username = trim($this->benefeciary);
                    if ($new_user->save()) {
                        $user_balance = new UserBalance();
                        $user_balance->user_id = $new_user->id;
                        $user_balance->balance = 0;
                        if ($user_balance->save()) {
                            $benefeciary = $new_user;
                        } else {
                            return false;
                        }
                    }
                }
                //make users balance transformation
                $balance = UserBalance::findOne(["user_id" => $benefeciary->id]);
                $balance->balance += $this->value;
                $balance->save();
                $user_balance = UserBalance::findOne(["user_id" => Yii::$app->user->id]);
                $user_balance->balance -= $this->value;
                if ($user_balance->save()) {
                    //create a transaction log
                    $transaction = new Transactions();
                    $transaction->user_id = Yii::$app->user->id;
                    $transaction->beneficiary_id = $benefeciary->id;
                    $transaction->value = $this->value;
                    if ($transaction->save()) {
                        $transaction_id = $transaction->id;
                        return true;
                    }
                    //end
                } else {
                    return false;
                }
                return true;
            }
            $this->addError("benefeciary",Yii::t("app","Benefeciary nickname can not be your nickname"));
            return false;
        }
        return false;
    }
}
