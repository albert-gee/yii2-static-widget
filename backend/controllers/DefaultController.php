<?php
namespace xalberteinsteinx\staticWidget\backend\controllers;

use bl\multilang\entities\Language;
use xalberteinsteinx\staticWidget\common\entities\{
    StaticWidget, StaticWidgetTranslation
};
use yii\helpers\Url;
use yii\web\{
    Controller, NotFoundHttpException
};

/**
 * StaticWidgetController implements the CRUD actions for StaticWidget model.
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class DefaultController extends Controller
{

    /**
     * Lists all StaticWidget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $staticWidgets = StaticWidget::find()->all();


        return $this->render('index', [
            'staticWidgets' => $staticWidgets,
        ]);
    }

    /**
     * Creates new or updates existing record
     * @param null $id
     * @param null $languageId
     * @return string|\yii\web\Response
     */
    public function actionSave($id = null, $languageId = null)
    {
        $languageId = $languageId ?? Language::getCurrent()->id;

        if (!empty($id)) {
            $staticWidget = StaticWidget::findOne($id);
            if (empty($staticWidget)) throw new NotFoundHttpException();
            $staticWidgetTranslation = StaticWidgetTranslation::find()->where([
                'static_widget_id' => $id,
                'language_id' => $languageId
            ])->one();

            if (empty($staticWidgetTranslation)) {
                $staticWidgetTranslation = new StaticWidgetTranslation();
                $staticWidgetTranslation->static_widget_id = $id;
                $staticWidgetTranslation->language_id = $languageId;
            }
        } else {
            $staticWidget = new StaticWidget();
            $staticWidgetTranslation = new StaticWidgetTranslation();
        }


        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();

            if ($staticWidget->load($post)) {
                if ($staticWidget->validate()) $staticWidget->save();

                if ($staticWidgetTranslation->load($post)) {
                    $staticWidgetTranslation->static_widget_id = $staticWidget->id;
                    $staticWidgetTranslation->language_id = $languageId;

                    if ($staticWidgetTranslation->validate()) $staticWidgetTranslation->save();

                    return $this->redirect(Url::to(['save',
                        'id' => $staticWidget->id,
                        'languageId' => $staticWidgetTranslation->language_id
                    ]));
                }
            }

            return $this->redirect(\Yii::$app->request->referrer);
        }

        return $this->render('save', [
            'staticWidget' => $staticWidget,
            'staticWidgetTranslation' => $staticWidgetTranslation,
            'selectedLanguage' => Language::findOne($languageId)
        ]);
    }

    /**
     * Deletes an existing StaticWidget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Finds the StaticWidget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaticWidget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaticWidget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}