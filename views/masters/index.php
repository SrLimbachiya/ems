<?php

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Masters';

$this->params['breadcrumbs'][] = ['label' => 'Employee', 'url' => ['/employee/dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="d-flex gap-3">
    <div class="card shadow w-25">
        <div class="card-body d-flex justify-content-between align-content-end">
            <div>
                <h1 style="font-size: 4rem;"><?= $departments ?? 0 ?></h1>
                <h4>Departments</h4>
            </div>
            <div class="align-self-end">
                <?= Html::a('View', ['/departments/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <div class="card shadow w-25">
        <div class="card-body d-flex justify-content-between align-content-end">
            <div>
                <h1 style="font-size: 4rem;"><?= $designations ?? 0 ?></h1>
                <h4>Designation</h4>
            </div>
            <div class="align-self-end">
                <?= Html::a('View', ['/designations/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>