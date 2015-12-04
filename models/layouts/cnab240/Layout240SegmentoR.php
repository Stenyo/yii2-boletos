<?php

/**
 * @property int $codigo_do_desconto_2
 * @property int $data_do_desconto_2
 * @property int $valor_percentual_a_ser_concedido_1
 * @property int $codigo_do_desconto_3
 * @property int $data_do_desconto_3
 * @property int $valor_percentual_a_ser_concedido_2
 * @property string $codigo_da_multa
 * @property int $data_da_multa
 * @property int $valor_percentual_a_ser_aplicado
 * @property string $informacao_ao_sacado
 * @property string $mensagem_3
 * @property string $mensagem_4
 * @property string $uso_exclusivo_febraban_cnab_1
 * @property int $codigo_ocor_do_sacado
 * @property int $codigo_do_banco_na_conta_do_debito
 * @property int $codigo_da_agencia_do_debito
 * @property string $digito_verificador_da_agencia
 * @property int $conta_corrente_para_debito
 * @property string $digito_verificador_da_conta
 * @property string $digito_verificador_ag_conta
 * @property int $aviso_para_debito_automatico
 * @property string $uso_exclusivo_febraban_cnab_2
 */
class Layout240SegmentoR extends Layout240Segmento implements IRenderable, ILayoutSegmentoR {

    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->tipo_de_registro = Layout240Segmento::TIPO_DE_REGISTRO;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_R;
        $this->uso_exclusivo_febraban_cnab = str_repeat(' ', 1);
        $this->uso_exclusivo_febraban_cnab_1 = str_repeat(' ', 20);
        $this->uso_exclusivo_febraban_cnab_2 = str_repeat(' ', 9);
    }

    function __set($propriedade, $valor) {
        switch ($propriedade) {
            case 'mensagem_3':
                $this->mensagem_3 = strtoupper(substr($valor, 0, 40));
                break;
            case 'mensagem_4':
                $this->mensagem_4 = strtoupper(substr($valor, 0, 40));
                break;
            default :
                $this->$propriedade = $valor;
        }
    }

    public function rules() {
        return parent::rules() + array(
            array('codigo_do_desconto_2,data_do_desconto_2,valor_percentual_a_ser_concedido_1,codigo_do_desconto_3,data_do_desconto_3,valor_percentual_a_ser_concedido_2,codigo_da_multa,data_da_multa,valor_percentual_a_ser_aplicado,informacao_ao_sacado,mensagem_3,mensagem_4,uso_exclusivo_febraban_cnab_2,codigo_ocor_do_sacado,codigo_do_banco_na_conta_do_debito,codigo_da_agencia_do_debito,digito_verificador_da_agencia,conta_corrente_para_debito,digito_verificador_da_conta,digito_verificador_ag_conta,aviso_para_debito_automatico,uso_exclusivo_febraban_cnab_3', 'required'),
            array('codigo_do_desconto_2', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('data_do_desconto_2', 'date', 'format' => 'ddMMyyyy'),
            array('valor_percentual_a_ser_concedido_1', 'numerical', 'min' => 0, 'max' => 999999999999999),
            array('codigo_do_desconto_3', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('data_do_desconto_3', 'date', 'format' => 'ddMMyyyy'),
            array('valor_percentual_a_ser_concedido_2', 'numerical', 'min' => 0, 'max' => 999999999999999),
            array('codigo_da_multa', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('data_da_multa', 'date', 'format' => 'ddMMyyyy'),
            array('valor_percentual_a_ser_aplicado', 'numerical', 'min' => 0, 'max' => 999999999999999),
            array('informacao_ao_sacado', 'length', 'min' => 0, 'max' => 10),
            array('mensagem_3', 'length', 'min' => 0, 'max' => 40),
            array('mensagem_4', 'length', 'min' => 0, 'max' => 40),
            array('uso_exclusivo_febraban_cnab_1', 'length', 'min' => 40, 'max' => 40),
            array('codigo_ocor_do_sacado', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999999),
            array('codigo_do_banco_na_conta_do_debito', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('digito_verificador_da_agencia', 'length', 'min' => 1, 'max' => 1),
            array('conta_corrente_para_debito', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999),
            array('digito_verificador_da_conta', 'length', 'min' => 1, 'max' => 1),
            array('digito_verificador_ag_conta', 'length', 'min' => 1, 'max' => 1),
            array('aviso_para_debito_automatico', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('uso_exclusivo_febraban_cnab_2', 'length', 'min' => 9, 'max' => 9),
        );
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'codigo_do_desconto_2',
            'data_do_desconto_2',
            'valor_percentual_a_ser_concedido_1',
            'codigo_do_desconto_3',
            'data_do_desconto_3',
            'valor_percentual_a_ser_concedido_2',
            'codigo_da_multa',
            'data_da_multa',
            'valor_percentual_a_ser_aplicado',
            'informacao_ao_sacado',
            'mensagem_3',
            'mensagem_4',
            'uso_exclusivo_febraban_cnab_1',
            'codigo_ocor_do_sacado',
            'codigo_do_banco_na_conta_do_debito',
            'codigo_da_agencia_do_debito',
            'digito_verificador_da_agencia',
            'conta_corrente_para_debito',
            'digito_verificador_da_conta',
            'digito_verificador_ag_conta',
            'aviso_para_debito_automatico',
            'uso_exclusivo_febraban_cnab_2',
        ));
    }

    public function render() {
        $out = '';
        $out .= str_pad($this->codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_sequencial_do_registro_no_lote, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_segmento_do_registro_detalhe, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 1, ' ', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_de_movimento, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_do_desconto_2, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->data_do_desconto_2, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_percentual_a_ser_concedido_1, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_do_desconto_3, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->data_do_desconto_3, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_percentual_a_ser_concedido_2, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_da_multa, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->data_da_multa, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_percentual_a_ser_aplicado, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->informacao_ao_sacado, 10, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_3, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_4, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_1, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_ocor_do_sacado, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_do_banco_na_conta_do_debito, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_da_agencia_do_debito, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_agencia, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->conta_corrente_para_debito, 12, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_conta, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->digito_verificador_ag_conta, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->aviso_para_debito_automatico, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_2, 9, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
