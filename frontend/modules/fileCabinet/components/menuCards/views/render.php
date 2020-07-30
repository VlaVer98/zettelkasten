<div class="box box-solid box-default">
    <div class="box-header">
        Мои карточки
    </div>
    <div class="box-body on-all-window no-padding">
        <ul class="list-group">
            <?php use yii\helpers\Html;

            if (!empty($this->context->headerCards)): ?>
                <?php foreach ($this->context->headerCards as $key => $headerCard): ?>
                    <?= Html::a(Html::encode($headerCard), ['card/view', 'name' => $headerCard, '#' => $headerCard], [
                        'class' => 'list-group-item',
                        'id' => $headerCard,
                    ]) ?>
                <?php endforeach; ?>
            <?php else: ?>
                <h3>Карточек пока нет...</h3>
            <?php endif; ?>
        </ul>
    </div>
</div>