<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>


<!--<div class="row">-->
<!--    <div class="col-md-6">-->
<!--        <div class="form-group">-->
<!--            <label id="name-label" for="name">Name</label>-->
<!--            <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" required>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-6">-->
<!--        <div class="form-group">-->
<!--            <label id="email-label" for="email">Email</label>-->
<!--            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="row">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "<div class='form-group col-11 mb-4'>{label}\n{input}\n{hint}</div>{error}",
            'options' => [
                'class' => 'col-md-6' // Each field will take 6 columns out of 12
            ]
        ]
    ]); ?>

    <div class="row">
        <?= $form->field($model, 'employee_code')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'department')->textInput() ?>
        <?= $form->field($model, 'designation')->textInput() ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birth_date')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Select Date of birth', 'readonly' => true],
            'clientOptions' => [
                'minDate' => '1900-01-01',
                'maxDate' => 'today',
            ],
        ]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'joining_date')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Select Joining Date', 'readonly' => true],
            'clientOptions' => [
                'minDate' => '1900-01-01',
                'maxDate' => 'today',
            ],
        ]) ?>

        <?= $form->field($model, 'retirement_date')->widget(DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Select Retirement Date', 'readonly' => true],
            'clientOptions' => [
                'minDate' => '1900-01-01',
                'maxDate' => new \yii\web\JsExpression('new Date(new Date().setFullYear(new Date().getFullYear() + 50))')
            ],
        ]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(\app\models\Employee::getEmployeeStatus(), ['prompt' => '-- select employee status --']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
