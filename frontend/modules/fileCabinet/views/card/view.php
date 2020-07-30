<?php

use frontend\modules\fileCabinet\components\menuCards\MenuCardsWidget;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 no-padding">
            <?= MenuCardsWidget::widget(['headerCards' => $headerCards]) ?>
        </div>
        <div class="col-md-9">
            <?= $this->render('_card', [
                'card' => $card,
            ]); ?>
        </div>
    </div>
</div>