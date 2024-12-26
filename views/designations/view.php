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
<div class="designations-view card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4><?= Html::encode($this->title) ?></h4>
        <div>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Back', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="card-body row gx-3 gy-2">
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<div class="col-md-6 col-sm-12 d-flex flex-grow-1">
                                    <div class="d-flex border rounded align-items-stretch w-100">
                                        <div class="col-6 fw-bold p-3 border-end d-flex align-items-center">{label}</div>
                                        <div class="col-6 p-3 d-flex align-items-center">{value}</div>
                                    </div>
                                </div>',
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
