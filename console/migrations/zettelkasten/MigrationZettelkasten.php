<?php

namespace console\migrations\zettelkasten;

use yii\db\Migration;

class MigrationZettelkasten extends Migration
{
    public function init()
    {
        $this->db = 'zettelkasten';
        parent::init();
    }
}