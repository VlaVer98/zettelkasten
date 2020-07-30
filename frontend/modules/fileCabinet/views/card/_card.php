<?php

use yii\helpers\Html;

?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($card->header) ?></h3>
        <?= Html::a('удалить', ['card/delete', 'name' => $card->header], [
            'class' => 'pull-right',
            'style' => [
                'font-style' => 'italic',
                'color' => 'red',
                'margin-left' => '10px'
            ],
        ]) ?>
        <?= Html::a('редактировать', ['card/edit', 'name' => $card->header], [
            'class' => 'pull-right',
            'style' => 'font-style: italic;'
        ]) ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body on-all-window">
        <?php if (isset($card->tags) && !empty($card->tags)): ?>
            <h3>Теги:</h3>
            <?php foreach ($card->tags as $tag): ?>
                <?= Html::a(Html::encode($tag->tag), ['tag/view', 'name' => $tag->tag], [
                    'class' => 'label label-primary'
                ]) ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <h3>Заметка</h3>
        <div class="jumbotron">
            <?= \yii\helpers\HtmlPurifier::process($card->text) ?>
        </div>
        <?php if (isset($card->associatedWithHer) && !empty($card->associatedWithHer)): ?>
            <h3>Ссылки:</h3>
            <?php foreach ($card->associatedWithHer as $associatedCard): ?>
                <div>
                    <?= Html::a(Html::encode($associatedCard->child_card), ['card/view', 'name' => $associatedCard->child_card, '#' => $associatedCard->child_card], [
                        'class' => 'bg-info'
                    ]) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- /.box-body -->
</div>