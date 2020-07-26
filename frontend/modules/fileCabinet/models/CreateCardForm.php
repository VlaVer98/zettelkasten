<?php


namespace frontend\modules\fileCabinet\models;


use Yii;
use yii\base\Model;

class CreateCardForm extends Model
{
    public $header;
    public $text;
    public $tags;
    public $relationCards;
    public $id_user;

    public function rules()
    {
        return [
            [['header', 'text'], 'trim'],
            [['header', 'id_user', 'text'], 'required'],
            [['id_user'], 'integer'],
            [['header'], 'string', 'max' => 255],
            ['relationCards', 'each', 'rule' => ['string', 'max' => 255]],
            ['tags', 'each', 'rule' => ['string', 'max' => 50]],
            [['header'], 'validateHeaderCard'],
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
            $card = new Card();
            $card->create($this->header, $this->text, $this->id_user);

            if(!empty($this->tags)) {
                foreach($this->tags as $tag) {
                    $cardTag = new CardTag();
                    $cardTag->create($this->header, $tag, $this->id_user);
                }
            }

            if(!empty($this->relationCards)) {
                foreach($this->relationCards as $relationCard) {
                    $relationBetweenCards = new RelationBetweenCards();
                    $relationBetweenCards->create($this->header, $relationCard, $this->id_user);
                }
            }

            $transaction->commit();
        } catch(\Throwable $e) {
            $transaction->rollBack();
            return false;
        }
        return true;
    }
}