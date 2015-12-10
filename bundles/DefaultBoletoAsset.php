<?php

namespace parallaxsolutions\yii2boletos\bundles;

use yii\web\AssetBundle;

class DefaultBoletoAsset extends AssetBundle {
    
    public $sourcePath = '@parallaxsolutions/yii2boletos/assets/';
    public $css = [
        'css/default.css',
    ];
    public $depends = [
    ];

}
