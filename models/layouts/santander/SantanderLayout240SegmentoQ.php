<?php

class SantanderLayout240SegmentoQ extends Layout240SegmentoQ {

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->codigo_do_banco_na_compensacao  = SantanderConstants::CODIGO_DO_BANCO;
        $this->uso_exclusivo_febraban_cnab_1 = str_repeat(' ', 19);
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'identificador_de_carne',
            'sequencial_da_parcela_ou_numero_inicial_da_parcela',
            'quantidade_total_de_parcelas',
            'numero_do_plano',
        ));
    }

    /**
     * @return string
     */
    public function render() {
        $outParent = parent::render();
        $out = '';
        $out .= substr($outParent, 0, 209);
        $out .= str_pad($this->identificador_de_carne, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->sequencial_da_parcela_ou_numero_inicial_da_parcela, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->quantidade_total_de_parcelas, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_do_plano, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_1, 19, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
