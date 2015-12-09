<?php

namespace parallaxsolutions\yii2boletos\models\ar;

use Yii;

/**
 * This is the model class for table "boleto".
 *
 * @property string $id
 * @property integer $nosso_numero
 * @property integer $boleto_cedente_id
 * @property string $data_documento
 * @property string $numero_documento
 * @property string $especie_de_documento
 * @property integer $codigo_da_moeda
 * @property string $aceite
 * @property string $data_processamento
 * @property integer $codigo_da_carteira
 * @property integer $quantidade
 * @property string $valor_unitario
 * @property string $instrucoes_1
 * @property string $instrucoes_2
 * @property string $instrucoes_3
 * @property string $instrucoes_4
 * @property string $instrucoes_5
 * @property string $data_vencimento
 * @property string $valor_boleto
 * @property string $valor_percentual_a_ser_concedido_do_desconto
 * @property string $valor_do_abatimento
 * @property string $outros_acrescimos
 * @property string $valor_cobrado
 * @property string $sacado_nome
 * @property integer $sacado_tipo_inscricao
 * @property string $sacado_documento
 * @property string $sacado_rua
 * @property string $sacado_numero
 * @property string $sacado_bairro
 * @property string $sacado_cep
 * @property string $sacado_cidade
 * @property string $sacado_uf
 * @property string $sacado_complemento
 * @property string $juros_de_mora_por_dia_taxa
 * @property integer $numero_de_dias_para_baixa_devolucao
 * @property integer $remessa
 *
 * @property BoletoCedente $boletoCedente
 * @property BoletoRetorno[] $boletoRetornos
 * @property PaymentBoleto[] $paymentBoletos
 */
class Boleto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boleto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nosso_numero', 'boleto_cedente_id', 'data_documento', 'numero_documento', 'especie_de_documento', 'codigo_da_moeda', 'aceite', 'data_processamento', 'codigo_da_carteira', 'data_vencimento', 'valor_boleto', 'sacado_nome', 'sacado_tipo_inscricao', 'sacado_documento', 'sacado_rua', 'sacado_numero', 'sacado_bairro', 'sacado_cep', 'sacado_cidade', 'sacado_uf'], 'required'],
            [['nosso_numero', 'boleto_cedente_id', 'codigo_da_moeda', 'codigo_da_carteira', 'quantidade', 'sacado_tipo_inscricao', 'numero_de_dias_para_baixa_devolucao', 'remessa'], 'integer'],
            [['data_documento', 'data_processamento', 'data_vencimento'], 'safe'],
            [['valor_unitario', 'valor_boleto', 'valor_percentual_a_ser_concedido_do_desconto', 'valor_do_abatimento', 'outros_acrescimos', 'valor_cobrado', 'juros_de_mora_por_dia_taxa'], 'number'],
            [['numero_documento', 'sacado_documento'], 'string', 'max' => 15],
            [['especie_de_documento'], 'string', 'max' => 25],
            [['aceite'], 'string', 'max' => 1],
            [['instrucoes_1', 'instrucoes_2', 'instrucoes_3', 'instrucoes_4', 'instrucoes_5', 'sacado_nome', 'sacado_rua', 'sacado_bairro', 'sacado_cidade', 'sacado_complemento'], 'string', 'max' => 80],
            [['sacado_numero'], 'string', 'max' => 20],
            [['sacado_cep'], 'string', 'max' => 8],
            [['sacado_uf'], 'string', 'max' => 2],
            [['boleto_cedente_id'], 'exist', 'skipOnError' => true, 'targetClass' => BoletoCedente::className(), 'targetAttribute' => ['boleto_cedente_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nosso_numero' => 'Nosso Numero',
            'boleto_cedente_id' => 'Boleto Cedente ID',
            'data_documento' => 'Data Documento',
            'numero_documento' => 'Numero Documento',
            'especie_de_documento' => 'Especie De Documento',
            'codigo_da_moeda' => 'Codigo Da Moeda',
            'aceite' => 'Aceite',
            'data_processamento' => 'Data Processamento',
            'codigo_da_carteira' => 'Codigo Da Carteira',
            'quantidade' => 'Quantidade',
            'valor_unitario' => 'Valor Unitario',
            'instrucoes_1' => 'Instrucoes 1',
            'instrucoes_2' => 'Instrucoes 2',
            'instrucoes_3' => 'Instrucoes 3',
            'instrucoes_4' => 'Instrucoes 4',
            'instrucoes_5' => 'Instrucoes 5',
            'data_vencimento' => 'Data Vencimento',
            'valor_boleto' => 'Valor Boleto',
            'valor_percentual_a_ser_concedido_do_desconto' => 'Valor Percentual A Ser Concedido Do Desconto',
            'valor_do_abatimento' => 'Valor Do Abatimento',
            'outros_acrescimos' => 'Outros Acrescimos',
            'valor_cobrado' => 'Valor Cobrado',
            'sacado_nome' => 'Sacado Nome',
            'sacado_tipo_inscricao' => 'Sacado Tipo Inscricao',
            'sacado_documento' => 'Sacado Documento',
            'sacado_rua' => 'Sacado Rua',
            'sacado_numero' => 'Sacado Numero',
            'sacado_bairro' => 'Sacado Bairro',
            'sacado_cep' => 'Sacado Cep',
            'sacado_cidade' => 'Sacado Cidade',
            'sacado_uf' => 'Sacado Uf',
            'sacado_complemento' => 'Sacado Complemento',
            'juros_de_mora_por_dia_taxa' => 'Juros De Mora Por Dia Taxa',
            'numero_de_dias_para_baixa_devolucao' => 'Numero De Dias Para Baixa Devolucao',
            'remessa' => 'Remessa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoCedente()
    {
        return $this->hasOne(BoletoCedente::className(), ['id' => 'boleto_cedente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoRetornos()
    {
        return $this->hasMany(BoletoRetorno::className(), ['boleto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentBoletos()
    {
        return $this->hasMany(PaymentBoleto::className(), ['boleto_id' => 'id']);
    }
}
