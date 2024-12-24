<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = $model->first_name . ' ' . $model->last_name . ' (' . $model->employee_code . ')';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="employee-view card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3><?= Html::encode($this->title) ?></h3>
        <div>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Back', ['/employee/index', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>


    <div class="card-body p-4">
        <div class="row gx-3 gy-2">
            <?= DetailView::widget([
                'model' => $model,
                'template' => '<div class="col-md-6 col-sm-12 d-flex flex-grow-1">
                                    <div class="d-flex border rounded align-items-stretch w-100">
                                        <div class="col-6 fw-bold p-3 border-end d-flex align-items-center">{label}</div>
                                        <div class="col-6 p-3 d-flex align-items-center">{value}</div>
                                    </div>
                                </div>',
                'attributes' => [
                    'employee_code',
                    'first_name',
                    'middle_name',
                    'last_name',
                    [
                        'attribute' => 'department',
                        'value' => function ($model) {
                            return \app\models\Departments::resolveDepartmentName($model->department);
                        }
                    ],
                    [
                        'attribute' => 'designation',
                        'value' => function ($model) {
                            return \app\models\Designations::resolveDesignationName($model->designation);
                        }
                    ],
                    'birth_date',
                    'joining_date',
                    'retirement_date',
                    'gender',
                    'category',
                    [
                        'attribute' => 'country',
                        'value' => function ($model) {
                            return \app\models\CountryMaster::getCountryById($model->country);
                        }
                    ],
                    [
                        'attribute' => 'state',
                        'value' => function ($model) {
                            return \app\models\StateMaster::getStateById($model->state);
                        }
                    ],
                    [
                        'attribute' => 'city',
                        'value' => function ($model) {
                            return \app\models\CityMaster::getCityById($model->city);
                        }
                    ],
                    'pincode',
                    'address',
                    'phone_no',
                    'email:email',
                    'status',
                    [
                        'attribute' => 'created_at',
                        'value' => function ($model) {
                            return date('Y-m-d h:iA', $model->created_at);
                        }
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function ($model) {
                            return \app\models\User::findIdentity($model->created_by)->username ?? 'NA';
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
