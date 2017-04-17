<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Transactions */

$this->title = Yii::t('app', 'Send Balace');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_sendform', [
        'model' => $model,
    ]) ?>

</div>
