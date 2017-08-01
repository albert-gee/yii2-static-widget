<?php
namespace xalberteinsteinx\staticWidget\common\entities;

use bl\multilang\entities\Language;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "static_widget_translation".
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 *
 * @property integer        $id
 * @property integer        $static_widget_id
 * @property integer        $language_id
 * @property string         $content
 * @property string         $description
 *
 * @property Language $language
 */
class StaticWidgetTranslation extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'static_widget_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['static_widget_id', 'language_id'], 'integer'],
            [['content'], 'string', 'min' => 1],
            [['description'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('static-widget', 'ID'),
            'static_widget_id' => Yii::t('static-widget', 'Static Widget ID'),
            'language_id' => Yii::t('static-widget', 'Language ID'),
            'content' => Yii::t('static-widget', 'Content'),
            'description' => Yii::t('static-widget', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}