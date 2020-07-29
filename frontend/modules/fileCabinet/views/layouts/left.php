<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Картотека', 'options' => ['class' => 'header']],
                    ['label' => 'Все карточки', 'icon' => 'files-o', 'url' => ['card/all']],
                    ['label' => 'Добавить карточку', 'icon' => 'plus-square-o', 'url' => ['card/create']],
                    ['label' => 'Теги', 'options' => ['class' => 'header']],
                    ['label' => 'Все теги', 'icon' => 'tags', 'url' => ['tag/all']],
                    ['label' => 'Добавить тег', 'icon' => 'plus-square-o', 'url' => ['tag/create']],
                    ['label' => 'Поиск по тегам', 'icon' => 'search tags', 'url' => ['tag/search']],
                ],
            ]
        ) ?>

    </section>

</aside>
