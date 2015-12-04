<?php

class SantanderLayout240SegmentoR extends Layout240SegmentoR {

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;    
        $this->uso_exclusivo_febraban_cnab_1 = str_repeat(' ', 61);
        $this->uso_exclusivo_febraban_cnab_3 = str_repeat(' ', 24);
        $this->uso_exclusivo_febraban_cnab_4 = str_repeat(' ', 10);
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'uso_exclusivo_febraban_cnab_3',
            'uso_exclusivo_febraban_cnab_4',
        ));
    }

    /**
     * @return string
     */
    public function render() {
        $outParent = parent::render();
        $out = '';
        $out .= substr($outParent, 0, 41);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_3, 24, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_da_multa, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->data_da_multa, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_percentual_a_ser_aplicado, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_4, 10, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_3, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_4, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_1, 61, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
