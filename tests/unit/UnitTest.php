<?php


use app\models\LoginForm;
use app\models\SendBalanceForm;

class UnitTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $model;


    protected function _after()
    {
        \Yii::$app->user->logout();
    }
    public function testLoginUser()
    {
        $this->model = new LoginForm([
            'username' => 'startrek',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
    }
    public function testLoginNoUser()
    {
        $this->model = new LoginForm([
            'username' => 'not_existing_username',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
    }
    public function testInitialBalance()
    {
        $this->model = new LoginForm([
            'username' => 'not_existing_username',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
        $balance=\app\models\UserBalance::findOne(["user_id"=>Yii::$app->user->id]);
        $this->assertEquals($balance->balance,0);
    }
    public function testSendBalanceExistingUser()
    {
        /*login*/
        $this->model = new LoginForm([
            'username' => 'new_user',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
       /*end_login*/
        $model = new SendBalanceForm(["benefeciary"=>"startrek","value"=>500]);
        $user=\app\models\User::findOne(["username"=>"startrek"]);
        $this->assertNotEmpty($user);
        $oldbalance=\app\models\UserBalance::findOne(["user_id"=>$user->id]);
        $tranzaction_id = null;
        $this->assertTrue($model->sendBalance($tranzaction_id));
        /*verify new_user balance must be euqual -500*/
        $new_user_balance=\app\models\UserBalance::findOne(["user_id"=>Yii::$app->user->id]);
        $this->assertEquals($new_user_balance->balance,-500);
        /*verify startrek balance must be euqual +500*/
        $old_user_balance=\app\models\UserBalance::findOne(["user_id"=>$user->id]);
        $this->assertEquals($old_user_balance->balance,$oldbalance->balance+500);
    }
    public function testSendBalanceNotExistingUser()
    {
        /*login*/
        $this->model = new LoginForm([
            'username' => 'new_user',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
        /*end_login*/
        /*give user balance*/
        $old_user_balance=\app\models\UserBalance::findOne(["user_id"=>Yii::$app->user->id]);
        /*end*/
        $model = new SendBalanceForm(["benefeciary"=>"not_existing_user","value"=>500]);
        $user=\app\models\User::findOne(["username"=>"not_existing_user"]);
        $this->assertEmpty($user);
        $oldbalance=0;
        $tranzaction_id = null;
        $this->assertTrue($model->sendBalance($tranzaction_id));
        /*verify new_user balance must be euqual -500*/
        $new_user_balance=\app\models\UserBalance::findOne(["user_id"=>Yii::$app->user->id]);
        $this->assertEquals($new_user_balance->balance,$old_user_balance->balance-500);
        /*verify startrek balance must be euqual +500*/
        $user=\app\models\User::findOne(["username"=>"not_existing_user"]);
        $old_user_balance=\app\models\UserBalance::findOne(["user_id"=>$user->id]);
        $this->assertEquals($old_user_balance->balance,$oldbalance+500);
    }
    public function testSendBalanceForMe()
    {
        /*login*/
        $this->model = new LoginForm([
            'username' => 'new_user',
        ]);
        $this->model->login();
        $this->assertFalse(\Yii::$app->user->isGuest);
        /*end_login*/
        $model = new SendBalanceForm(["benefeciary"=>"new_user","value"=>500]);
        $tranzaction_id = null;
        $this->assertFalse($model->sendBalance($tranzaction_id));
        $user=\app\models\User::findOne(["username"=>"new_user"]);
        $this->assertNotNull($user);
        $this->assertEquals($user->id,Yii::$app->user->id);


    }
}