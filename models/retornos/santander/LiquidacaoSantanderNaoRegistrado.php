<?php

class LiquidacaoSantanderNaoRegistrado implements ILiquidacaoRetorno {

    public function processar(IBoletoRetorno $boletoRetorno) {

        if ($boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_LIQUIDACAO_APOS_BAIXA_OU_LIQUIDACAO_TITULO_NAO_REGISTRADO) {            
            return true;
        }
    }

}
