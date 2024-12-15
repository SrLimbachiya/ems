<?php

use uims\user\modules\jiuser\models\User;
use uims\user\modules\jiuser\models\UserModuleControl;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ApplicationControl;
use yii\widgets\Breadcrumbs;
use app\themes\samarthimg\SamarthImageAsset;
use uims\core\modules\core\models\Institutions;

\app\assets\AppAsset::register($this);
?>

<style>
    .breadcrumb-item a, .breadcrumb-item.active {
        color: white !important;
    }

    @media screen and (min-width: 767px) {
        .navbar.navbar-dark.height {
            height: 60px !important;
        }
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.75) !important;
    }

    .breadcrumb-item a:hover {
        color: rgb(255, 255, 255) !important;
    }

    .bg-nav {
        /*background-color: #e1ab3b !important;*/
        background-color: #31829c !important;
    }

</style>

<nav class="navbar navbar-dark height navbar-expand-md bg-nav border-bottom" aria-label="Main Site Navigation">

    <div class="container-fluid">

        <!-- Samarth eGov | Main Logo -->

        <a href="<?php Url::to(['/site']) ?>">
            <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                     class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                </svg>
                <h4 class="text-white ml-2">Employee Management System</h4>
            </div>
        </a>


        <div class="collapse navbar-collapse" id="top-menu">

            <!-- Breadcrumb -->

            <ul class="col navbar-nav me-auto pb-2 pb-md-0 ps-md-0 ps-1">
                <li class="nav-item">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb my-auto bg-nav">
                            <?= Breadcrumbs::widget(['itemTemplate' => '<li class="breadcrumb-item bread-link bg-nav mt-0 pt-1">{link}</li>', // template for all links
                                'activeItemTemplate' => '<li class="breadcrumb-item active bg-nav mt-0 pt-1">{link}</li>', // template for all links
                                'homeLink' => [
                                    'label' => '',
                                    'url' => '',
                                ],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
                        </ol>
                    </nav>
                </li>
            </ul>

            <ul class="col navbar-nav me-auto mb-2 mb-md-0 justify-content-md-end ps-md-0 ps-2">
                <li class="nav-item my-auto mr-2 pt-md-0 pt-2">
                </li>
                <li class="nav-item my-auto dropdown">
                    <a class="nav-link" href="#" id="userAccount" data-bs-toggle="dropdown" aria-expanded="false">
                        <p class="bl mt-2 pt-1 d-inline-block text-white"><?php echo Yii::$app->user->identity->username; ?></p>
                        <?= \components\IconHelper::userIcon(); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end userAccount pt-3 pb-4" aria-labelledby="userAccount">
                        <li>
                            <h3 class="pl-2">
                                <?php echo Yii::$app->user->identity->username; ?>
                            </h3>
                        </li>
                        <li class="pb-2">
                            <a class="dropdown-item" href="mailto:<?php echo Yii::$app->user->identity->email; ?>"
                               target="_blank">
                                <?php echo Yii::$app->user->identity->email; ?>
                            </a>
                        </li>
                        <hr>
                        <li class="pt-2 mt-1">
                            <a class="dropdown-item prof-drop-out" href="<?php echo Url::to(['/site/logout']) ?>"
                               data-method="post" id="site-logout">
                                Logout <span class="badge badge-ctrl float-right">Alt (⌥) + E</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

    </div>

</nav>