<?php

use console\migrations\zettelkasten\MigrationZettelkasten;

/**
 * Handles the creation of table `{{%relation_between_cards}}`.
 */
class m200705_120814_create_relation_between_cards_table extends MigrationZettelkasten
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%relation_between_cards}}', [
            'id_parent_card' => $this->bigInteger()->unsigned(),
            'id_child_card' => $this->bigInteger()->unsigned(),
            'id_user' => $this->integer(11)
        ]);

        $this->addPrimaryKey('pk_relation_between_cards', '{{%relation_between_cards}}', ['id_parent_card', 'id_child_card', 'id_user']);

        $this->createIndex(
            'idx-relation_between_cards-id_parent_card',
            '{{%relation_between_cards}}',
            'id_parent_card'
        );

        $this->addForeignKey(
            'fk-relation_between_cards-id_parent_card',
            '{{%relation_between_cards}}',
            'id_parent_card',
            '{{%card}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-relation_between_cards-id_child_card',
            '{{%relation_between_cards}}',
            'id_child_card'
        );

        $this->addForeignKey(
            'fk-relation_between_cards-id_child_card',
            '{{%relation_between_cards}}',
            'id_child_card',
            '{{%card}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-relation_between_cards-id_user',
            '{{%relation_between_cards}}',
            'id_user'
        );

        $this->addForeignKey(
            'fk-relation_between_cards-id_user',
            '{{%relation_between_cards}}',
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
        $this->dropForeignKey('fk-relation_between_cards-id_parent_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_parent_card', '{{%relation_between_cards}}');
        $this->dropForeignKey('fk-relation_between_cards-id_child_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_child_card', '{{%relation_between_cards}}');
        $this->dropForeignKey('fk-relation_between_cards-id_user', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_user', '{{%relation_between_cards}}');
        $this->dropPrimaryKey('pk_relation_between_cards', '{{%relation_between_cards}}');
        $this->dropTable('{{%relation_between_cards}}');
    }
}
