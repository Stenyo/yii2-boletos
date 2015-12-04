<?php

/**
 * @property int $header_codigo_de_transmissao
 * @property string $header_uso_exclusivo_febraban_cnab_4
 * @property string $header_codigo_do_beneficiario
 * @property string $header_uso_exclusivo_febraban_cnab_5
 */
class SantanderLayout240 extends Layout240 {

    const NOME_DO_BANCO = 'Banco Santander';
    const N_DA_VERSAO_DO_LAYOUT_DO_ARQUIVO = 40;

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->incrementoQuantidadeDeRegistro = 2;

        $this->header_codigo_do_banco_na_compensacao = Constants::CODIGO_BANCO_SANTANDER;
        $this->header_nome_do_banco = self::NOME_DO_BANCO;
        $this->header_numero_da_versao_do_layout_do_arquivo = self::N_DA_VERSAO_DO_LAYOUT_DO_ARQUIVO;
        $this->trailer_codigo_do_banco_na_compensacao = Constants::CODIGO_BANCO_SANTANDER;
        $this->trailer_uso_exclusivo_febraban_cnab_2 = str_repeat(' ', 211);
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'header_codigo_de_transmissao',
            'header_uso_exclusivo_febraban_cnab_4',
            'header_codigo_do_beneficiario',
            'header_uso_exclusivo_febraban_cnab_5',
        ));
    }

    /**
     * 
     * @param string $input
     */
    public function readHeader($input) {
        parent::readHeader($input);
        $this->header_uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 8, 8));
        $this->header_tipo_de_inscricao_da_empresa = (float) substr($input, 16, 1);
        $this->header_numero_de_inscricao_da_empresa = (float) substr($input, 17, 15);
        unset($this->header_codigo_do_convenio_no_banco);
        $this->header_agencia_mantenedora_da_conta = (float) substr($input, 32, 4); // Agência do Beneficiário 
        $this->header_digito_verificador_da_agencia = (float) substr($input, 36, 1); // Dígito da Agência do Beneficiário
        $this->header_numero_da_conta_corrente = (float) substr($input, 37, 9);
        $this->header_digito_verificador_da_conta = (float) substr($input, 46, 1);
        unset($this->header_digito_verificador_da_agencia_conta);
        unset($this->header_hora_de_geracao_do_arquivo);
        $this->header_uso_exclusivo_febraban_cnab_4 = rtrim(substr($input, 47, 5));
        $this->header_codigo_do_beneficiario = (float) substr($input, 52, 9);
        $this->header_uso_exclusivo_febraban_cnab_5 = rtrim(substr($input, 61, 11));
        unset($this->header_para_uso_reservado_do_banco);
        unset($this->header_para_uso_reservado_da_empresa);
        $this->header_uso_exclusivo_febraban_cnab_3 = rtrim(substr($input, 166, 74));
    }

    /**
     * @param string $input
     */
    public function readTrailer($input) {
        parent::readTrailer($input);
        unset($this->trailer_quantidade_de_contas_para_conciliacao_lotes);
        $this->trailer_uso_exclusivo_febraban_cnab_2 = rtrim(substr($input, 29, 211));
    }

    /**
     * @param string $input
     * @return \SantanderLayout240LoteTitulosEmCobranca
     */
    public function readLoteTituloEmCobranca($input) {
        $lote = new SantanderLayout240LoteTitulosEmCobranca;
        $lote->read($input);
        $this->_lotes->insertAt(0, $lote);
        return $lote;
    }

    /**
     * @return string
     */
    public function renderHeader() {
        $renderLayout = parent::renderHeader();
        $out = '';
        $out .= substr($renderLayout, 0, 16); //código do banco na compensação,lote do serviço,tipo de registro,uso banco
        $out .= str_pad($this->header_tipo_de_inscricao_da_empresa, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_de_inscricao_da_empresa, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_codigo_de_transmissao, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_4, 25, ' ', STR_PAD_RIGHT);
        $out .= substr($renderLayout, 72, 79); //nome da empresa, nome do banco, uso do banco2,código remessa, data de geração do arquivo
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_5, 6, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_numero_sequencial_do_arquivo, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_da_versao_do_layout_do_arquivo, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_3, 74, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderTrailer() {
        $renderLayout = parent::renderTrailer();
        $render = '';
        $render .= substr($renderLayout, 0, 29); //código do banco na compensação,lote do serviço,tipo de registro,uso banco,qunatidade de lotes,quantidade de registros
        $render .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_2, 211, ' ', STR_PAD_RIGHT);
        $render .= $this->_lineFeed;
        return $render;
    }

}
