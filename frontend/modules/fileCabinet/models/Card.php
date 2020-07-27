<?php

namespace frontend\modules\fileCabinet\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "card".
 *
 * @property string $header
 * @property string $text
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $id_user
 *
 * @property RelationBetweenCards $childCards
 * @property RelationBetweenCards $associatedWithHer
 * @property CardTag $tags
 */
class Card extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('zettelkasten');
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'id_user'], 'required'],
            [['text'], 'string'],
            [['created_at', 'updated_at', 'id_user'], 'integer'],
            [['header'], 'string', 'max' => 255],
            [['header', 'id_user'], 'unique', 'targetAttribute' => ['header', 'id_user']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'header' => 'Header',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[RelationBetweenCards]].
     *
     * @return \yii\db\ActiveQuery|RelationBetweenCardsQuery
     */
    public function getChildCards()
    {
        return $this->hasMany(RelationBetweenCards::className(), ['child_card' => 'header', 'id_user' => 'id_user']);
    }

    /**
     * Gets query for [[RelationBetweenCards0]].
     *
     * @return \yii\db\ActiveQuery|RelationBetweenCardsQuery
     */
    public function getAssociatedWithHer()
    {
        return $this->hasMany(RelationBetweenCards::className(), ['parent_card' => 'header', 'id_user' => 'id_user']);
    }

    public function getTags()
    {
        return $this->hasMany(CardTag::className(), ['id_user' => 'id_user', 'name_card' => 'header']);
    }

    /**
     * {@inheritdoc}
     * @return CardQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CardQuery(get_called_class());
    }

    public function create($header, $text, $id_user)
    {
        $this->header = $header;
        $this->text = $text;
        $this->id_user = $id_user;

        return $this->insert(false);
    }

    public function edit($header, $text, $id_user)
    {
        $this->header = $header;
        $this->text = $text;
        $this->id_user = $id_user;

        return $this->update(false);
    }

    static function getArrayHeaders($id_user)
    {
        return ArrayHelper::map(Card::find()->headers($id_user), 'header', 'header');
    }
}
