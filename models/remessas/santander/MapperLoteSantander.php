<?php

class MapperLoteSantander implements MapperLote{
    public function map(BoletoCedenteActiveRecord $cedente,$segmentos) {
        $lote = new SantanderLayout240LoteTitulosEmCobranca;
        foreach($segmentos as $segmento)
            $lote->addSegmento ($segmento);
        //header
        $lote->header_lote_de_servico = 1;
        $lote->header_tipo_de_inscricao_da_empresa = SantanderConstants::TIPO_DE_INSCRICAO_DA_EMPRESA_CNPJ;
        $lote->header_numero_de_inscricao_da_empresa = $cedente->documento;
        $lote->header_codigo_de_transmissao = $cedente->agencia . str_pad($cedente->identificacao_beneficiario,11,'0',STR_PAD_LEFT);
        $lote->header_nome_da_empresa = $cedente->nome;
        $lote->header_data_da_gravacao_remessa_retorno = date('dmY');
        //trailer
        $lote->trailer_lote_de_servico = 1;
        $lote->trailer_quantidade_de_registros_no_lote = $lote->segmentosCount() + 2;

        return $lote;  
    }

}
