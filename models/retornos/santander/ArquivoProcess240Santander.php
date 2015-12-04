<?php

class ArquivoProcess240Santander extends ArquivoProcess240 {

    /**
     * @var IBoletoRetornoMapper
     */
    public $boletoRetornoMapper;
    public $boletoDesconhecido;

    public function __construct(IBoletoRetornoMapper $boletoRetornoMapper, IBoletoDesconhecido $boletoDesconhecido) {
        parent::__construct();
        $this->boletoRetornoMapper = $boletoRetornoMapper;
        $this->boletoDesconhecido = $boletoDesconhecido;
    }

    public function processar(ILayout $layout) {
        $retorno = new RetornoActiveRecord;
        $retorno->banco_codigo = $layout->header_codigo_do_banco_na_compensacao;
        $cedente = BoletoCedenteActiveRecord::model()->findByAttributes(array('identificacao_beneficiario' => $layout->header_codigo_do_beneficiario))->id;
        if ($cedente == null) {
            throw new Exception('Cendente não encontrado');
        }
        $retorno->boleto_cedente_id = $cedente;
        $retorno->data = date('Y-m-d H:i:s');
        $retorno->layout = 240;
        

        $cont = 0;
        foreach ($layout->getLotesIterator() as $lote) {
            $cont += $lote->segmentosCount();
        }
        $retorno->numero_boletos = (int) ($cont / 2);
        $retorno->save(false);

        foreach ($layout->getLotesIterator() as $lote) {
            foreach ($it = $lote->getSegmentosIterator() as $segmento) {
                $segmentoT = $segmento;
                $it->next();
                $segmento = $it->current();
                $segmentoU = $segmento;

                $this->boletoRetornoMapper->setSegmentoT($segmentoT);
                $this->boletoRetornoMapper->setSegmentoU($segmentoU);
                $boletoRetornoSantander = $this->boletoRetornoMapper->map();
                $boletoRetornoSantander->retorno_id = $retorno->id;
                $this->boletoDesconhecido->setNumero_de_sequencia_segmento_t($segmentoT->numero_sequencial_do_registro_no_lote);
                $this->boletoDesconhecido->setNumero_de_sequencia_segmento_u($segmentoU->numero_sequencial_do_registro_no_lote);
                if (!$this->boletoDesconhecido->processar($boletoRetornoSantander)) {
                    foreach ($this->getMovimentosRetornoIterator() as $movimentoRetorno) {
                        $boletoRetornoSantander->boleto_id = BoletoActiveRecord::model()->findByAttributes(array('nosso_numero' => $boletoRetornoSantander->nosso_numero))->id;
                        if ($movimentoRetorno->processar($boletoRetornoSantander)) {
                            if ($boletoRetornoSantander->save(false)) {
                                if ($boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_LIQUIDACAO || $boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_LIQUIDACAO_APOS_BAIXA_OU_LIQUIDACAO_TITULO_NAO_REGISTRADO || $boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_BAIXA || $boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_ENTRADA_REJEITADA || $boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_INSTRUCAO_REJEITADA || $boletoRetornoSantander->codigo_de_movimento == SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_ALTERACAO_DE_DADOS_REJEITADA) {
                                    $boletoRetornoSantander->boleto->remessa = '';
                                    $boletoRetornoSantander->boleto->save();
                                }
                            }
                        }
                    }
                }
            }
        }
        return $retorno;
    }

}
