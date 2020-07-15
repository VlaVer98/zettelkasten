<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card_tag}}`.
 */
class m200714_113552_create_card_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card_tag}}', [
            'id_user' => $this->integer(11)->notNull(),
            'tag' => $this->string(50)->notNull(),
            'name_card' => $this->string(255)->notNull()
        ]);

        $this->addPrimaryKey('', '{{%card_tag}}', ['id_user', 'tag', 'name_card']);

        $this->createIndex('idx-card_tag-id_user-tag', '{{%card_tag}}', ['id_user', 'tag']);
        $this->addForeignKey(
            'fk-card_tag-id_user-tag',
            '{{%card_tag}}',
            ['id_user', 'tag'],
            '{{%tag}}',
            ['id_user', 'name'],
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx-card_tag-id_user-name_card', '{{%card_tag}}', ['id_user', 'name_card']);
        $this->addForeignKey(
            'fk-card_tag-id_user-name_card',
            '{{%card_tag}}',
            ['id_user', 'name_card'],
            '{{%card}}',
            ['id_user', 'header'],
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%card_tag}}');
    }
}
