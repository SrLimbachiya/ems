<?php

use yii\helpers\Html;
use components\Masters;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Departments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                    'template' => '<div class="row"><div class="col-3">{label}</div><div class="col-6">{input}{error}</div></div>'
            ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Masters::getStatus(), ['prompt'=>'-- Select --']) ?>

    <div class="form-group offset-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', \yii\helpers\Url::to(Yii::$app->request->referrer), ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
