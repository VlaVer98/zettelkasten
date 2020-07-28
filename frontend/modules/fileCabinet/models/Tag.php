<?php

namespace frontend\modules\fileCabinet\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag".
 *
 * @property int $id_user
 * @property string $name
 */
class Tag extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
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
            [['id_user', 'name'], 'required'],
            [['id_user'], 'integer'],
            [['name'], 'string', 'max' => 50],
            ['name', 'unique', 'targetAttribute' => ['name', 'id_user'], 'message' => 'Тег с таким именем уже существует'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'name' => 'Имя тега',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
