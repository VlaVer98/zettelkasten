<?php

use console\migrations\zettelkasten\MigrationZettelkasten;

/**
 * Handles the creation of table `{{%tag}}`.
 */
class m200705_120618_create_tag_table extends MigrationZettelkasten
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id_user' => $this->integer(11),
            'name' => $this->string(50)
        ]);

        $this->addPrimaryKey('pk_tag', '{{%tag}}', ['id_user', 'name']);

        $this->createIndex(
            'idx-tag-id_user',
            '{{%tag}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-tag-id_user',
            '{{%tag}}',
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
        $this->dropPrimaryKey('pk_tag', '{{%tag}}');
        $this->dropForeignKey('fk-tag-id_user', '{{%tag}}');
        $this->dropIndex('idx-tag-id_user', '{{%tag}}');
        $this->dropTable('{{%tag}}');
    }
}
