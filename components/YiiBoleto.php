<?php

class YiiBoleto extends CApplicationComponent {

    private static $_instance;
    private $_assetsUrl;
    public $forceCopyAssets = false;
    public $packages = array();
    public $cs;
    public $coreCss = true;
    public $includeStantanderModels = false;

    public function init() {
        if ($this->isInConsoleMode() && !$this->isInTests())
            return;

        self::setBoletoYii($this);
        $this->setRootAliasIfUndefined();
        $this->setAssetsRegistryIfNotDefined();
        $this->includeAssets();
        $this->importModels();
        parent::init();
    }

    protected function setRootAliasIfUndefined() {
        if (Yii::getPathOfAlias('yii-boleto') === false) {
            Yii::setPathOfAlias('yii-boleto', realpath(dirname(__FILE__) . '/..'));
        }
    }

    protected function importModels() {
        Yii::import('yii-boleto.exeptions.*');
        Yii::import('yii-boleto.models.*');
        Yii::import('yii-boleto.models.ar.*');
        Yii::import('yii-boleto.models.boletos.*');
        Yii::import('yii-boleto.models.layouts.*');
        Yii::import('yii-boleto.models.pagamentos.*');
        Yii::import('yii-boleto.models.remessas.*');
        Yii::import('yii-boleto.models.retornos.*');

        if ($this->includeStantanderModels) {
            Yii::import('yii-boleto.models.layouts.cnab240.*');
            Yii::import('yii-boleto.models.ar.santander.*');
            Yii::import('yii-boleto.models.boletos.santander.*');
            Yii::import('yii-boleto.models.layouts.santander.*');
            Yii::import('yii-boleto.models.remessas.santander.*');
            Yii::import('yii-boleto.models.retornos.santander.*');
        }
    }

    protected function setAssetsRegistryIfNotDefined() {
        if (!$this->cs) {
            $this->cs = Yii::app()->getClientScript();
        }
    }

    protected function includeAssets() {
        $this->appendUserSuppliedPackagesToOurs();
        $this->addOurPackagesToYii();
        $this->registerCssPackagesIfEnabled();
    }

    protected function appendUserSuppliedPackagesToOurs() {
        $BoletoYiiPackages = $this->createBoletoYiiCssPackage();
        $this->packages = CMap::mergeArray($BoletoYiiPackages, $this->packages);
    }

    protected function createBoletoYiiCssPackage() {
        return array('yii-boleto' => array(
                'baseUrl' => $this->getAssetsUrl(),
                'css' => array('css/style.css'),
        ));
    }

    public function getAssetsUrl() {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            return $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('yii-boleto.assets'), false, -1, $this->forceCopyAssets);
        }
    }

    protected function addOurPackagesToYii() {
        foreach ($this->packages as $name => $definition) {
            $this->cs->addPackage($name, $definition);
        }
    }

    protected function registerCssPackagesIfEnabled() {
        if (!$this->coreCss)
            return;
        $this->cs->registerPackage('yii-boleto');
    }

    protected function isInConsoleMode() {
        return Yii::app() instanceof CConsoleApplication || PHP_SAPI == 'cli';
    }

    protected function isInTests() {
        return defined('IS_IN_TESTS') && IS_IN_TESTS;
    }

    public static function setBoletoYii($value) {
        if ($value instanceof Booster) {
            self::$_instance = $value;
        }
    }

    public static function getBoletoYii() {
        if (null === self::$_instance) {
            $module = Yii::app()->getController()->getModule();
            if ($module) {
                if ($module->hasComponent('yii-boleto')) {
                    self::$_instance = $module->getComponent('yii-boleto');
                }
            }
            if (null === self::$_instance) {
                if (Yii::app()->hasComponent('yii-boleto')) {
                    self::$_instance = Yii::app()->getComponent('yii-boleto');
                }
            }
        }
        return self::$_instance;
    }

}
