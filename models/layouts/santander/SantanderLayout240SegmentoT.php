<?php

/**
 * @property string $conta_cobranca
 * @property string $uso_exclusivo_fernaban_cnba_2
 */
class SantanderLayout240SegmentoT extends Layout240SegmentoT {

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'conta_cobranca',
            'uso_exclusivo_fernaban_cnba_2',
        ));
    }

    /**
     * @param string $input
     */
    public function read($input) {
        parent::read($input);
        $this->agencia_mantenedora_da_conta = (float) substr($input, 17, 4); // Agência do Beneficiário
        $this->digito_verificador_da_agencia_1 = (float) substr($input, 21, 1); // Digito da Agência do Beneficiário
        $this->numero_da_conta_corrente = (float) substr($input, 22, 9);
        $this->digito_verificador_da_conta = (float) substr($input, 31, 1);
        $this->uso_exclusivo_fernaban_cnba_2 = rtrim(substr($input, 32, 8));
        unset($this->digito_verificador_da_agencia_conta);
        $this->identificacao_do_titulo  = (float) substr($input, 40, 13);
        $this->codigo_da_carteira = (float) substr($input, 53, 1);
        $this->numero_do_documento_de_cobranca = rtrim(substr($input, 54, 15));
        $this->data_do_vencimento_do_titulo = (float) substr($input, 69, 8);
        $this->valor_nominal_do_titulo = (float) substr($input, 77, 15);
        $this->numero_do_banco = (float) substr($input, 92, 3);
        $this->agencia_cobradora_recebedora = (float) substr($input, 95, 4);
        $this->digito_verificador_da_agencia_2 = (float) substr($input, 99, 1);
        $this->identificacao_do_titulo_na_empresa = rtrim(substr($input, 100, 25));
        $this->codigo_da_moeda = (float) substr($input, 125, 2);
        $this->tipo_de_inscricao_do_sacado = (float) substr($input, 127, 1);
        $this->numero_de_inscricao_do_sacado = (float) substr($input, 128, 15);
        $this->nome_do_sacado = rtrim(substr($input, 143, 40));
        $this->conta_cobranca = rtrim(substr($input, 183, 10));
        unset($this->numero_do_contrato_da_operacao_de_credito);
        $this->valor_da_tarifa_custas = (float) substr($input, 193, 15);
        $this->identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas = (float) substr($input, 208, 10);
        $this->uso_exclusivo_fernaban_cnba_1 = rtrim(substr($input, 218, 22));
    }

}
