<?php
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\Response;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">


    <?php if (!$model->company) { ?>
        <?
        // script to parse the results into the format expected by Select2
        $resultsJs = "function (data, params) {data.push({label: 'Add new customer', id: 'create'}); return {results: data };}";

        $createNewCustomerLabel = Yii::t('orders', 'Create new customer');
        $formatJs = <<<JS
var formatRepo = function (repo) {
    if (repo.loading) {
        return repo.text;
    }
    if (repo.id === "create") {
      return "$createNewCustomerLabel";
    }
    var markup =
'<div class="row">' +
    '<div class="col-sm-1">' +
        '<i class="glyphicon glyphicon-user icon-button-icon-lg"></i>' +
        //'<img src="' + repo.avatar_url + '" class="img-circle" style="width:100%" />' +
    '</div>' +
    '<div class="col-sm-10">' +
      repo.full_name +
      '<span class="text-muted"> (#' + repo.id + ')</span>' +
      '<br />' + repo.email +
      '<br />' + repo.defaultAddress +
    '</div>' +
'</div>';
    //if (repo.description) {
    //  markup += '<h5>' + repo.description + '</h5>';
    //}
    return '<div style="overflow:hidden;">' + markup + '</div>';
};
var formatRepoSelection = function (repo) {
    return repo.full_name || repo.text;
}
JS;
        // Register the formatting script
        $this->registerJs($formatJs, \yii\web\View::POS_HEAD);
        ?>
        <h4>Find or create a customer</h4>
        <?=Html::activeHiddenInput($model, 'applyNewCustomer', ['value' => 0])?>
        <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
//            'data' => [
//                ['id'=>1,'value'=>'test']
//            ],
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true,
                #'templateResult' => new JsExpression('function(city) { return (city.full_name ? city.full_name : city.full_name); }'),
                'templateResult' => new JsExpression('formatRepo'),
                'templateSelection' => new JsExpression('function (city) { return (city.full_name ? city.full_name : city.full_name); }'),
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'ajax' => [
                    'url' => new JsExpression('function() { return "'.Url::toRoute(['/customers/type-order-pick']).'"; }'),
                    'dataType' => Response::FORMAT_JSON,
//                                'type' => 'POST',
//                                'data' => new JsExpression('function(params) { return {q:params.term, page: params.page}; }'),
                    'processResults' => new JsExpression($resultsJs),
                    'data' => new JsExpression('function(params) { return {"CustomerSearch[searchName]":params.term, page: 1}; }'),
                ],
            ],
            'pluginEvents' => [
                'change' =>  'function(e) {
                    if (this.value === "create") {
                        this.value=null;
                        alert("In development! To createa customer, go to Customers menu");
                    } else {
                        $("#'.Html::getInputId($model, 'applyNewCustomer').'").val("1"); // order will apply neew address
                        $("#'.$form->id.'").submit();
                    }
                 
                 }',
            ],
        ]); ?>
    <? } else { ?>
        <?= Html::activeHiddenInput($model, 'company_id') ?>
        <?= Html::submitButton('X', [
            'name' => Html::getInputName($model, 'company_id'),
            'value' => '0',
            'class' => 'btn btn-sm pull-right btn-link',
        ]) ?>
        <h5 class="text-uppercase">Клиент</h5>
        <?=$this->render('/orders/_view_customer', [
            'model' => $model->customer
        ])?>
    <? }?>





</div>
