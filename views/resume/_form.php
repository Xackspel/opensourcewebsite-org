<?php

use app\components\helpers\ArrayHelper;
use app\models\Currency;
use app\models\Resume;
use app\widgets\buttons\CancelButton;
use app\widgets\buttons\SaveButton;
use app\widgets\KeywordsSelect\KeywordsSelect;
use app\widgets\LocationPickerWidget\LocationPickerWidget;
use app\widgets\buttons\SubmitButton;
use kartik\select2\Select2;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Resume */
/* @var $currencies Currency[] */

?>
    <div class="currency-exchange-order-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'name')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'skills')->textarea() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'experiences')->textarea() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'expectations')->textarea() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php $model->keywordsFromForm = $model->getKeywordsFromForm() ?>
                                <?= $form->field($model, 'keywordsFromForm')->widget(KeywordsSelect::class) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'min_hourly_rate')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'currency_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($currencies, 'id', 'name'),
                                    'options' => [
                                        'prompt' => '',
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?= $form->field($model, 'remote_on')->checkbox(['autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row location-row <?=$model->remote_on ? 'd-none' : ''?>">
                            <div class="col">
                                <?= $form->field($model, 'location')->widget(LocationPickerWidget::class) ?>
                            </div>
                        </div>
                        <div class="row location-row" <?=$model->remote_on ? 'd-none' : ''?>>
                            <div class="col">
                                <?= $form->field($model, 'search_radius')
                                    ->textInput(['maxlength' => true, 'placeholder' => 0])
                                    ->label($model->getAttributeLabel('search_radius').', km')
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= SubmitButton::widget() ?>
                        <?= CancelButton::widget(['url' => '/resume']); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$js = <<<JS
$('#webresume-remote_on').on('change', function () {
    $('.location-row').toggleClass('d-none');
});
JS;

$this->registerJs($js);



