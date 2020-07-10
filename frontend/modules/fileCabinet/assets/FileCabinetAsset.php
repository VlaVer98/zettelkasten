<?php

namespace frontend\modules\fileCabinet\assets;
use yii\web\AssetBundle;

class FileCabinetAsset extends AssetBundle
{
    public $sourcePath = '@fileCabinet/web/';
    public $css = [
        'css/main.css',
    ];
    public $js = [
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset'
    ];
}