<?php

namespace frontend\modules\fileCabinet\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "relation_between_cards".
 *
 * @property string $parent_card
 * @property string $child_card
 * @property int $id_user
 */
class RelationBetweenCards extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relation_between_cards';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('zettelkasten');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_card', 'child_card', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['parent_card', 'child_card'], 'string', 'max' => 255],
            [['parent_card', 'child_card', 'id_user'], 'unique', 'targetAttribute' => ['parent_card', 'child_card', 'id_user']],
            [['id_user', 'child_card'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['id_user' => 'id_user', 'child_card' => 'header']],
            [['id_user', 'parent_card'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['id_user' => 'id_user', 'parent_card' => 'header']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent_card' => 'Parent Card',
            'child_card' => 'Child Card',
            'id_user' => 'Id User',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RelationBetweenCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RelationBetweenCardsQuery(get_called_class());
    }

    public function create($parent_cart, $child_card, $id_user)
    {
        $this->parent_card = $parent_cart;
        $this->child_card = $child_card;
        $this->id_user = $id_user;

        return $this->insert(false);
    }
}
