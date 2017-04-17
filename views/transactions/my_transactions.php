<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                "label"=>Yii::t("app","User"),
                "value"=>function($model)
                {
                    return $model->getUserName();
                }
            ],
            [
                "label"=>Yii::t("app","Benefeciary"),
                "value"=>function($model)
                {
                    return $model->getBenefeciaryName();
                }
            ],
            'value',
            'create_datetime',
            // 'create_user',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
