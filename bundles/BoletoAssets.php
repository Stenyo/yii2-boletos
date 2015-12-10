<?php

namespace parallaxsolutions\yii2boletos\bundles;

use yii\web\AssetBundle;

class BoletoAssets extends AssetBundle {

    public $sourcePath = '@parallaxsolutions/yii2boletos/assets/';
    public $css = [
        'assets/css/bb.css',
        'assets/css/default.css',
        'assets/css/caixa.css',
    ];
    public $depends = [
    ];

}
