<?php

/**
 * @property int $agencia_mantenedora_da_conta
 * @property int $digito_verificador_da_agencia_1
 * @property int $numero_da_conta_corrente
 * @property int $digito_verificador_da_conta
 * @property int $digito_verificador_da_agencia_conta
 * @property string $identificacao_do_titulo 
 * @property int $codigo_da_carteira
 * @property string $numero_do_documento_de_cobranca
 * @property int $data_do_vencimento_do_titulo
 * @property int $valor_nominal_do_titulo
 * @property int $numero_do_banco
 * @property int $agencia_cobradora_recebedora
 * @property int $digito_verificador_da_agencia_2
 * @property string $identificacao_do_titulo_na_empresa
 * @property int $codigo_da_moeda
 * @property int $tipo_de_inscricao_do_sacado
 * @property int $numero_de_inscricao_do_sacado
 * @property string $nome_do_sacado
 * @property int $numero_do_contrato_da_operacao_de_credito
 * @property int $valor_da_tarifa_custas
 * @property string $identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas
 * @property string $uso_exclusivo_fernaban_cnba_1
 */
class Layout240SegmentoT extends Layout240Segmento implements ILayoutSegmentoT {

    /**
     * @param string $lineFeed
     */
    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_T;
    }

    public function rules() {
        return parent::rules() + array(
            array('agencia_mantenedora_da_conta,digito_verificador_da_agencia_do_beneficiario,numero_da_conta_corrente,digito_verificador_da_conta,digito_verificador_da_agencia_conta,identificacao_do_titulo ,codigo_da_carteira,numero_do_documento_de_cobranca,data_do_vencimento_do_titulo,valor_nominal_do_titulo,numero_do_banco,agencia_cobradora_recebedora,digito_da_agencia_do_beneficiario,identificacao_do_título_na_empresa,codigo_da_moeda,tipo_de_inscricao_do_sacado,numero_de_inscricao_do_sacado,nome_do_sacado,numero_do_contr._da_operacao_de_credito,valor_da_tarifa_custas,identificacao_para_rejeicoes,_tarifas,_custas,_liquidacoes_e_baixas,uso_exclusivo_fernaban_cnba_2', 'required'),
            array('digito_verificador_da_agencia_1', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('digito_verificador_da_agencia_do_beneficiario', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_da_conta_corrente', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999),
            array('digito_verificador_da_conta', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('digito_verificador_da_agencia_conta', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('identificacao_do_titulo ', 'length', 'min' => 20, 'max' => 20),
            array('codigo_da_carteira', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_do_documento_de_cobranca', 'length', 'min' => 15, 'max' => 15),
            array('data_do_vencimento_do_titulo', 'date', 'format' => 'ddMMyyyy'),
            array('valor_nominal_do_titulo', 'numerical', 'min' => 0, 'max' => 999999999999999),
            array('numero_do_banco', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999999999999),
            array('agencia_cobradora_recebedora', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('digito_verificador_da_agencia_2', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('identificacao_do_titulo_na_empresa', 'length', 'min' => 25, 'max' => 25),
            array('codigo_da_moeda', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('tipo_de_inscricao_do_sacado', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_de_inscricao_do_sacado', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('nome_do_sacado', 'length', 'min' => 40, 'max' => 40),
            array('numero_do_contrato_da_operacao_de_credito', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999999999),
            array('valor_da_tarifa_custas', 'numerical', 'min' => 0, 'max' => 999999999999999),
            array('identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas', 'length', 'min' => 10, 'max' => 10),
            array('uso_exclusivo_fernaban_cnba_1', 'length', 'min' => 17, 'max' => 17),
        );
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'agencia_mantenedora_da_conta',
            'digito_verificador_da_agencia_1',
            'numero_da_conta_corrente',
            'digito_verificador_da_conta',
            'digito_verificador_da_agencia_conta',
            'identificacao_do_titulo',
            'codigo_da_carteira',
            'numero_do_documento_de_cobranca',
            'data_do_vencimento_do_titulo',
            'valor_nominal_do_titulo',
            'numero_do_banco',
            'agencia_cobradora_recebedora',
            'digito_verificador_da_agencia_2',
            'identificacao_do_titulo_na_empresa',
            'codigo_da_moeda',
            'tipo_de_inscricao_do_sacado',
            'numero_de_inscricao_do_sacado',
            'nome_do_sacado',
            'numero_do_contrato_da_operacao_de_credito',
            'valor_da_tarifa_custas',
            'identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas',
            'uso_exclusivo_fernaban_cnba_1',
        ));
    }

    /**
     * @param string $input
     */
    public function read($input) {
        $this->codigo_do_banco_na_compensacao = (float) substr($input, 0, 3);
        $this->lote_de_servico = (float) substr($input, 3, 4);
        $this->tipo_de_registro = (float) substr($input, 7, 1);
        $this->numero_sequencial_do_registro_no_lote = (float) substr($input, 8, 5);
        $this->codigo_segmento_do_registro_detalhe = rtrim(substr($input, 13, 1));
        $this->uso_exclusivo_febraban_cnab = rtrim(substr($input, 14, 1));
        $this->codigo_de_movimento = (float) substr($input, 15, 2);
        $this->agencia_mantenedora_da_conta = (float) substr($input, 17, 5);
        $this->digito_verificador_da_agencia_1 = (float) substr($input, 22, 1);
        $this->numero_da_conta_corrente = (float) substr($input, 23, 12);
        $this->digito_verificador_da_conta = (float) substr($input, 35, 1);
        $this->digito_verificador_da_agencia_conta = (float) substr($input, 36, 1);
        $this->identificacao_do_titulo  = rtrim(substr($input, 37, 20));
        $this->codigo_da_carteira = (float) substr($input, 57, 1);
        $this->numero_do_documento_de_cobranca = rtrim(substr($input, 58, 15));
        $this->data_do_vencimento_do_titulo = (float) substr($input, 73, 8);
        $this->valor_nominal_do_titulo = (float) substr($input, 81, 15);
        $this->numero_do_banco = (float) substr($input, 96, 3);
        $this->agencia_cobradora_recebedora = (float) substr($input, 99, 5);
        $this->digito_verificador_da_agencia_2 = (float) substr($input, 104, 1);
        $this->identificacao_do_titulo_na_empresa = rtrim(substr($input, 105, 25));
        $this->codigo_da_moeda = (float) substr($input, 130, 2);
        $this->tipo_de_inscricao_do_sacado = (float) substr($input, 132, 1);
        $this->numero_de_inscricao_do_sacado = (float) substr($input, 133, 15);
        $this->nome_do_sacado = rtrim(substr($input, 148, 40));
        $this->numero_do_contrato_da_operacao_de_credito = (float) substr($input, 188, 10);
        $this->valor_da_tarifa_custas = (float) substr($input, 198, 15);
        $this->identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas = rtrim(substr($input, 213, 10));
        $this->uso_exclusivo_fernaban_cnba_1 = rtrim(substr($input, 223, 17));
    }

}
