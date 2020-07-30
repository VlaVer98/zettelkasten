<?php


namespace frontend\modules\fileCabinet\controllers;


use frontend\modules\fileCabinet\models\Card;
use frontend\modules\fileCabinet\models\CardForm;
use frontend\modules\fileCabinet\models\CardTagSearch;
use frontend\modules\fileCabinet\models\Tag;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CardController extends Controller
{
    public $defaultAction = 'all';

    public function actionAll()
    {
        $headerCards = Card::getArrayHeaders(Yii::$app->user->id);

        return $this->render('all', [
            'headerCards' => $headerCards,
        ]);
    }

    public function actionView($name)
    {
        $card = Card::find()->where(['header' => $name, 'id_user' => Yii::$app->user->id])->with('tags', 'associatedWithHer')->one();

        if ($card === null) {
            throw new NotFoundHttpException;
        }

        $headerCards =  Card::getArrayHeaders(Yii::$app->user->id);

        return $this->render('view', [
            'card' => $card,
            'headerCards' => $headerCards,
        ]);
    }

    public function actionCreate()
    {
        $model = new CardForm(['scenario' => CardForm::SCENARIO_CREATE]);
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

    public function actionEdit($name)
    {
        $card = Card::find()->where(['header' => $name, 'id_user' => Yii::$app->user->id])->with('tags', 'associatedWithHer')->one();

        if ($card === null) {
            throw new NotFoundHttpException;
        }

        $model = CardForm::fill($card);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->update()) {
                Yii::$app->session->setFlash('success', 'Карточка изменена!');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            }
        }

        $tags = Tag::findAll(['id_user' => Yii::$app->user->id]);
        $cards = Card::findAll(['id_user' => Yii::$app->user->id]);

        return $this->render('edit', [
            'model' => $model,
            'tags' => $tags,
            'cards' => $cards
        ]);
    }

    public function actionDelete($name)
    {
        $card = Card::find()->where(['header' => $name, 'id_user' => Yii::$app->user->id])->with('tags', 'associatedWithHer')->one();

        if($card !== null && $card->delete() !== false) {
            Yii::$app->session->setFlash('success', 'Карточка удалена!');
            return $this->redirect('all');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка! Попробуйте еще.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionSearchByTags()
    {
        $tags = Tag::find()->where(['id_user' => Yii::$app->user->id])->select('name')->asArray()->all();
        $searchModel = new CardTagSearch();
        $cardTag = $searchModel->search(Yii::$app->user->id, Yii::$app->request->get())->getModels();

        return $this->render('search', [
            'cardTag' => $cardTag,
            'searchModel' => $searchModel,
            'tags' => $tags
        ]);
    }
}