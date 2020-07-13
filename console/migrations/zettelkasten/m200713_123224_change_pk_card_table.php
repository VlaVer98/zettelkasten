<?php

use console\migrations\zettelkasten\MigrationZettelkasten;

/**
 * Class m200713_123224_change_pk_card_table
 */
class m200713_123224_change_pk_card_table extends MigrationZettelkasten
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-relation_between_cards-id_parent_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_parent_card', '{{%relation_between_cards}}');

        $this->dropForeignKey('fk-relation_between_cards-id_child_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_child_card', '{{%relation_between_cards}}');

        $this->renameColumn('{{%relation_between_cards}}', 'id_parent_card', 'parent_card');
        $this->renameColumn('{{%relation_between_cards}}', 'id_child_card', 'child_card');

        $this->alterColumn('{{%relation_between_cards}}', 'parent_card', 'varchar(255) not null');
        $this->alterColumn('{{%relation_between_cards}}', 'child_card', 'varchar(255) not null');

        $this->dropPrimaryKey('PRIMARY', '{{%card}}');
        $this->dropColumn('{{%card}}', 'id');

        $this->addPrimaryKey('pk_card', '{{%card}}', ['header', 'id_user']);

        $this->createIndex('idx-relation_between_cards-parent_card', '{{%relation_between_cards}}', 'parent_card');
        $this->addForeignKey(
            'fk-relation_between_cards-parent_card',
            '{{%relation_between_cards}}',
            'parent_card',
            '{{%card}}',
            'header'
        );

        $this->createIndex('idx-relation_between_cards-child_card', '{{%relation_between_cards}}', 'child_card');
        $this->addForeignKey(
            'fk-relation_between_cards-child_card',
            '{{%relation_between_cards}}',
            'child_card',
            '{{%card}}',
            'header'
        );

        //$this->alterColumn('{{%card}}', 'header', 'varchar(255) not null');
        //$this->alterColumn('{{%card}}', 'id_user', 'int(11) not null');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-relation_between_cards-parent_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-parent_card', '{{%relation_between_cards}}');

        $this->dropForeignKey('fk-relation_between_cards-child_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-child_card', '{{%relation_between_cards}}');

        $this->renameColumn('{{%relation_between_cards}}', 'parent_card', 'id_parent_card');
        $this->renameColumn('{{%relation_between_cards}}', 'child_card', 'id_child_card');

        $this->alterColumn('{{%relation_between_cards}}', 'id_parent_card', 'bigint(20) unsigned not null');
        $this->alterColumn('{{%relation_between_cards}}', 'id_child_card', 'bigint(20) unsigned not null');

        $this->dropPrimaryKey('PRIMARY', '{{%card}}');
        $this->addColumn('{{%card}}', 'id', 'bigint(20) unsigned not null');
        $this->addPrimaryKey('', '{{%card}}', 'id');

        $this->createIndex('idx-relation_between_cards-id_parent_card', '{{%relation_between_cards}}', 'id_parent_card');
        $this->addForeignKey(
            'fk-relation_between_cards-id_parent_card',
            '{{%relation_between_cards}}',
            'id_parent_card',
            '{{%card}}',
            'id'
        );

        $this->createIndex('idx-relation_between_cards-id_child_card', '{{%relation_between_cards}}', 'id_child_card');
        $this->addForeignKey(
            'fk-relation_between_cards-id_child_card',
            '{{%relation_between_cards}}',
            'id_child_card',
            '{{%card}}',
            'id'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200713_123224_change_pk_card_table cannot be reverted.\n";

        return false;
    }
    */
}
