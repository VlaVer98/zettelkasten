<?php


namespace frontend\modules\fileCabinet\controllers;


use yii\web\Controller;

class CardController extends Controller
{
    public function actionAll()
    {
        return $this->render('all');
    }

    public function actionAdd()
    {
        return $this->render('add');
    }
}