<?php

namespace frontend\modules\fileCabinet\components\menuCards;


use yii\base\Widget;

class MenuCardsWidget extends Widget
{
    public $headerCards;

    public function run()
    {
        return $this->render('render');
    }
}