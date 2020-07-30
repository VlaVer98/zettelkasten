<?php


namespace frontend\modules\fileCabinet\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class CardTagSearch extends CardTag
{
    public $searchTags = [];

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['searchTags'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($id_user, $params)
    {
        $query = CardTag::find()->where(['id_user' => $id_user])->with('cards');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate()) || empty($this->searchTags)) {
            $query->where('0=1');
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        //VarDumper::dump($this->searchTags, 10, true);
        //die;
        $query->andFilterWhere(['tag' => $this->searchTags]);

        return $dataProvider;
    }
}