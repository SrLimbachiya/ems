<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Designations $model */

$this->title = 'Update Designations: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Designations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="designations-update card shadow">

    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
