<?php

interface IProcessor {

    /**
     * @param IBoletoRetorno $boletoRetorno
     * @return boolean
     */
    public function processar(IBoletoRetorno $boletoRetorno);
}
