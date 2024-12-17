<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['css/custom.css','css/custom-modal.css','css/custom-buttons.css','css/custom-cards.css','css/custom-dropdown.css',
        'css/custom-media-query.css','css/custom-nav.css','css/custom-spacing.css','css/custom-tables.css','css/custom-yii2-vendors.css',
        'css/material-design-iconic-font.css','css/bs-stepper.min.css','css/bootstrap-icons.css','css/toastr.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'
        ];
    public $js = ['js/main.js', 'js/custom.js', 'js/perfect-scrollbar.js', 'js/toastr.min.js', 'js/bs-stepper.min.js'];
    public $depends = ['yii\web\YiiAsset', 'yii\bootstrap5\BootstrapPluginAsset', 'yii\bootstrap5\BootstrapAsset'];

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->sourcePath = __DIR__ . '/../src';
    }
}
