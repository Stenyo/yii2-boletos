<?php

/**
 * @property int $header_codigo_do_banco_na_compensacao
 * @property int $header_lote_de_servico
 * @property int $header_tipo_de_registro
 * @property string $header_tipo_de_operacao
 * @property int $header_tipo_de_servico
 * @property string $header_uso_exclusivo_febraban_cnab_1
 * @property int $header_numero_da_versao_do_layout_do_lote
 * @property string $header_uso_exclusivo_febraban_cnab_2
 * @property int $header_tipo_de_inscricao_da_empresa
 * @property int $header_numero_de_inscricao_da_empresa
 * @property string $header_codigo_do_convenio_no_banco
 * @property int $header_agencia_mantenedora_da_conta
 * @property string $header_digito_verificador_da_conta_1
 * @property int $header_numero_da_conta_corrente
 * @property string $header_digito_verificador_da_conta_2
 * @property string $header_digito_verificador_da_agencia_conta
 * @property string $header_nome_da_empresa
 * @property string $header_mensagem_1
 * @property string $header_mensagem_2
 * @property int $header_numero_remessa_retorno
 * @property int $header_data_da_gravacao_remessa_retorno
 * @property int $header_data_do_credito
 * @property string $header_uso_exclusivo_febraban_cnab_3
 * @property int $trailer_codigo_do_banco_na_compensacao
 * @property int $trailer_lote_de_servico
 * @property int $trailer_tipo_de_registro
 * @property string $trailer_uso_exclusivo_febraban_cnab_1
 * @property int $trailer_quantidade_de_registros_no_lote
 * @property int $trailer_cobranca_simples_quantidade_de_titulos_em_cobranca
 * @property int $trailer_cobranca_simples_valor_total_dos_titulos_em_carteiras
 * @property int $trailer_cobranca_vinculada_quantidade_de_titulos_em_cobranca
 * @property int $trailer_cobranca_vinculada_valor_total_dos_titulos_em_carteiras
 * @property int $trailer_cobranca_caucionada_quantidade_de_titulos_em_cobranca
 * @property int $trailer_cobranca_caucionada_valor_total_dos_titulos_em_carteiras
 * @property int $trailer_cobranca_descontada_quantidade_de_titulos_em_cobranca
 * @property int $trailer_cobranca_descontada_valor_total_dos_titulos_em_carteiras
 * @property string $trailer_numero_do_aviso_de_lancamento
 * @property string $trailer_uso_exclusivo_febraban_cnab_2
 */
class Layout240LoteTitulosEmCobranca extends Layout240Lote implements IRenderable, IReadable, ILayoutLoteTituloEmCobranca {

    const HEADER_TIPO_DE_REGISTRO = '1';
    const TIPO_DE_SERVICO = '01'; // Cobrança
    const NUMERO_DA_VERSAO_DO_LAYOUT_DO_LOTE = '047';
    const TRAILER_TIPO_DE_REGISTRO = 5;

    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->header_tipo_de_registro = self::HEADER_TIPO_DE_REGISTRO;
        $this->header_tipo_de_servico = self::TIPO_DE_SERVICO;
        $this->header_numero_da_versao_do_layout_do_lote = self::NUMERO_DA_VERSAO_DO_LAYOUT_DO_LOTE;

