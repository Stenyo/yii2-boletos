<?php

/**
 * @property int $juros_multa_encargos
 * @property int $valor_do_desconto_concedido
 * @property int $valor_do_abatimento_concedido_cancelado
 * @property int $valor_do_iof_recolhido
 * @property int $valor_pago_pelo_sacado
 * @property int $valor_liquido_a_ser_creditado
 * @property int $valor_de_outras_despesas
 * @property int $valor_de_outros_creditos
 * @property int $data_da_ocorrencia
 * @property int $data_da_efetivacao_do_credito
 * @property string $codigo_da_ocorrencia_do_sacado
 * @property string $data_da_ocorrencia_do_sacado
 * @property int $valor_da_ocorrencia_do_sacado
 * @property string $complemento_da_ocorrencia_do_sacado
 * @property int $codigo_banco_correspondente_compensacao
 * @property int $nosso_numero_banco_correspondente
 * @property string $uso_exclusivo_febraban_cnab_1
 */
class Layout240SegmentoU extends Layout240Segmento implements ILayoutSegmentoU {

    /**
     * @param string $lineFeed
     */
    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->tipo_de_registro = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_U;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_U;
    }
    
    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'juros_multa_encargos',
            'valor_do_desconto_concedido',
            'valor_do_abatimento_concedido_cancelado',
            'valor_do_iof_recolhido',
            'valor_pago_pelo_sacado',
            'valor_liquido_a_ser_creditado',
            'valor_de_outras_despesas',
            'valor_de_outros_creditos',
            'data_da_ocorrencia',
            'data_da_efetivacao_do_credito',
            'codigo_da_ocorrencia_do_sacado',
            'data_da_ocorrencia_do_sacado',
            'valor_da_ocorrencia_do_sacado',
            'complemento_da_ocorrencia_do_sacado',
            'codigo_banco_correspondente_compensacao',
            'nosso_numero_banco_correspondente',
            'uso_exclusivo_febraban_cnab_1',
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
        $this->juros_multa_encargos = (float) substr($input, 17, 15);
        $this->valor_do_desconto_concedido = (float) substr($input, 32, 15);
        $this->valor_do_abatimento_concedido_cancelado = (float) substr($input, 47, 15);
        $this->valor_do_iof_recolhido = (float) substr($input, 62, 15);
        $this->valor_pago_pelo_sacado = (float) substr($input, 77, 15);
        $this->valor_liquido_a_ser_creditado = (float) substr($input, 92, 15);
        $this->valor_de_outras_despesas = (float) substr($input, 107, 15);
        $this->valor_de_outros_creditos = (float) substr($input, 122, 15);
        $this->data_da_ocorrencia = (float) substr($input, 137, 8);
        $this->data_da_efetivacao_do_credito = (float) substr($input, 145, 8);
        $this->codigo_da_ocorrencia_do_sacado = rtrim(substr($input, 153, 4));
        $this->data_da_ocorrencia_do_sacado = rtrim(substr($input, 157, 8));
        $this->valor_da_ocorrencia_do_sacado = (float) substr($input, 165, 15);
        $this->complemento_da_ocorrencia_do_sacado = rtrim(substr($input, 180, 30));
        $this->codigo_banco_correspondente_compensacao = (float) substr($input, 210, 3);
        $this->nosso_numero_banco_correspondente = (float) substr($input, 213, 20);
        $this->uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 233, 7));
    }

}
