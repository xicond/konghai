<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentCode */

$this->title = Yii::t('admin', 'Edit {modelClass}: ', [
    'modelClass' => 'Shipment Code',
]) . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Shipments'), 'url' => ['shipment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Edit').' '.Yii::t('admin', 'Shipment').' '. $model->shipment_id, 'url' => ['shipment/view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Edit');
?>
<div class="shipment-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
