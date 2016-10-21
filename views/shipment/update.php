<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shipment */

$this->title = Yii::t('admin', 'Update {modelClass}: ', [
    'modelClass' => 'Shipment',
]) . $model->marking_code;

$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '[ '.$model->marking_code.' ]', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');
?>
<div class="shipment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
