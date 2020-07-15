<?php

use yii\db\Migration;

/**
 * Class m200715_074455_fixed_fk_and_index_to_relation_between_cards_table
 */
class m200715_074455_fixed_fk_and_index_to_relation_between_cards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-relation_between_cards-id_user', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_user', '{{%relation_between_cards}}');

        $this->dropForeignKey('fk-relation_between_cards-parent_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-parent_card', '{{%relation_between_cards}}');

        $this->dropForeignKey('fk-relation_between_cards-child_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-child_card', '{{%relation_between_cards}}');

        $this->createIndex('idx-relation_between_cards-id_user-parent_card', '{{%relation_between_cards}}', ['id_user', 'parent_card']);
        $this->addForeignKey(
            'fk-relation_between_cards-id_user-parent_card',
            '{{%relation_between_cards}}',
            ['id_user', 'parent_card'],
            '{{%card}}',
            ['id_user', 'header'],
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx-relation_between_cards-id_user-child_card', '{{%relation_between_cards}}', ['id_user', 'child_card']);
        $this->addForeignKey(
            'fk-relation_between_cards-id_user-child_card',
            '{{%relation_between_cards}}',
            ['id_user', 'child_card'],
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
        $this->dropForeignKey('fk-relation_between_cards-id_user-parent_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_user-parent_card', '{{%relation_between_cards}}');

        $this->dropForeignKey('fk-relation_between_cards-id_user-child_card', '{{%relation_between_cards}}');
        $this->dropIndex('idx-relation_between_cards-id_user-child_card', '{{%relation_between_cards}}');

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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200715_074455_fixed_fk_and_index_to_relation_between_cards_table cannot be reverted.\n";

        return false;
    }
    */
}
