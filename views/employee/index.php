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

$departments = \app\models\Departments::getAllActive();
$designations = \app\models\Designations::getAllActive();

?>
<div class="card shadow">
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
                    'options' => ['class' => 'pagination pagination-sm'],
                    'activePageCssClass' => 'active',
                    'maxButtonCount' => 5,
                    'linkOptions' => [
                        'class' => 'page-link', // Custom class for <a> elements
                    ],
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
                        'value' => function ($model) use ($departments) {
                            return $departments[$model->department] ?? '';
                        },
                        'filter' => \kartik\select2\Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'department', // The field to filter
                            'data' => $departments, // Populate from the Designation model
                            'theme' => \kartik\select2\Select2::THEME_KRAJEE_BS5,
                            'options' => [
                                'placeholder' => 'Select a department...',
                                'multiple' => false,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true, // Allow clearing the selection
                                'minimumInputLength' => 1, // Allow search (start typing to search)
                            ],
                        ]),
                    ],
                    [
                        'attribute' => 'designation',
                        'value' => function ($model) use ($designations) {
                            return $designations[$model->designation] ?? $model->designation;
                        },
                        'filter' => \kartik\select2\Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'designation', // The field to filter
                            'data' => $designations, // Populate from the Designation model
                            'theme' => \kartik\select2\Select2::THEME_KRAJEE_BS5,
                            'options' => [
                                'placeholder' => 'Select a designation...',
                                'multiple' => false,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true, // Allow clearing the selection
                                'minimumInputLength' => 1, // Allow search (start typing to search)
                            ],
                        ]),
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
