<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Departments $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="departments-view card shadow">

    <div class="card-header d-flex justify-content-between">
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
    <div class="row card-body ml-3">
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<div style="width:45%; height: auto; min-height: 45px; padding:0px; border:solid 1px #c7c7c7; flex-grow: 1" class="mr-3 row mb-0 rounded mb-1"><div class="col-6 fw-bold d-flex align-items-center border-right">{label}</div><div class="col-6 d-flex align-items-center">{value}</div></div>',
            'attributes' => [
                'name',
                'status',
                'created_at',
                [
                        'attribute' => 'created_by',
                    'value' => function ($model) {
                        return \app\models\User::findIdentity($model->created_by)->username;

                    },
                    'label' => 'Created By',
                ],
            ],
        ]) ?>
    </div>

</div>
