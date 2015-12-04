<?php

/**
 * @property int $agencia_mantenedora_da_conta
 * @property string $digito_verificador_da_agencia_1
 * @property int $numero_da_conta_corrente
 * @property string $digito_verificador_da_conta
 * @property string $digito_verificador_da_agencia_conta
 * @property string identificacao_de_titulo_aceito_ou_nao_aceito
 * @property int $codigo_da_carteira
 * @property int $forma_de_cadastramento_do_titulo_no_banco
 * @property string $tipo_de_documento
 * @property int $identificacao_da_emissao_do_bloqueto
 * @property string $identificacao_da_distribuicao
 * @property string $numero_do_doucumento_de_cobranca
 * @property int $data_de_vencimento_do_titulo
 * @property int $valor_nominal_do_titulo
 * @property int $agencia_encarregada_da_cobranca
 * @property string $digito_verificador_da_agencia_2
 * @property int $especie_do_titulo
 * @property string identificacao_do_titulo_no_banco
 * @property int $data_da_emissao_do_titulo
 * @property int $codigo_do_juros_de_mora
 * @property int $data_do_juros_de_mora
 * @property int $juros_de_mora_por_dia_taxa
 * @property int $codigo_do_desconto_1
 * @property int $data_do_desconto_1
 * @property int $valor_percentual_a_ser_concedido
 * @property int $valor_do_iof_a_ser_recolhido
 * @property int $valor_do_abatimento
 * @property string $identificacao_do_titulo_na_empresa
 * @property int $codigo_para_protesto
 * @property int $numero_de_dias_para_protesto
 * @property int $codigo_para_baixa_devolucao
 * @property string $numero_de_dias_para_baixa_devolucao
 * @property int $codigo_da_moeda
 * @property int $numero_do_contrato_da_operacao_de_credito
 * @property string $uso_livre_banco_empresa_ou_autorizacao_de_pagamento_parcial
 */
class Layout240SegmentoP extends Layout240Segmento implements IRenderable, ILayoutSegmentoP {

