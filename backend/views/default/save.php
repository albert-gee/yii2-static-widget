<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $this yii\web\View
 * @var $staticWidget xalberteinsteinx\staticWidget\common\models\StaticWidget
 * @var $staticWidgetTranslation xalberteinsteinx\staticWidget\common\models\StaticWidgetTranslation
 * @var $selectedLanguage integer
 */

use marqu3s\summernote\Summernote;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('review', 'Save static widgets');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ibox">

    <div class="ibox-title">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="ibox-content">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($staticWidget, 'key')->textInput() ?>
        <?= $form->field($staticWidgetTranslation, 'content')->widget(Summernote::className()); ?>
        <?= $form->field($staticWidgetTranslation, 'description')->textarea() ?>

        <?= Html::submitButton(\Yii::t('static-widget', 'Save'), [
            'class' => 'btn btn-primary'
        ]); ?>
        <?= Html::a(\Yii::t('static-widget', 'Cancel'),
            Url::to(['index']),
            [
                'class' => 'btn btn-danger'
            ]); ?>

        <?php $form::end(); ?>
    </div>

</div>