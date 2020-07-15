<?php

namespace frontend\modules\fileCabinet\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "card_tag".
 *
 * @property int $id_user
 * @property string $tag
 * @property string $name_card
 *
 * @property Card $cards
 */
class CardTag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_tag';
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
            [['id_user', 'tag', 'name_card'], 'required'],
            [['id_user'], 'integer'],
            [['tag'], 'string', 'max' => 50],
            [['name_card'], 'string', 'max' => 255],
            [['id_user', 'tag', 'name_card'], 'unique', 'targetAttribute' => ['id_user', 'tag', 'name_card']],
            [['id_user', 'name_card'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['id_user' => 'id_user', 'name_card' => 'header']],
            [['id_user', 'tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['id_user' => 'id_user', 'tag' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'tag' => 'Tag',
            'name_card' => 'Name Card',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|CardQuery
     */
    public function getCards()
    {
        return $this->hasOne(Card::className(), ['id_user' => 'id_user', 'header' => 'name_card']);
    }

    /**
     * {@inheritdoc}
     * @return CardTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CardTagQuery(get_called_class());
    }
}
