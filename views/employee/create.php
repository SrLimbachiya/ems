<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow">
    <div class="card-header">
        <h3>Creating Employee Record</h3>
    </div>
    <div class="employee-form card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>