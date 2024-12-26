<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Departments $model */

$this->title = 'Update Departments: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['/dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/masters/index']];
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['/departments/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="departments-update card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4><?= Html::encode($this->title) ?></h4>
        <?= Html::a('Back', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
    </div>

   <div class="card-body">
       <?= $this->render('_form', [
           'model' => $model,
       ]) ?>
   </div>

</div>
