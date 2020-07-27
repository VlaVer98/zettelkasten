<?php

namespace frontend\modules\fileCabinet\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Card]].
 *
 * @see Card
 */
class CardQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function headers($id_user)
    {
        return $this->andWhere(['id_user' => $id_user])->select('header')->all();
    }

    /**
     * {@inheritdoc}
     * @return Card[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Card|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
