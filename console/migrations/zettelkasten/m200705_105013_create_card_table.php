<?php

use console\migrations\zettelkasten\MigrationZettelkasten;

/**
 * Handles the creation of table `{{%card}}`.
 */
class m200705_105013_create_card_table extends MigrationZettelkasten
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->createTable('{{%card}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'header' => $this->string(255),
            'text' => $this->text(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'id_user' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-card-id_user',
            '{{%card}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-card-id_user',
            '{{%card}}',
            'id_user',
            '{{%application.user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-card-id_user', '{{%card}}');
        $this->dropIndex('idx-card-id_user', '{{%card}}');
        $this->dropTable('{{%card}}');
    }
}
