<?php

use app\models\Departments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\DepartmentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4><?= Html::encode($this->title) ?></h4>

        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->status;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', \components\Masters::getStatus(), ['prompt' => "All",
                        'class' => 'form form-control',
                    ]),
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Departments $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
    </div>


</div>
