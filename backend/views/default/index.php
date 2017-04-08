<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @var $this yii\web\View
 * @var $staticWidgets xalberteinsteinx\staticWidget\common\models\StaticWidget
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('review', 'Static widgets');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ibox">

    <div class="ibox-title">
        <?= Html::a(Yii::t('review', 'Create static widget'), ['save'], ['class' => 'btn btn-xs btn-success pull-right']) ?>
        <h5><?= Html::encode($this->title) ?></h5>
    </div>

    <div class="ibox-content">
        <table class="table table-bordered table-hover">

            <thead>
            <tr>
                <th class="col-md-2">
                    <?= \Yii::t('layout', 'Key'); ?>
                </th>
                <th class="col-md-4">
                    <?= \Yii::t('layout', 'Content'); ?>
                </th>
                <th class="col-md-4">
                    <?= \Yii::t('layout', 'Description'); ?>
                </th>
                <th class="col-md-2"></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($staticWidgets as $staticWidget): ?>
                <tr>
                    <td>
                        <?= $staticWidget->key; ?>
                    </td>
                    <td>
                        <?= $staticWidget->translation->content; ?>
                    </td>
                    <td>
                        <?= $staticWidget->translation->description; ?>
                    </td>
                    <td>
                        <?= Html::a(
                            \Yii::t('staticWidget', 'Update'),
                            Url::to(['save', 'id' => $staticWidget->id, 'langaugeId' => \bl\multilang\entities\Language::getCurrent()->id])); ?>
                        <?= Html::a(\Yii::t('staticWidget', 'Delete'), Url::to(['delete', 'id' => $staticWidget->id])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>