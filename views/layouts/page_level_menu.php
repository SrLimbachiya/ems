<?php

use uims\core\modules\core\menu\CoreMenuItems;
use yii\helpers\Html;
use app\widgets\horizontalMenu\hMenu;

$module_name = isset($_GET['q']) ? $_GET['q'] : "";

//$modules = CoreMenuItems::getAllPackageActive();
$modules = [];
\app\assets\AppAsset::register($this);

$navClass = !empty(Yii::$app->params['module-name']) && Yii::$app->params['module-name'] == 'Employee' ? 'd-none' : 'row bg-white page-level-menu border-bottom';

?>

<div class="<?= $navClass ?>">
        <div class="col-md-6 align-self-center">
            <h5>
                <?php if (!empty(Yii::$app->params['left-side-menu-item'])) {
                    ?>
                    <ul class="nav col d-lg-inline-block d-none">
                        <li class="nav-item dropdown mr-2">
                            <button type="button" class="btn btn-sm drpdwn-1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                •••
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sideTglrDrpDwn">
                                <?php if (!empty($modules)) {
                                    foreach ($modules as $module) {
                                        if (Yii::$app->user->can($module['permission'])) :
//                                            $modulesPackages = CoreMenuItems::getAllAppActive($module['parent_name']);
                                            $modulesPackages = [];
                                            if (!empty($modulesPackages)) : ?>
                                                <li class="dotted">
                                                    <?= Html::a(Yii::t('app', $module['name']), [$module['url'], 'q' => $module['parent_name']], ['class' => 'dropdown-item mr-4']) ?>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif;
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
                ?>
                <?php
                if (!empty(Yii::$app->params['module-name'])) {
                    echo Yii::$app->params['module-name'];
                } else {
                    echo "Dashboard";
                }
                ?>
            </h5>
        </div>
        <ul class="nav col-md-6 justify-content-md-end pt-md-0 pt-4 px-2">
            <?php if (!empty($this->params['hMenu'])) { ?>
                <div class="dropdown mr-2">
                    <button type="button" class="btn btn-sm drpdwn-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 6C14 7.10457 13.1046 8 12 8C10.8954 8 10 7.10457 10 6C10 4.89543 10.8954 4 12 4C13.1046 4 14 4.89543 14 6Z"
                                  fill="currentColor"/>
                            <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                  fill="currentColor"/>
                            <path d="M14 18C14 19.1046 13.1046 20 12 20C10.8954 20 10 19.1046 10 18C10 16.8954 10.8954 16 12 16C13.1046 16 14 16.8954 14 18Z"
                                  fill="currentColor"/>
                        </svg>
                    </button>
                    <?= hMenu::widget(['itemTemplate' => '{link}', // template for all links
                        //'activeItemTemplate' => '<a class="dropdown-item">{link}</a>', // template for all links
                        'links' => isset($this->params['hMenu']) ? $this->params['hMenu'] : [],]) ?>
                </div>
            <?php } else {
                ?>
                <li class="nav-item dropdown mr-2">
                    <button type="button" class="btn btn-sm drpdwn-1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 6C14 7.10457 13.1046 8 12 8C10.8954 8 10 7.10457 10 6C10 4.89543 10.8954 4 12 4C13.1046 4 14 4.89543 14 6Z"
                                  fill="currentColor"/>
                            <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                                  fill="currentColor"/>
                            <path d="M14 18C14 19.1046 13.1046 20 12 20C10.8954 20 10 19.1046 10 18C10 16.8954 10.8954 16 12 16C13.1046 16 14 16.8954 14 18Z"
                                  fill="currentColor"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sideTglrDrpDwn">
                        <?php
                        if (empty(Yii::$app->params['left-side-menu-item'])) {
                            ?>
                            <li class="keyboard-main">
                                <a class="dropdown-item" href="#" id="sidebarCollapse"> Toggle Main Sidebar<span
                                            class="badge badge-ctrl pen-apv">Alt (⌥) + K</span></a>
                            </li>
                        <?php }
                        ?>
                        <?php
                        if (!empty(Yii::$app->params['left-side-menu-item'])) {
                            ?>
                            <li class="keyboard-main">
                                <a class="dropdown-item" href="#" id="sidebarCollapse4"> Toggle Inner
                                    Sidebar<span class="badge badge-ctrl pen-apv">Alt (⌥) + ;</span></a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </li>
                <?php
            }
            ?>
            <?php if (!empty($this->params['hbutton'])) { ?><?php
                $btnArray = $this->params['hbutton'];
                foreach ($btnArray as $btnValue) {
                    echo $btnValue;
                }
            } ?>
        </ul>
    </div>