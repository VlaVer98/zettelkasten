<?php


namespace frontend\modules\fileCabinet\controllers;


use frontend\modules\fileCabinet\models\Tag;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TagController extends Controller
{
    public function actionAll()
    {
        $tags = Tag::find()->where(['id_user' => Yii::$app->user->id])->all();

        return $this->render('all', [
            'tags' => $tags,
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

    public function actionSearch()
    {
        return $this->render('search');
    }
}