        $this->trailer_codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
        $this->trailer_tipo_de_registro = self::TRAILER_TIPO_DE_REGISTRO;
    }
    
    function __set($propriedade, $valor) {
        switch ($propriedade) {
            case 'header_nome_da_empresa':
                $this->header_nome_da_empresa = strtoupper(substr($valor, 0,30));
                break;
            case 'header_mensagem_1':
                $this->header_mensagem_1 = strtoupper(substr($valor, 0,40));
                break;
            case 'header_mensagem_2':
                $this->header_mensagem_2 = strtoupper(substr($valor, 0,40));
                break;
            default :
                $this->$propriedade = $valor;
        }
    }
    
    public function rules() {
        return array(
            array('header_codigo_do_banco_na_compensacao', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999),
            array('header_lote_de_servico', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999),
            array('header_tipo_de_registro', 'in', 'range' => array(self::HEADER_TIPO_DE_REGISTRO), 'allowEmpty' => false),
            array('header_tipo_de_operacao', 'length', 'max' => 1),
            array('header_tipo_de_servico', 'in', 'range' => array(self::TIPO_DE_SERVICO), 'allowEmpty' => false),
            array('header_uso_exclusivo_febraban_cnab_1', 'length', 'max' => 2),
            array('header_numero_da_versao_do_layout_do_lote', 'in', 'range' => array(self::HEADER_TIPO_DE_REGISTRO), 'allowEmpty' => false),
            array('header_tipo_de_inscricao_da_empresa', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('header_numero_de_inscricao_da_empresa', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('header_codigo_do_convenio_no_banco', 'length', 'max' => 20),
            array('header_agencia_mantenedora_da_conta', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('header_digito_verificador_da_conta_1', 'length', 'max' => 1),
            array('header_numero_da_conta_corrente', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999),
            array('header_digito_verificador_da_conta_2', 'length', 'max' => 1),
            array('header_digito_verificador_da_agencia_conta', 'length', 'max' => 1),
            array('header_nome_da_empresa', 'length', 'max' => 30),
            array('header_mensagem_1', 'length', 'max' => 40),
            array('header_mensagem_2', 'length', 'max' => 40),
            array('header_numero_remessa_retorno', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999),
            array('header_data_da_gravacao_remessa_retorno', 'date', 'format' => 'ddMMyyyy'),
            array('header_data_do_credito', 'date', 'format' => 'ddMMyyyy'),
            array('header_uso_exclusivo_febraban_cnab_3', 'length', 'max' => 33),
            array('trailer_codigo_do_banco_na_compensacao', 'in', 'range' => array(SantanderConstants::CODIGO_DO_BANCO), 'allowEmpty' => false),
            array('trailer_lote_de_servico', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999),
            array('trailer_tipo_de_registro', 'in', 'range' => self::TRAILER_TIPO_DE_REGISTRO, 'allowEmpty' => false),
            array('trailer_uso_exclusivo_febraban_cnab_1', 'length', 'max' => 9),
            array('trailer_quantidade_de_registros_no_lote', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999),
            array('trailer_cobranca_simples_quantidade_de_titulos_em_cobranca', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999),
            array('trailer_cobranca_simples_valor_total_dos_titulos_em_carteiras', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999999999999),
            array('trailer_cobranca_vinculada_quantidade_de_titulos_em_cobranca', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999),
            array('trailer_cobranca_vinculada_valor_total_dos_titulos_em_carteiras', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999999999999),
            array('trailer_cobranca_caucionada_quantidade_de_titulos_em_cobranca', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999),
            array('trailer_cobranca_caucionada_valor_total_dos_titulos_em_carteiras', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999999999999),
            array('trailer_cobranca_descontada_quantidade_de_titulos_em_cobranca', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999),
            array('trailer_cobranca_descontada_valor_total_dos_titulos_em_carteiras', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999999999999),
            array('trailer_numero_do_aviso_de_lancamento', 'length', 'max' => 8),
            array('trailer_uso_exclusivo_febraban_cnab_2', 'length', 'max' => 117),
        );
    }

    public function attributeNames() {
        return array(
            'header_codigo_do_banco_na_compensacao',
            'header_lote_de_servico',
            'header_tipo_de_registro',
            'header_tipo_de_operacao',
            'header_tipo_de_servico',
            'header_uso_exclusivo_febraban_cnab_1',
            'header_numero_da_versao_do_layout_do_lote',
            'header_uso_exclusivo_febraban_cnab_2',
            'header_tipo_de_inscricao_da_empresa',
            'header_numero_de_inscricao_da_empresa',
            'header_codigo_do_convenio_no_banco',
            'header_agencia_mantenedora_da_conta',
            'header_digito_verificador_da_conta_1',
            'header_numero_da_conta_corrente',
            'header_digito_verificador_da_conta_2',
            'header_digito_verificador_da_agencia_conta',
            'header_nome_da_empresa',
            'header_mensagem_1',
            'header_mensagem_2',
            'header_numero_remessa_retorno',
            'header_data_da_gravacao_remessa_retorno',
            'header_data_do_credito',
            'header_uso_exclusivo_febraban_cnab_3',
            'trailer_codigo_do_banco_na_compensacao',
            'trailer_lote_de_servico',
            'trailer_tipo_de_registro',
            'trailer_uso_exclusivo_febraban_cnab_1',
            'trailer_quantidade_de_registros_no_lote',
            'trailer_cobranca_simples_quantidade_de_titulos_em_cobranca',
            'trailer_cobranca_simples_valor_total_dos_titulos_em_carteiras',
            'trailer_cobranca_vinculada_quantidade_de_titulos_em_cobranca',
            'trailer_cobranca_vinculada_valor_total_dos_titulos_em_carteiras',
            'trailer_cobranca_caucionada_quantidade_de_titulos_em_cobranca',
            'trailer_cobranca_caucionada_valor_total_dos_titulos_em_carteiras',
            'trailer_cobranca_descontada_quantidade_de_titulos_em_cobranca',
            'trailer_cobranca_descontada_valor_total_dos_titulos_em_carteiras',
            'trailer_numero_do_aviso_de_lancamento',
            'trailer_uso_exclusivo_febraban_cnab_2',
        );
    }

    /**
     * @return string
     */
    public function render() {
        $out = '';
        $out .= $this->renderHeader();
        $out .= $this->renderSegmentos();
        $out .= $this->renderTrailer();
        return $out;
    }

    /**
     * @return string
     */
    public function renderHeader() {
        $out = '';
        $out .= str_pad($this->header_codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_tipo_de_operacao, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_tipo_de_servico, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_1, 2, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_numero_da_versao_do_layout_do_lote, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_2, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_tipo_de_inscricao_da_empresa, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_de_inscricao_da_empresa, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_codigo_do_convenio_no_banco, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_agencia_mantenedora_da_conta, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_digito_verificador_da_conta_1, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_numero_da_conta_corrente, 12, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_digito_verificador_da_conta_2, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_digito_verificador_da_agencia_conta, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_nome_da_empresa, 30, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_mensagem_1, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_mensagem_2, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_numero_remessa_retorno, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_data_da_gravacao_remessa_retorno, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_data_do_credito, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_3, 33, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderTrailer() {
        $out = '';
        $out .= str_pad($this->trailer_codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_1, 9, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->trailer_quantidade_de_registros_no_lote, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_simples_quantidade_de_titulos_em_cobranca, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_simples_valor_total_dos_titulos_em_carteiras, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_vinculada_quantidade_de_titulos_em_cobranca, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_vinculada_valor_total_dos_titulos_em_carteiras, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_caucionada_quantidade_de_titulos_em_cobranca, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_caucionada_valor_total_dos_titulos_em_carteiras, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_descontada_quantidade_de_titulos_em_cobranca, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_cobranca_descontada_valor_total_dos_titulos_em_carteiras, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_numero_do_aviso_de_lancamento, 8, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_2, 117, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderSegmentos() {
        $out = '';
        foreach ($this->_segmentos as $segmento) {
            $out .= $segmento->render();
        }
        return $out;
    }

    /**
     * @param string $input
     */
    public function read($input) {
        $linhas = explode($this->_lineFeed, $input);
        unset($linhas[count($linhas) - 1]);

        $this->readHeader($linhas[0]);
        $this->readTrailer($linhas[count($linhas) - 1]);

        unset($linhas[0]);
        unset($linhas[count($linhas)]);
        $this->readSegmentos(implode($this->_lineFeed, array_values($linhas)) . $this->_lineFeed);
    }

    /**
     * @param string $input
     */
    public function readHeader($input) {
        $this->header_codigo_do_banco_na_compensacao = (float) substr($input, 0, 3);
        $this->header_lote_de_servico = (float) substr($input, 3, 4);
        $this->header_tipo_de_registro = (float) substr($input, 7, 1);
        $this->header_tipo_de_operacao = rtrim(substr($input, 8, 1));
        $this->header_tipo_de_servico = (float) substr($input, 9, 2);
        $this->header_uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 11, 2));
        $this->header_numero_da_versao_do_layout_do_lote = (float) substr($input, 13, 3);
        $this->header_uso_exclusivo_febraban_cnab_2 = rtrim(substr($input, 16, 1));
        $this->header_tipo_de_inscricao_da_empresa = (float) substr($input, 17, 1);
        $this->header_numero_de_inscricao_da_empresa = (float) substr($input, 18, 15);
        $this->header_codigo_do_convenio_no_banco = rtrim(substr($input, 33, 20));
        $this->header_agencia_mantenedora_da_conta = (float) substr($input, 53, 5);
        $this->header_digito_verificador_da_conta_1 = rtrim(substr($input, 58, 1));
        $this->header_numero_da_conta_corrente = (float) substr($input, 59, 12);
        $this->header_digito_verificador_da_conta_2 = rtrim(substr($input, 71, 1));
        $this->header_digito_verificador_da_agencia_conta = rtrim(substr($input, 72, 1));
        $this->header_nome_da_empresa = rtrim(substr($input, 73, 30));
        $this->header_mensagem_1 = rtrim(substr($input, 103, 40));
        $this->header_mensagem_2 = rtrim(substr($input, 143, 40));
        $this->header_numero_remessa_retorno = (float) substr($input, 183, 8);
        $this->header_data_da_gravacao_remessa_retorno = (float) substr($input, 191, 8);
        $this->header_data_do_credito = (float) substr($input, 199, 8);
        $this->header_uso_exclusivo_febraban_cnab_3 = rtrim(substr($input, 207, 33));
    }

    /**
     * @param string $input
     */
    public function readTrailer($input) {
        $this->trailer_codigo_do_banco_na_compensacao = (float) substr($input, 0, 3);
        $this->trailer_lote_de_servico = (float) substr($input, 3, 4);
        $this->trailer_tipo_de_registro = (float) substr($input, 7, 1);
        $this->trailer_uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 8, 9));
        $this->trailer_quantidade_de_registros_no_lote = (float) substr($input, 17, 6);
        $this->trailer_cobranca_simples_quantidade_de_titulos_em_cobranca = (float) substr($input, 23, 6);
        $this->trailer_cobranca_simples_valor_total_dos_titulos_em_carteiras = (float) substr($input, 29, 17);
        $this->trailer_cobranca_vinculada_quantidade_de_titulos_em_cobranca = (float) substr($input, 46, 6);
        $this->trailer_cobranca_vinculada_valor_total_dos_titulos_em_carteiras = (float) substr($input, 52, 17);
        $this->trailer_cobranca_caucionada_quantidade_de_titulos_em_cobranca = (float) substr($input, 69, 6);
        $this->trailer_cobranca_caucionada_valor_total_dos_titulos_em_carteiras = (float) substr($input, 75, 17);
        $this->trailer_cobranca_descontada_quantidade_de_titulos_em_cobranca = (float) substr($input, 92, 6);
        $this->trailer_cobranca_descontada_valor_total_dos_titulos_em_carteiras = (float) substr($input, 98, 17);
        $this->trailer_numero_do_aviso_de_lancamento = rtrim(substr($input, 115, 8));
        $this->trailer_uso_exclusivo_febraban_cnab_2 = rtrim(substr($input, 124, 117));
    }

    /**
     * @param string $input
     * @return ILayoutSegmento[]
     * @throws LayoutReaderException
     */
    public function readSegmentos($input) {
        $segmentos = array();

        $linhas = explode($this->_lineFeed, $input);
        unset($linhas[count($linhas) - 1]);

        foreach ($linhas as $segmentoLinha) {
            switch (substr($segmentoLinha, 13, 1)) {
                case 'T':
                    $segmentos[] = $this->readSegmentoT($segmentoLinha . $this->_lineFeed);
                    break;
                case 'U':
                    $segmentos[] = $this->readSegmentoU($segmentoLinha . $this->_lineFeed);
                    break;
                default:
                    throw new LayoutReaderException('Segmento inválido');
            }
        }
        return $segmentos;
    }

    /**
     * @param string $input
     * @return ILayoutSegmentoT
     */
    public function readSegmentoT($input) {
        $segmento = new Layout240SegmentoT;
        $segmento->read($input);
        $this->_segmentos->add($segmento);
        return $segmento;
    }

    /**
     * @param string $input
     * @return ILayoutSegmentoU
     */
    public function readSegmentoU($input) {
        $segmento = new Layout240SegmentoU;
        $segmento->read($input);
        $this->_segmentos->add($segmento);
        return $segmento;
    }

}
