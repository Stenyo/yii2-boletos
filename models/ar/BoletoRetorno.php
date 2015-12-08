<?php

namespace parallaxsolutions\boletos\models\ar;

use Yii;

/**
 * This is the model class for table "boleto_retorno".
 *
 * @property integer $id
 * @property integer $retorno_id
 * @property string $boleto_id
 * @property integer $codigo_de_movimento
 * @property string $identificacao_do_titulo
 * @property integer $codigo_da_carteira
 * @property string $numero_do_documento_de_cobranca
 * @property string $data_do_vencimento_do_titulo
 * @property double $valor_nominal_do_titulo
 * @property string $identificacao_do_titulo_na_empresa
 * @property integer $codigo_da_moeda
 * @property integer $numero_do_contrato_da_operacao_de_credito
 * @property double $valor_da_tarifa_custas
 * @property string $identificacao_para_reijeicoes
 * @property string $identificacao_para_tarifas
 * @property string $identificacao_para_custas
 * @property string $identificacao_para_liquidacaoes
 * @property string $identificacao_para_baixas
 * @property double $juros_multa_encargos
 * @property double $valor_do_desconto_concedido
 * @property double $valor_do_abatimento_concedido_cancelado
 * @property double $valor_do_iof_recolhido
 * @property double $valor_pago_pelo_sacado
 * @property double $valor_liquido_a_ser_creditado
 * @property double $valor_de_outras_despesas
 * @property double $valor_de_outros_creditos
 * @property string $data_da_ocorrencia
 * @property string $data_da_efetivacao_do_credito
 * @property string $codigo_da_ocorrencia_do_sacado
 * @property string $data_da_ocorrencia_do_sacado
 * @property double $valor_da_ocorrencia_do_sacado
 * @property string $complemento_da_ocorrencia_do_sacado
 * @property integer $codigo_banco_correspondente_compensacao
 * @property integer $nosso_numero_banco_correspondente
 * @property string $desconhecido
 *
 * @property Boleto $boleto
 * @property Retorno $retorno
 * @property BoletoRetornoSantander[] $boletoRetornoSantanders
 */
class BoletoRetorno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boleto_retorno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['retorno_id', 'codigo_de_movimento'], 'required'],
            [['retorno_id', 'boleto_id', 'codigo_de_movimento', 'codigo_da_carteira', 'codigo_da_moeda', 'numero_do_contrato_da_operacao_de_credito', 'codigo_banco_correspondente_compensacao', 'nosso_numero_banco_correspondente'], 'integer'],
            [['data_do_vencimento_do_titulo', 'data_da_ocorrencia', 'data_da_efetivacao_do_credito', 'data_da_ocorrencia_do_sacado'], 'safe'],
            [['valor_nominal_do_titulo', 'valor_da_tarifa_custas', 'juros_multa_encargos', 'valor_do_desconto_concedido', 'valor_do_abatimento_concedido_cancelado', 'valor_do_iof_recolhido', 'valor_pago_pelo_sacado', 'valor_liquido_a_ser_creditado', 'valor_de_outras_despesas', 'valor_de_outros_creditos', 'valor_da_ocorrencia_do_sacado'], 'number'],
            [['desconhecido'], 'string'],
            [['identificacao_do_titulo'], 'string', 'max' => 20],
            [['numero_do_documento_de_cobranca'], 'string', 'max' => 15],
            [['identificacao_do_titulo_na_empresa'], 'string', 'max' => 25],
            [['identificacao_para_reijeicoes', 'identificacao_para_tarifas', 'identificacao_para_custas', 'identificacao_para_liquidacaoes', 'identificacao_para_baixas'], 'string', 'max' => 2],
            [['codigo_da_ocorrencia_do_sacado'], 'string', 'max' => 4],
            [['complemento_da_ocorrencia_do_sacado'], 'string', 'max' => 30],
            [['boleto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Boleto::className(), 'targetAttribute' => ['boleto_id' => 'id']],
            [['retorno_id'], 'exist', 'skipOnError' => true, 'targetClass' => Retorno::className(), 'targetAttribute' => ['retorno_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'retorno_id' => 'Retorno ID',
            'boleto_id' => 'Boleto ID',
            'codigo_de_movimento' => 'Codigo De Movimento',
            'identificacao_do_titulo' => 'Identificacao Do Titulo',
            'codigo_da_carteira' => 'Codigo Da Carteira',
            'numero_do_documento_de_cobranca' => 'Numero Do Documento De Cobranca',
            'data_do_vencimento_do_titulo' => 'Data Do Vencimento Do Titulo',
            'valor_nominal_do_titulo' => 'Valor Nominal Do Titulo',
            'identificacao_do_titulo_na_empresa' => 'Identificacao Do Titulo Na Empresa',
            'codigo_da_moeda' => 'Codigo Da Moeda',
            'numero_do_contrato_da_operacao_de_credito' => 'Numero Do Contrato Da Operacao De Credito',
            'valor_da_tarifa_custas' => 'Valor Da Tarifa Custas',
            'identificacao_para_reijeicoes' => 'Identificacao Para Reijeicoes',
            'identificacao_para_tarifas' => 'Identificacao Para Tarifas',
            'identificacao_para_custas' => 'Identificacao Para Custas',
            'identificacao_para_liquidacaoes' => 'Identificacao Para Liquidacaoes',
            'identificacao_para_baixas' => 'Identificacao Para Baixas',
            'juros_multa_encargos' => 'Juros Multa Encargos',
            'valor_do_desconto_concedido' => 'Valor Do Desconto Concedido',
            'valor_do_abatimento_concedido_cancelado' => 'Valor Do Abatimento Concedido Cancelado',
            'valor_do_iof_recolhido' => 'Valor Do Iof Recolhido',
            'valor_pago_pelo_sacado' => 'Valor Pago Pelo Sacado',
            'valor_liquido_a_ser_creditado' => 'Valor Liquido A Ser Creditado',
            'valor_de_outras_despesas' => 'Valor De Outras Despesas',
            'valor_de_outros_creditos' => 'Valor De Outros Creditos',
            'data_da_ocorrencia' => 'Data Da Ocorrencia',
            'data_da_efetivacao_do_credito' => 'Data Da Efetivacao Do Credito',
            'codigo_da_ocorrencia_do_sacado' => 'Codigo Da Ocorrencia Do Sacado',
            'data_da_ocorrencia_do_sacado' => 'Data Da Ocorrencia Do Sacado',
            'valor_da_ocorrencia_do_sacado' => 'Valor Da Ocorrencia Do Sacado',
            'complemento_da_ocorrencia_do_sacado' => 'Complemento Da Ocorrencia Do Sacado',
            'codigo_banco_correspondente_compensacao' => 'Codigo Banco Correspondente Compensacao',
            'nosso_numero_banco_correspondente' => 'Nosso Numero Banco Correspondente',
            'desconhecido' => 'Desconhecido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoleto()
    {
        return $this->hasOne(Boleto::className(), ['id' => 'boleto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRetorno()
    {
        return $this->hasOne(Retorno::className(), ['id' => 'retorno_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoRetornoSantanders()
    {
        return $this->hasMany(BoletoRetornoSantander::className(), ['boleto_retorno_id' => 'id']);
    }
}
