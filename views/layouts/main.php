<?php

use components\SideBarMenuItems;
use yii\helpers\Url;
use yii\helpers\Html;
$home = Yii::$app->request->BaseUrl;
\app\assets\AppAsset::register($this);

Yii::$app->params['left-side-menu-item'] = SideBarMenuItems::getAdminItems();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
            <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!--    // add favicon-->
    <?= Html::csrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <link href='https://fonts.googleapis.com/css?family=Work+Sans' rel='stylesheet'>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
<body>
<?= $this->render('menu_level_01') ?>
<div class="wrapper">
    <?php if (empty(Yii::$app->params['left-side-menu-item'])) { ?>
        <?= $this->render('sidebar') ?>
    <?php } ?>

    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">
            <div id="wrapper-level2" class="row <?php if (empty(Yii::$app->params['left-side-menu-item'])) {
                echo "pl-wrapper";
            } ?>">
                <?php
                if (!empty(Yii::$app->params['left-side-menu-item'])) { ?>
                    <?= $this->render('inner_sidebar_menu') ?>
                <?php } ?>
                <div class="inner-content <?php
                if (!empty(Yii::$app->params['left-side-menu-item'])) {
                    echo "col-lg-10 toggleCol";
                } ?>">
                    <div style="width: 100%!important; margin: 0; padding: 0;">
                        <?= $this->render('inner_top_menu') ?>
                        <?= $this->render('alerts') ?>
                        <?= $content ?>
                    </div>
                </div>
                <?php if (!empty(Yii::$app->params['left-side-menu-item'])) { ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?= $this->render('footer') ?>

</body>

<?php $this->endBody() ?>

</html>

<?php $this->endPage() ?>

<?php
$this->registerJs(<<<JS
  $(document).ready(function(){
    //-initialize the javascript
    App.init();
  });
JS
)
?>
