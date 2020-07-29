<?php


namespace frontend\modules\fileCabinet\controllers;


use frontend\modules\fileCabinet\models\Tag;
use frontend\modules\fileCabinet\models\TagSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TagController extends Controller
{
    public function actionAll()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->user->id, Yii::$app->request->get());

        return $this->render('all', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Tag(['id_user' => Yii::$app->user->id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Тег добвлен!');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($name)
    {
        $model = Tag::find()->where(['name' => $name, 'id_user' => Yii::$app->user->id])->one();

        if($model === null) {
            throw new NotFoundHttpException;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Тег изменен!');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            }
        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete($name)
    {
        $tag = Tag::findOne([Yii::$app->user->id, $name]);
        if($tag !== null && $tag->delete() !== false) {
            Yii::$app->session->setFlash('success', 'Тег удален!');
            return $this->redirect(['tag/all']);
        }else {
            Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionSearch()
    {
        return $this->render('search');
    }
}