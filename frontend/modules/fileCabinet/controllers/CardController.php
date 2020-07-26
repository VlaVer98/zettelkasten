<?php


namespace frontend\modules\fileCabinet\controllers;


use frontend\modules\fileCabinet\models\Card;
use frontend\modules\fileCabinet\models\CreateCardForm;
use frontend\modules\fileCabinet\models\Tag;
use Yii;
use yii\web\Controller;

class CardController extends Controller
{
    public function actionAll()
    {
        return $this->render('all');
    }

    public function actionCreate()
    {
        $model = new CreateCardForm();
        $model->id_user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->create()) {
                Yii::$app->session->setFlash('success', 'Карточка добавленна!');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            }
        }

        $tags = Tag::findAll(['id_user' => Yii::$app->user->id]);
        $cards = Card::findAll(['id_user' => Yii::$app->user->id]);

        return $this->render('create', [
            'model' => $model,
            'tags' => $tags,
            'cards' => $cards
        ]);
    }
}