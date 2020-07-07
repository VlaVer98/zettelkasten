<?php

namespace console\migrations\application;

use yii\db\Migration;

class MigrationApplication extends Migration
{
    public function init()
    {
        $this->db = 'application';
        parent::init();
    }
}