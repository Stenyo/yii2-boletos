<?php

/**
 * @property int $header_codigo_do_beneficiario
 * @property int $header_codigo_de_transmissao
 * @property string $header_uso_exclusivo_febraban_cnab_4
 * @property string $header_uso_exclusivo_febraban_cnab_5
 * @property string $header_uso_exclusivo_febraban_cnab_6
 */
class SantanderLayout240LoteTitulosEmCobranca extends Layout240LoteTitulosEmCobranca {

    const TIPO_DE_OPERACAO = 'R';
    const N_DA_VERSAO_DO_LAYOUT_DO_LOTE = 30;

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->header_codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
        $this->header_tipo_de_operacao = self::TIPO_DE_OPERACAO;
        $this->header_numero_da_versao_do_layout_do_lote = self::N_DA_VERSAO_DO_LAYOUT_DO_LOTE;
        $this->header_uso_exclusivo_febraban_cnab_3 = str_repeat(' ', 41);
        $this->header_uso_exclusivo_febraban_cnab_6 = str_repeat(' ', 5);
        $this->trailer_uso_exclusivo_febraban_cnab_2 = str_repeat(' ', 217);
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'header_codigo_do_beneficiario',
            'header_codigo_de_transmissao',
            'header_uso_exclusivo_febraban_cnab_4',
            'header_uso_exclusivo_febraban_cnab_5',
            'header_uso_exclusivo_febraban_cnab_6',
        ));
    }

    /**
     * @return string
     */
    public function renderTrailer() {
        $trailerPai = parent::renderTrailer();
        $out = '';
        $out .= substr($trailerPai, 0, 23);
        $out .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_2, 217, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderHeader() {
        $header = parent::renderHeader();
        $out = '';
        $out .= substr($header, 0, 53);
        $out .= str_pad($this->header_codigo_de_transmissao, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_6, 5, ' ', STR_PAD_RIGHT);
        $out .= substr($header, 73, 126);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_3, 41, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @param string $input
     */
    public function readHeader($input) {
        parent::readHeader($input);
        $this->header_codigo_do_beneficiario = (float) substr($input, 33, 9);
        unset($this->header_codigo_do_convenio_no_banco);
        $this->header_uso_exclusivo_febraban_cnab_4 = rtrim(substr($input, 42, 11));
        $this->header_agencia_mantenedora_da_conta = (float) substr($input, 53, 4); // Agência do beneficiário
        $this->header_digito_verificador_da_conta_1 = (float) substr($input, 57, 1); // Dígito da Âgencia do Beneficiário
        $this->header_numero_da_conta_corrente = (float) substr($input, 58, 9);
        $this->header_digito_verificador_da_conta_2 = (float) substr($input, 67, 1);
        unset($this->header_digito_verificador_da_agencia_conta);
        $this->header_uso_exclusivo_febraban_cnab_5 = rtrim(substr($input, 68, 5));
        unset($this->header_mensagem_1);
        unset($this->header_mensagem_2);
        $this->header_uso_exclusivo_febraban_cnab_6 = rtrim(substr($input, 103, 80));
        unset($this->header_data_do_credito);
    }

    /**
     * @param string $input
     * @return \SantanderLayout240SegmentoT
     */
    public function readSegmentoT($input) {
        $segmento = new SantanderLayout240SegmentoT;
        $segmento->read($input);
        $this->_segmentos->add($segmento);
        return $segmento;
    }

    /**
     * @param string $input
     * @return \SantanderLayout240SegmentoU
     */
    public function readSegmentoU($input) {
        $segmento = new SantanderLayout240SegmentoU;
        $segmento->read($input);
        $this->_segmentos->add($segmento);
        return $segmento;
    }

}
