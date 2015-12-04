<?php

class MapperArquivo240Santander implements MapperArquivo240 {

    public function map(ILayoutLoteTituloEmCobranca $lote, BoletoCedenteActiveRecord $cedente) {
        $arquivo = new SantanderLayout240;
        $arquivo->addLote($lote);
        
        //header
        $arquivo->header_data_de_geracao_do_arquivo = date('dmY');
        $arquivo->header_codigo_remessa_retorno = 1;//segundo o documento é um para o caso de remessa
        $arquivo->header_tipo_de_inscricao_da_empresa = SantanderConstants::TIPO_DE_INSCRICAO_DA_EMPRESA_CNPJ;
        $arquivo->header_numero_de_inscricao_da_empresa = $cedente->documento;
        $arquivo->header_codigo_de_transmissao = $cedente->agencia . str_pad($cedente->identificacao_beneficiario,11,'0',STR_PAD_LEFT);
        $arquivo->header_nome_da_empresa = $cedente->nome;
        $arquivo->header_numero_sequencial_do_arquivo = $cedente->numero_sequencia_arquivo;
        
        //trailer
        $arquivo->trailer_quantidade_de_lotes_de_arquivo = 1;
        $arquivo->trailer_quantidade_de_registros_do_arquivo = $lote->segmentosCount() + 4; //quatidade total de linhas, cada segmento eh uma linha e mais 2 linhas de lote e mais 2 linhas de arquivo, por  isso = segmentos  + 4

        return $arquivo;
    }

}
