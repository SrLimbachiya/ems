<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'All Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3><?= Html::encode($this->title) ?></h3>
            <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body">
        <div class="employee-index overflow-auto">




            <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-bordered table-striped table-hover'], // Add Bootstrap classes
                'summaryOptions' => ['class' => 'summary mb-3'], // Style summary
                'pager' => [
                    'class' => 'yii\widgets\LinkPager',
                    'options' => ['class' => 'pagination pagination-sm justify-content-center'], // Style pagination
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update}', // Customize action buttons
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, ['class' => 'btn btn-sm btn-secondary', 'title' => 'View']);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-edit"></i>', $url, ['class' => 'btn btn-sm btn-warning', 'title' => 'Update']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-trash"></i>', $url, [
                                    'class' => 'btn btn-sm btn-danger',
                                    'title' => 'Delete',
                                    'data-confirm' => 'Are you sure you want to delete this item?',
                                    'data-method' => 'post',
                                ]);
                            },
                        ],
                        'contentOptions' => ['class' => 'text-center'], // Center align action buttons
                    ],
                    'employee_code',
                    'first_name',
                    'middle_name',
                    'last_name',
                    [
                        'attribute' => 'department',
                        'filter' => [], // Add a filter dropdown for departments
                        'value' => function ($model) {
                            return $model->department; // Assuming a `getDepartmentName()` relation
                        },
                    ],
                    [
                        'attribute' => 'designation',
                        'filter' => [], // Add a filter dropdown for designations
                        'value' => function ($model) {
                            return $model->designation; // Assuming a `getDesignationName()` relation
                        },
                    ],
                    'birth_date:date', // Format as date
                    'joining_date:date', // Format as date
                    'retirement_date',
                    [
                        'attribute' => 'gender',
                        'filter' => ['Male' => 'Male', 'Female' => 'Female'], // Add filter options
                    ],
                    'category',
                    'country',
                    'state',
                    'city',
                    'pincode',

                ],
            ]); ?>


        </div>

    </div>
</div>
