<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 no-padding">
            <div class="box box-solid box-default">
                <div class="box-header">
                    Теги
                </div>
                <div class="box-body on-all-window no-padding">
                    <ul class="list-group">
                        <?php use yii\helpers\Html;

                        if(!empty($tags)): ?>
                            <?=$this->render('_searchByTagsForm', [
                                'model' => $searchModel,
                                'tags' => $tags
                            ]);?>
                        <?php else: ?>
                        <h3>Теги пока не добавлены...</h3>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9" style="padding-top: 5px">
            <?php if(!empty($cardTag)): ?>
                <?php foreach($cardTag as $key): ?>
                    <div class="box box-success box-solid collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= Html::encode($key->cards->header) ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="display: none;">
                            <?= $this->render('_card', [
                                'card' => $key->cards
                            ]);?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?= Html::img('/img/search.gif', [
                    'width' => '100%'
                ]) ?>
            <?php endif; ?>
        </div>
    </div>
</div>