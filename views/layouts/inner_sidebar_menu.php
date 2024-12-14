<?php

use yii\widgets\Menu;
\app\assets\AppAsset::register($this);

?>

<?php
$items = [];
if (!empty(Yii::$app->params['left-side-menu-item'])) {
    $items = Yii::$app->params['left-side-menu-item'];
    ?>
    <div class="col-lg-2" id="sidebar-wrapper-level2">
        <?php
        echo Menu::widget([
            'options' => [
                'class' => 'sidebar-elements inner-menu',
            ],
            'linkTemplate' => '<a href="{url}">{label}</a>',
            'submenuTemplate' => '<ul class="level-2">{items}</ul>',
            'encodeLabels' => false,
            'items' => !empty($items) ? $items : [],
        ]);
        ?>
    </div>
<?php } ?>