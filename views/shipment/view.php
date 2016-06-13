<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Shipment */

$this->title = Yii::t('admin', 'Detail').' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'from',
            'to',
            'address_to',
            'address_from',
//            'input_by',
//            'update_by',
//            'history:ntext',
//            'input_time',
//            'update_time',
            'description',
        ],
    ]) ?>

    <p>
    <?= Html::a(Yii::t('admin', 'Add Code'), ['shipment-code/create', 'sid'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_view_code', [
        'model' => $model_code,
    ]) ?>

    <p>
    <?= Html::a(Yii::t('admin', 'Add Tracking'), ['tracker/create', 'sid'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_view_tracker', [
        'model' => $model_tracker,
    ]) ?>

</div>
