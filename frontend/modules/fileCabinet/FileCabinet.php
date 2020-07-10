<?php

namespace frontend\modules\fileCabinet;

/**
 * file-cabinet module definition class
 */
class FileCabinet extends \yii\base\Module
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
        \Yii::configure($this, require __DIR__ . '/config/main.php');
    }
}
