<?php

class EntradaConfirmadaSantander implements IEntradaConfirmadaRetorno {

    public function processar(IBoletoRetorno $boletoRetorno) {

        if ($boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_ENTRADA_CONFIRMADA) {            
            return true;
        }
    }

}
