<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h4>Редактирование тега</h4>
                </div>
                <div class="box-body">
                    <?= $this->render('_createForm', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>