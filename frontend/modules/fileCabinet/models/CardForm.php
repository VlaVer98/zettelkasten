<?php


namespace frontend\modules\fileCabinet\models;


use Exception;
use Throwable;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CardForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $header;
    public $text;
    public $tags;
    public $relationCards;
    public $id_user;
    public $Card;

    public function rules()
    {
        return [
            [['header', 'text'], 'trim'],
            [['header', 'id_user', 'text'], 'required'],
            [['Card'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['id_user'], 'integer'],
            [['header'], 'string', 'max' => 255],
            ['relationCards', 'each', 'rule' => ['string', 'max' => 255]],
            ['tags', 'each', 'rule' => ['string', 'max' => 50]],
            [['header'], 'validateHeaderCard', 'on' => self::SCENARIO_CREATE],
            [
                'tags',
                'each',
                'rule' => [
                    'exist',
                    'targetClass' => Tag::class,
                    'targetAttribute' => [
                        'tags' => 'name',
                        'id_user' => 'id_user'
                    ],
                ],
            ],
            [
                'relationCards',
                'each',
                'rule' => [
                    'exist',
                    'targetClass' => Card::class,
                    'targetAttribute' => [
                        'relationCards' => 'header',
                        'id_user' => 'id_user'
                    ],
                ]
            ],
            [['text'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'header' => 'Заголовок',
            'text' => 'Ваша идея',
            'tags' => 'Теги',
            'relationCards' => 'Ссылки'
        ];
    }

    public function validateHeaderCard($attribute)
    {
        if (!$this->hasErrors()) {
            $card = Card::findOne(['header' => $this->$attribute, 'id_user' => $this->id_user]);
            if ($card) {
                $this->addError($attribute, 'Карточка с таким именем уже есть!');
            }
        }
    }

    public function create()
    {
        $db = Yii::$app->zettelkasten;
        $transaction = $db->beginTransaction();

        try {
            $this->createCard();
            $this->addTagToCard();
            $this->addLinkToCard();

            $transaction->commit();
        } catch(Throwable $e) {
            $transaction->rollBack();
            return false;
        }
        return true;
    }

    public function update()
    {
        $db = Yii::$app->zettelkasten;
        $transaction = $db->beginTransaction();

        try {
            $this->updateCard();

            CardTag::deleteAll(['id_user' => $this->id_user, 'name_card' => $this->header]);
            $this->addTagToCard();

            RelationBetweenCards::deleteAll(['id_user' => $this->id_user, 'parent_card' => $this->header]);
            $this->addLinkToCard();

            $transaction->commit();
        } catch(Throwable $e) {
            $transaction->rollBack();
            return false;
        }
        return true;
    }

    protected function updateCard()
    {
        $card = Card::findOne($this->Card->header, $this->Card->id_user);
        if (empty($card)) {
            throw new Exception();
        }

        $card->attributes = [
            'header' => $this->header,
            'text' => $this->text,
            'id_user' => $this->id_user
        ];

        $this->scenario = self::SCENARIO_CREATE;

        $this->validate();
        if (!$card->save(false)) {
            throw new Exception('1');
        }
    }

    protected function createCard()
    {
        $card = new Card();
        $card->attributes = [
            'header' => $this->header,
            'text' => $this->text,
            'id_user' => $this->id_user
        ];

        if(!$card->save(false)) {
            throw new Exception('1');
        }
    }

    protected function addTagToCard()
    {
        if(!empty($this->tags)) {
            foreach($this->tags as $tag) {
                $cardTag = new CardTag();
                $cardTag->attributes = [
                    'name_card' => $this->header,
                    'tag' => $tag,
                    'id_user' => $this->id_user
                ];
                if(!$cardTag->save(false)) {
                    throw new Exception('2');
                }
            }
        }
    }

    protected function addLinkToCard()
    {
        if(!empty($this->relationCards)) {
            foreach($this->relationCards as $relationCard) {
                $relationBetweenCards = new RelationBetweenCards();
                $relationBetweenCards->attributes = [
                    'parent_card' => $this->header,
                    'child_card' => $relationCard,
                    'id_user' => $this->id_user
                ];
                if(!$relationBetweenCards->save(false)){
                    throw new Exception('3');
                }
            }
        }
    }

    static function fill(Card $card)
    {
        if(empty($card)) {
            return null;
        }

        $model = new self(['scenario' => self::SCENARIO_UPDATE]);
        $model->header = $card->header;
        $model->text = $card->text;
        $model->tags = array_keys(ArrayHelper::map($card->tags, 'tag', 'tag'));
        $model->relationCards = array_keys(ArrayHelper::map($card->associatedWithHer, 'child_card', 'child_card'));
        $model->id_user = $card->id_user;
        $model->Card = $card;

        return $model;
    }
}