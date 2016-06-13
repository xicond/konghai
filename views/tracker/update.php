<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tracker */

$this->title = Yii::t('admin', 'Update {modelClass}: ', [
    'modelClass' => 'Tracker',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Shipments'), 'url' => ['shipment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Edit').' '.Yii::t('admin', 'Shipment').' '. $model->shipment_id, 'url' => ['shipment/view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="tracker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
