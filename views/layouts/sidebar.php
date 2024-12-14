<?php

use uims\core\modules\core\menu\CoreMenuItems;
use yii\helpers\Html;

$module_name = isset($_GET['q']) ? $_GET['q'] : "";
$modules = [];
\app\assets\AppAsset::register($this);

?>

<div class="leftbar">

    <nav id="sidebar" class="border-right">

        <div class="slide-arrow arrowClick" id="mainSidebar" title="Toggle Main Sidebar">
            <a href="#" class="color-inherit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.9481 14.8285L10.5339 16.2427L6.29122 12L10.5339 7.7574L11.9481 9.17161L10.1196 11H17.6568V13H10.1196L11.9481 14.8285Z"
                          fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M4.22183 19.7782C-0.0739419 15.4824 -0.0739419 8.51759 4.22183 4.22183C8.51759 -0.0739419 15.4824 -0.0739419 19.7782 4.22183C24.0739 8.51759 24.0739 15.4824 19.7782 19.7782C15.4824 24.0739 8.51759 24.0739 4.22183 19.7782ZM5.63604 18.364C2.12132 14.8492 2.12132 9.15076 5.63604 5.63604C9.15076 2.12132 14.8492 2.12132 18.364 5.63604C21.8787 9.15076 21.8787 14.8492 18.364 18.364C14.8492 21.8787 9.15076 21.8787 5.63604 18.364Z"
                          fill="currentColor"/>
                </svg>
            </a>
        </div>

        <ul class="navbar-nav pd-10 mr-auto pt-3 leftbar-scrollable">
            <?php if (!empty($modules)) {
                foreach ($modules as $module) {
                    if (Yii::$app->user->can($module['permission'])) :
//                        $modulesPackages = CoreMenuItems::getAllAppActive($module['parent_name']);
                        $modulesPackages = [];
                        if (!empty($modulesPackages)) : ?>
                            <li class="nav-item <?php if ($module_name == $module['parent_name']) { // making link active
                                echo "active";
                            } ?>">
                                <?= Html::a(Yii::t('app', $module['name']), [$module['url'], 'q' => $module['parent_name']], ['class' => 'nav-link']) ?>
                            </li>
                        <?php endif; ?>
                    <?php endif;
                }
            }
            ?>
            <div>
                <hr>
            </div>
            <?php if (Yii::$app->user->can("master_package")) { ?>
                <li class="nav-item">
                    <?= Html::a(Yii::t('app', 'System Settings'), ['/site/account-settings'], ['class' => 'nav-link']) ?>
                </li>  <?php
            } ?>
            <li class="nav-item">
                <?= Html::a(Yii::t('app', 'Account Settings'), ['/site/account-settings'], ['class' => 'nav-link']) ?>
            </li>
        </ul>

    </nav>

</div>