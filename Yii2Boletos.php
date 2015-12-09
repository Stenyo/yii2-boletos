<?php

namespace parallaxsolutions\yii2boletos;

use Yii;
use \yii\base\Component;

class Yii2Boletos extends Component {

    public static $componentName = 'boletos';
    //public $MathClass = 'parallaxsolutions\yii2boletos\models\Math';

    /**
     * @return Slideshow get Slideshow component
     */
    public static function getComponent() {
        return Yii::$app->{static::$componentName};
    }

}
