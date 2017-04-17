<?php
use yii\bootstrap\Html;
?>
<div class="container-fluid">
    <div class="row" style="margin: 2%">
        <?= Html::a(Yii::t('app', 'Create New Transaction'), ['send-balance'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <div class="row">

        <div class="col-md-12" style="background-color: #00b3ee">
            <div class="ibox float-e-margins" >
                <div class="ibox-title">
                    <span class="label label-success pull-right"><?=Yii::t("app","Totaly")?></span>
                    <h5><?=Yii::t("app","Current Balance")?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= $balance->balance ?></h1>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="background-color: #00b3ee">
            <div class="ibox float-e-margins" >
                <div class="ibox-title">
                    <span class="label label-success pull-right"><?=Yii::t("app","Totaly")?></span>
                    <h5><?=Yii::t("app","Income")?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= \app\models\Transactions::getTotalIncome() ?></h1>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="background-color: #00b3ee">
            <div class="ibox float-e-margins" >
                <div class="ibox-title">
                    <span class="label label-success pull-right"><?=Yii::t("app","Totaly")?></span>
                    <h5><?=Yii::t("app","Outcome")?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?= \app\models\Transactions::getTotalOutcome() ?></h1>

                </div>
            </div>
        </div>
    </div>
</div>