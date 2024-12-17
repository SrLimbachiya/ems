<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use components\Masters;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

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
        <?= $form->field($model, 'department')->widget(\kartik\select2\Select2::class, [
                'data' => \app\models\Departments::getAllActive(),
            'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => '-- Select --'],
        ]) ?>
        <?= $form->field($model, 'designation')->textInput() ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'gender')->dropDownList(Masters::getGenders(), ['prompt' => '-- Select --']) ?>
        <?= $form->field($model, 'category')->dropDownList(Masters::getCategory(), ['prompt' => '-- Select --']) ?>

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
        <!--        --><?php //= $form->field($model, 'country')->dropDownList(\app\models\CountryMaster::getCountry(), ['prompt'=>'-- Select --']) ?>
        <?= $form->field($model, 'country')->widget(\kartik\select2\Select2::class, [
            'data' => \app\models\CountryMaster::getCountry(),
            'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
            'options' => ['placeholder' => '-- Select --'],
        ]) ?>

        <?= $form->field($model, 'state')->widget(DepDrop::class, [
            'data' => [$model->state => $model->state],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'pluginOptions' => [
                'initialize' => $model->isNewRecord ? false : true,
                'depends' => ['employee-country'],
                'placeholder' => 'Select...',
                'url' => Url::to(['/masters/get-state'])
            ],
            'options' => ['class' => 'form-control']
        ]) ?>
    </div>

    <div class="row">
<!--        --><?php //= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'city')->widget(DepDrop::class, [
            'data' => [$model->city => $model->city],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ],
            'pluginOptions' => [
                'initialize' => $model->isNewRecord ? false : true,
                'depends' => ['employee-state'],
                'placeholder' => 'Select...',
                'url' => Url::to(['/masters/get-city'])
            ],
            'options' => ['class' => 'form-control']
        ]) ?>

        <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList(\components\Masters::getStatus(), ['prompt' => '-- select employee status --']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
