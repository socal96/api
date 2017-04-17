<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Our Activity Balance');
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            [
                "label"=>Yii::t("app","Balance"),
                "value"=>function($model){
                    return $model->getBalance();
                }
            ]
            //'id',
            //'create_datetime',
            //'update_datetime',
            //'create_user',
            // 'update_user',
            // 'admin',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
