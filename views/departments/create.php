<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Departments $model */

$this->title = 'Create Departments';
$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['/dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/masters/index']];
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['/departments/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-create card shadow">

    <h4 class="card-header"><?= Html::encode($this->title) ?></h4>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
