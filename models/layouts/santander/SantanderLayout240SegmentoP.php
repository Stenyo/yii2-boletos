<?php

class SantanderLayout240SegmentoP extends Layout240SegmentoP {

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
        $this->identificacao_de_titulo_aceito_ou_nao_aceito = Layout240SegmentoP::IDENTIFICACAO_DE_TITULO_NAO_ACEITO;
        $this->codigo_da_moeda = SantanderConstants::CODIGO_DA_MOEDA_REAL;
        $this->uso_exclusivo_febraban_cnab_5 = 0;
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'conta_cobranca',
            'digito_verificador_conta_cobranca',
            'uso_exclusivo_febraban_cnab_1',
            'uso_exclusivo_febraban_cnab_2',
            'uso_exclusivo_febraban_cnab_3',
            'uso_exclusivo_febraban_cnab_4',
            'uso_exclusivo_febraban_cnab_5',
            'uso_exclusivo_febraban_cnab_6',
        ));
    }

    /**
     * @return string
     */
    public function render() {
        $outParent = parent::render();
        $out = '';
        $out .= substr($outParent, 0, 17);
        $out .= str_pad($this->agencia_mantenedora_da_conta, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_agencia_1, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_da_conta_corrente, 9, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_conta, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->conta_cobranca, 9, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_conta_cobranca, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_1, 2, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->identificacao_do_titulo_no_banco, 13, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_da_carteira, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->forma_de_cadastramento_do_titulo_no_banco, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_documento, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_2, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_3, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->numero_do_doucumento_de_cobranca, 15, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->data_de_vencimento_do_titulo, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->valor_nominal_do_titulo, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->agencia_encarregada_da_cobranca, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->digito_verificador_da_agencia_2, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_4, 1, ' ', STR_PAD_RIGHT);
        $out .= substr($outParent, 106, 118);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_5, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->numero_de_dias_para_baixa_devolucao, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_da_moeda, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_6, 11, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
