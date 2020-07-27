<?php

use frontend\modules\fileCabinet\components\menuCards\MenuCardsWidget;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 no-padding">
            <?= MenuCardsWidget::widget(['headerCards' => $headerCards]) ?>
        </div>
        <div class="col-md-9">
            <span class="glyphicon glyphicon-search" style="font-size: 30rem;width: 100%;
    text-align: center;"></span>
        </div>
    </div>
</div>