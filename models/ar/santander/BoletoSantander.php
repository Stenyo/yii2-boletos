<?php

/**
 * This is the model class for table "boleto_santander".
 *
 * The followings are the available columns in table 'boleto_santander':
 * @property string $nosso_numero
 * @property string $sacado
 * @property string $endereco
 * @property double $taxa_boleto
 * @property double $valor_cobrado
 * @property double $valor_boleto
 * @property integer $numero_documento
 * @property string $data_vencimento
 * @property string $data_documento
 * @property string $data_processamento
 * @property string $instrucoes
 * @property integer $quantidade
 * @property double $valor_unitario
 * @property string $aceite
 * @property string $especie
 * @property integer $identificacao_beneficiario
 * @property integer $codigo_cliente
 * @property integer $agencia
 * @property integer $carteira
 * @property string $cpf_cnpj_beneficario
 * @property string $beneficiario
 * @property string $desconto
 * @property string $abatimento
 * @property string $mora
 * @property integer $outros_acrescimos
 */
class BoletoSantander extends BoletoActiveRecord {

    const NUM_MOEDA = "9";
    const FIXO = "9";   // Numero fixo para a posicão 05-05
    const IOF = "0";
    const CARTEIRA_SIMPLES_COM_REGISTRO = 101;
    const CARTEIRA_SIMPLES_SEM_REGISTRO = 102;
    const PENHOR_RAPIDA_COM_REGISTRO = 201;

    public $carteira_descricao;
    public $demostrativo;

    public function __construct() {
        parent::__construct();
        $this->aceite = 'N';
        $this->quantidade = '';
        $this->valor_unitario = '';
        $this->demostrativo = '';
        $this->instrucoes_1 = '';
        $this->instrucoes_2 = '';
        $this->instrucoes_3 = '';
        $this->instrucoes_4 = '';
        $this->instrucoes_5 = '';
        $this->valor_percentual_a_ser_concedido_do_desconto = '';
        $this->valor_do_abatimento = '';
        $this->outros_acrescimos = '';
        $this->valor_cobrado = '';
    }

    public static function descricaoCarteira($codigoCarteira = null) {
        $carteiras = [
            self::CARTEIRA_SIMPLES_COM_REGISTRO => "COBRANCA SIMPLES - RCR",
            self::CARTEIRA_SIMPLES_SEM_REGISTRO => "COBRANCA SIMPLES - CSR",
            self::PENHOR_RAPIDA_COM_REGISTRO => "COBRANCA PENHOR - RCR",
        ];
        
        if ($codigoCarteira)
            return $carteiras[$codigoCarteira];
        else
            return $carteiras;
    }

}
