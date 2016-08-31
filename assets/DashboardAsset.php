<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [        
		'css/bootstrap.min.css',
		'fonts/css/font-awesome.min.css',
		'css/ionicons.min.css',
		'css/lte.min.css',
		'css/skins/_all-skins.min.css',
		'plugins/iCheck/flat/blue.css',			
    ];
    public $js = [		
		'js/bootstrap.min.js',
		'js/jquery-ui.min.js',
		'js/raphael-min.js',			
		'plugins/sparkline/jquery.sparkline.min.js',
		'plugins/slimScroll/jquery.slimscroll.min.js',
		'plugins/fastclick/fastclick.js',
		'js/app.min.js',
		'js/dashboard.js',
		'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
