<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Designations $model */

$this->title = 'Create Designations';
$this->params['breadcrumbs'][] = ['label' => 'Designations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designations-create card shadow">

    <h4 class="card-header"><?= Html::encode($this->title) ?></h4>

    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
