<?php

use frontend\modules\fileCabinet\components\menuCards\MenuCardsWidget;
use yii\helpers\Html;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 no-padding">
            <?= MenuCardsWidget::widget(['headerCards' => $headerCards]) ?>
        </div>
        <div class="col-md-9 no-padding">
            <?= Html::img('/img/search.gif', [
                    'width' => '100%'
            ])?>
        </div>
    </div>
</div>