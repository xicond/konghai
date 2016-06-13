<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tracker */

$this->title = Yii::t('admin', 'Add Tracking');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Shipments'), 'url' => ['shipment/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Edit').' '.Yii::t('admin', 'Shipment').' '. $model->shipment_id, 'url' => ['shipment/view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
