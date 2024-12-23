<?php

use components\SideBarMenuItems;
use yii\helpers\Url;
use yii\helpers\Html;
use app\themes\samarth3\assets\SamarthThemeAsset;
use app\themes\samarthimg\SamarthImageAsset;
use app\models\ApplicationControl;
use uims\user\modules\jiuser\models\User;
use uims\core\modules\core\models\PortalContent;
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
<!--    <link rel="shortcut icon" href="--><?php //= $samarthAsset->baseUrl . '/img/favicon.ico' ?><!--"/>-->
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

<!-- Sticky Keyboard Utility Bottom-Right Button -->
<div class="keyboard-pos dropup dropdown-2">
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="border-color: transparent; background-color: transparent;">
<!--        // img-->
<!--        <img class="img-fluid" src="--><?php //= $samarthAsset->baseUrl . '/img/icon-keyboard.svg' ?><!--">-->
    </button>
    <div class="dropdown-menu keyboard">
        <!-- Dropdown menu links -->
        <!--<a class="dropdown-item" href="#" id="searchClick">Search<span class="badge badge-ctrl pen-apv">Alt (⌥) + S</span></a>-->
        <?php if (empty(Yii::$app->params['left-side-menu-item'])) { ?>
            <a class="dropdown-item" href="#" id="sidebarCollapse2">Toggle Main Sidebar<span
                    class="badge badge-ctrl pen-apv">Alt (⌥) + K</span></a>
        <?php } ?>
        <?php
        if (!empty(Yii::$app->params['left-side-menu-item'])) { ?>
            <a class="dropdown-item" href="#" id="sidebarCollapse3">Toggle Inner Sidebar<span
                    class="badge badge-ctrl pen-apv">Alt (⌥) + ;</span></a>
        <?php } ?>
        <a class="dropdown-item" href="#" id="logoutClick">Logout<span
                class="badge badge-ctrl pen-apv">Alt (⌥) + E</span></a>
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
