<?php

use yii\filters\AccessControl;

return [
    'layout' => 'main',
    'aliases' => [
        '@fileCabinet' => '@frontend/modules/fileCabinet',
    ],
    'components' => [
        // список конфигураций компонентов
    ],
    'as access' => [
        'class' => AccessControl::className(),
        'except' => [
            'auth/*',
        ],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ]
    ],
    'params' => [
        // список параметров
    ],
];