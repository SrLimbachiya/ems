<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\themes\samarth3\assets\SamarthThemeAsset;
use app\models\ApplicationControl;
use app\models\Employee;
use uims\core\modules\core\models\Session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use app\themes\samarthimg\SamarthImageAsset;

\app\assets\AppAsset::register($this);

$this->title = 'Login - Samarth eGov Suite';
//var_dump(ApplicationControl::getVariable('app_name'));die;

?>

<?php $home = Yii::$app->request->BaseUrl; ?>

<?php $this->beginPage() ?>

    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title>
            <?= Html::encode($this->title) ?>
        </title>
<!--        <link rel="shortcut icon" href="--><?php //= $samarthAsset->baseUrl . '/img/favicon.ico' ?><!--"/>-->
        <?php $this->head() ?>
        <?php
        $headers = Yii::$app->response->headers;
        $headers->set('X-Frame-Options', 'DENY');
        $headers->set('X-Content-Type-Options', 'nosniff');
        $headers->set("X-XSS-Protection", "1; mode=block");
        //        $headers->set("Content-Security-Policy","default-src 'self'");
        ?>
    </head>

    <body>

    <?php $this->beginBody() ?>

    <div class="login">

        <div class="container">
            <?= $this->render('alerts') ?>
        </div>

        <?= $content ?>

    </div>

    <?php if (Yii::$app->session->get('year') == NULL || Yii::$app->session->get('month') == NULL) { ?>
        <input style="display:none" id="sessionData" value="1">
    <?php } else { ?>
        <input style="display:none" id="sessionData" value="2">
    <?php } ?>

    <!-- END wrapper -->

    <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>