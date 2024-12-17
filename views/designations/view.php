<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Designations $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Designations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="designations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<div style="width:45%; height: auto; min-height: 45px; padding:0px; border:solid 1px #c7c7c7; flex-grow: 1" class="mr-3 row mb-0 rounded mb-1"><div class="col-6 fw-bold d-flex align-items-center border-right">{label}</div><div class="col-6 d-flex align-items-center">{value}</div></div>',
            'attributes' => [
                'name',
                'status',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'ip',
            ],
        ]) ?>
    </div>

</div>
