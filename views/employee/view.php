<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = $model->first_name.' '.$model->last_name.' ('.$model->employee_code.')';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3><?= Html::encode($this->title) ?></h3>
        <div>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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



   <div class="card-body p-4 pl-5">
       <div class="row">
           <?= DetailView::widget([
               'model' => $model,
               'template' => '<div style="width:45%; height: auto; min-height: 45px; padding:0px; border:solid 1px #c7c7c7; flex-grow: 1" class="mr-3 row mb-0 rounded mb-1"><div class="col-6 fw-bold d-flex align-items-center border-right">{label}</div><div class="col-6 d-flex align-items-center">{value}</div></div>',
               'attributes' => [
                   'employee_code',
                   'first_name',
                   'middle_name',
                   'last_name',
                   'department',
                   'designation',
                   'birth_date',
                   'joining_date',
                   'retirement_date',
                   'gender',
                   'category',
                   'country',
                   'state',
                   'city',
                   'pincode',
                   'address',
                   'phone_no',
                   'email:email',
                   'status',
                   'created_at',
                   'created_by',
               ],
           ]) ?>
       </div>
   </div>

</div>
