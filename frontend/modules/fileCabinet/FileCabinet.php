<?php

namespace frontend\modules\fileCabinet;

use Yii;
use yii\base\Module;
use yii\helpers\Url;

/**
 * file-cabinet module definition class
 */
class FileCabinet extends Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\fileCabinet\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        Yii::configure($this, require __DIR__ . '/config/main.php');
        Yii::$app->user->loginUrl = Url::to('/'.$this->getUniqueId().'/auth/login');
        Yii::$app->setHomeUrl(Url::to('/'.$this->getUniqueId().'/card/all'));
    }
}
