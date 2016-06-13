<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tracker */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Trackers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracker-view">

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
//            'shipment_id',
            'shipment_code',
            'track_date',
            'track_time',
//            'input_by',
//            'input_time',
//            'update_by',
//            'update_time',
            'description',
            'status',
//            'history:ntext',
        ],
    ]) ?>

</div>
