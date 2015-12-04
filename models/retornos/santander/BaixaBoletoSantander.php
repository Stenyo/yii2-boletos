<?php

class BaixaBoletoSantander implements ILiquidacaoRetorno {

    public function processar(IBoletoRetorno $boletoRetorno) {

        if ($boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_BAIXA) {
            return true;
        }
    }

}
