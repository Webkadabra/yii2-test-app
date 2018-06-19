<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select a company ...'],
        'pluginOptions' => [
            'allowClear' => false
        ],
    ])->hint('Company is not listed? ' . Html::a('Create Company', ['/company/create'], ['target' => '_blank', 'class' => 'btn btn-default btn-xs']));
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fax_no')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->widget(\kartik\select2\Select2::classname(), [
        'data' => array_combine(\app\helpers\Address::flatCountries(),\app\helpers\Address::flatCountries()),
        'options' => ['placeholder' => 'Select a country ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'postalcode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
