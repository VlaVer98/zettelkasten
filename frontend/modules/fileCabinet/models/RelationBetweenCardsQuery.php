<?php

namespace frontend\modules\fileCabinet\models;

/**
 * This is the ActiveQuery class for [[RelationBetweenCards]].
 *
 * @see RelationBetweenCards
 */
class RelationBetweenCardsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RelationBetweenCards[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RelationBetweenCards|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
