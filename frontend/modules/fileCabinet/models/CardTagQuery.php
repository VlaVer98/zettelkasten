<?php

namespace frontend\modules\fileCabinet\models;

/**
 * This is the ActiveQuery class for [[CardTag]].
 *
 * @see CardTag
 */
class CardTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CardTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CardTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
