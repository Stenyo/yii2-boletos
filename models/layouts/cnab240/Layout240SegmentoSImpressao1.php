<?php

/**
 * @todo
 * 
 * @property string $identificacao_da_impressao
 * @property string $numero_da_linha_a_ser_impressa
 * @property string $mensagem_a_ser_impressa
 * @property string $tipo_do_caracter_a_ser_impresso
 * @property string $uso_exclusivo_febraban_cnab
 */
class Layout240SegmentoSImpressao1 extends BaseModel implements IRenderable {

    public function __construct() {
        $this->uso_exclusivo_febraban_cnab = str_repeat(' ', 78);
    }

    public function rules() {
        return array(
            array('identificacao_da_impressao,numero_da_linha_a_ser_impressa,mensagem_a_ser_impressa,tipo_do_caracter_a_ser_impresso,uso_exclusivo_febraban_cnab','required'),
            array('identificacao_da_impressao', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_da_linha_a_ser_impressa', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('mensagem_a_ser_impressa', 'length', 'max' => 140),
            array('tipo_do_caracter_a_ser_impresso', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99),
            array('uso_exclusivo_febraban_cnab', 'length', 'max' => 140),
        );
    }

    public function attributeNames() {
        return array(
            'identificacao_da_impressao',
            'numero_da_linha_a_ser_impressa',
            'mensagem_a_ser_impressa',
            'tipo_do_caracter_a_ser_impresso',
            'uso_exclusivo_febraban_cnab',
        );
    }

    public function render() {
        $out = '';
        $out .= str_pad($this->identificacao_da_impressao, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_da_linha_a_ser_impressa, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->mensagem_a_ser_impressa, 140, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->tipo_do_caracter_a_ser_impresso, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 78, ' ', STR_PAD_RIGHT);
        return $out;
    }

}
