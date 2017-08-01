<?php
namespace xalberteinsteinx\staticWidget\common\entities;

use bl\multilang\behaviors\TranslationBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "static_widget".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer                        $id
 * @property string                         $key
 *
 *
 * @property StaticWidgetTranslation[]      $translations
 * @property StaticWidgetTranslation        $translation
 *
 */
class StaticWidget extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_widget';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'translation' => [
                'class' => TranslationBehavior::className(),
                'translationClass' => StaticWidgetTranslation::className(),
                'relationColumn' => 'static_widget_id'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('static-widget', 'ID'),
            'key' => Yii::t('static-widget', 'Key')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(StaticWidgetTranslation::className(), ['static_widget_id' => 'id']);
    }
}