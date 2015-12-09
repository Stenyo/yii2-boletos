<?php
namespace parallaxsolutions\yii2boletos\models\retornos;
interface IProcessor {

    /**
     * @param IBoletoRetorno $boletoRetorno
     * @return boolean
     */
    public function processar(IBoletoRetorno $boletoRetorno);
}
