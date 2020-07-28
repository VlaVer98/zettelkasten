<?php
use yii\helpers\Html;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h4>Теги</h4>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
                <div class="box-body">
                    <?php if (!empty($tags)): ?>
                        <?php foreach ($tags as $tag): ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default"><?= $tag->name ?></button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?= Html::a('изменить', ['tag/edit', 'name' => $tag->name]) ?></li>
                                    <li><?= Html::a('удалить', ['tag/delete', 'name' => $tag->name]) ?></li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h3>Тегов пока нет ...</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>