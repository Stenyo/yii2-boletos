<?php

class ErrosRetornoSantander implements IErrosBoletoRetorno {

    public function processar(IBoletoRetorno $boletoRetorno) {
        if ($boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_ENTRADA_REJEITADA || $boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_INSTRUCAO_REJEITADA || $boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_ALTERACAO_DE_DADOS_REJEITADA) {
            return true;
        }
    }

}
