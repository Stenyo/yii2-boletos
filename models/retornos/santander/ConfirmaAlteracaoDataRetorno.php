<?php

class ConfirmaAlteracaoDataRetorno implements IConfirmaAlteracaoDataRetorno {

    public function processar(IBoletoRetorno $boletoRetorno) {

        if ($boletoRetorno->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_CONFIRMACAO_RECEBIMENTO_INSTRUCAO_ALTERACAO_DE_VENCIMENTO) {            
            return true;
        }
    }

}
