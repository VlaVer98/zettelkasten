<?php


namespace frontend\modules\fileCabinet\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class TagSearch extends Tag
{
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['name'], 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($id_user, $params)
    {
        $query = Tag::find()->where(['id_user' => $id_user]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}