    const IDENTIFICACAO_DE_TITULO_ACEITO = 'A';
    const IDENTIFICACAO_DE_TITULO_NAO_ACEITO = 'N';

    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->tipo_de_registro = Layout240Segmento::TIPO_DE_REGISTRO;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_P;
        $this->uso_exclusivo_febraban_cnab = str_repeat(' ', 1);
    }

    public function rules() {
        return array(
            array('agencia_mantenedora_da_conta', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('digito_verificador_da_agencia_1', 'length', 'max' => 1),
            array('numero_da_conta_corrente', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999),
            array('digito_verificador_da_conta', 'length', 'max' => 1),
            array('digito_verificador_da_ag_conta', 'length', 'max' => 1),
            array('identificacao_do_titulo_no_banco', 'length', 'min' => 20, 'max' => 20),
            array('codigo_da_carteira', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('forma_de_cadastamento_do_titulo_no_banco', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('tipo_de_documento', 'length', 'max' => 1),
            array('identificacao_da_emissao_do_bloqueto', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('identificacao_da_distribuicao', 'length', 'max' => 1),
            array('numero_do_doucumento_de_cobranca', 'length', 'max' => 15),
            array('data_de_vencimento_do_titulo', 'date', 'format' => 'ddMMyyyy'),
            array('valor_nominal_do_titulo', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('agencia_encarregada_da_cobranca', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('digito_verificador_da_agencia_2', 'length', 'max' => 1),
            array('especie_do_titulo', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('identificacao_de_titulo_aceito_ou_nao_aceito', 'length', 'max' => 1),
            array('data_de_vencimento_do_titulo', 'date', 'format' => 'ddMMyyyy'),
            array('codigo_do_juros_de_mora', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('juros_de_mora_por_dia_taxa', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('codigo_do_desconto_1', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('data_do_desconto_1', 'date', 'format' => 'ddMMyyyy'),
            array('valor_percentual_a_ser_concedido', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('valor_do_iof_a_ser_recolhido', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('valor_do_abatimento', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('identificacao_do_titulo_na_empresa', 'length', 'max' => 25),
            array('codigo_para_protesto', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_de_dias_para_protesto', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('codigo_para_baixa_devolucao', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_de_dias_para_baixa_devolucao', 'length', 'max' => 3),
            array('codigo_da_moeda', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('numero_do_contrato_da_operacao_de_credito', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9999999999),
            array('uso_livre_banco_empresa_ou_autorizacao_de_pagamento_parcial', 'length', 'max' => 1),
        );
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'agencia_mantenedora_da_conta',
            'digito_verificador_da_agencia_1',
            'numero_da_conta_corrente',
            'digito_verificador_da_conta',
            'digito_verificador_da_agencia_conta',
            'identificacao_do_titulo_no_banco',
            'codigo_da_carteira',
            'forma_de_cadastramento_do_titulo_no_banco',
            'tipo_de_documento',
            'identificacao_da_emissao_do_bloqueto',
            'identificacao_da_distribuicao',
            'numero_do_doucumento_de_cobranca',
            'data_de_vencimento_do_titulo',
            'valor_nominal_do_titulo',
            'agencia_encarregada_da_cobranca',
            'digito_verificador_da_agencia_2',
            'especie_do_titulo',
            'identificacao_de_titulo_aceito_ou_nao_aceito',
            'data_da_emissao_do_titulo',
            'codigo_do_juros_de_mora',
            'data_do_juros_de_mora',
            'juros_de_mora_por_dia_taxa',
            'codigo_do_desconto_1',
            'data_do_desconto_1',
            'valor_ou_percentual_a_ser_concedido',
            'valor_do_iof_a_ser_recolhido',
            'valor_do_abatimento',
            'identificacao_do_titulo_na_empresa',
            'codigo_para_protesto',
            'numero_de_dias_para_protesto',
            'codigo_para_baixa_devolucao',
            'numero_de_dias_para_baixa_devolucao',
            'codigo_da_moeda',
            'numero_do_contrato_da_operacao_de_credito',
            'uso_livre_banco_empresa_ou_autorizacao_de_pagamento_parcial',
        ));
    }

    /**
     * @return string
     */
    public function render() {
        $out = '';
        $out .= str_pad($this->codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_sequencial_do_registro_no_lote, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_segmento_do_registro_detalhe, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_de_movimento, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->agencia_mantenedora_da_conta, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_agencia_1, 1, '0', STR_PAD_RIGHT);
        $out .= str_pad($this->numero_da_conta_corrente, 12, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_conta, 1, '0', STR_PAD_RIGHT);
        $out .= str_pad($this->digito_verificador_da_agencia_conta, 1, '0', STR_PAD_RIGHT);
        $out .= str_pad($this->identificacao_do_titulo_no_banco, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_da_carteira, 1, '0', STR_PAD_RIGHT);
        $out .= str_pad($this->forma_de_cadastramento_do_titulo_no_banco, 1, '0', STR_PAD_RIGHT);
        $out .= str_pad($this->tipo_de_documento, 1, ' ', STR_PAD_LEFT);
        $out .= str_pad($this->identificacao_da_emissao_do_bloqueto, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->identificacao_da_distribuicao, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->numero_do_doucumento_de_cobranca, 15, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->data_de_vencimento_do_titulo, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_nominal_do_titulo, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->agencia_encarregada_da_cobranca, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_agencia_2, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->especie_do_titulo, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->identificacao_de_titulo_aceito_ou_nao_aceito, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->data_da_emissao_do_titulo, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_do_juros_de_mora, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->data_do_juros_de_mora, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->juros_de_mora_por_dia_taxa, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_do_desconto_1, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->data_do_desconto_1, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_ou_percentual_a_ser_concedido, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_do_iof_a_ser_recolhido, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_do_abatimento, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->identificacao_do_titulo_na_empresa, 25, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_para_protesto, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_de_dias_para_protesto, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_para_baixa_devolucao, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_de_dias_para_baixa_devolucao, 3, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_da_moeda, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_do_contrato_da_operacao_de_credito, 10, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_livre_banco_empresa_ou_autorizacao_de_pagamento_parcial, 1, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
