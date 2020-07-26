<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h4>Новая заметка</h4>
                </div>
                <div class="box-body">
                    <?= $this->render('_createForm', [
                        'model' => $model,
                        'tags' => $tags,
                        'cards' => $cards,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>