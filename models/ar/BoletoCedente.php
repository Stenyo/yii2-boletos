<?php

namespace parallaxsolutions\yii2boletos\models\ar;

use Yii;

/**
 * This is the model class for table "boleto_cedente".
 *
 * @property integer $id
 * @property string $banco_codigo
 * @property string $nome
 * @property string $nome_impressao
 * @property string $numero_sequencia_arquivo
 * @property string $documento
 * @property integer $tipo_documento
 * @property string $agencia
 * @property integer $digito_verificador_agencia
 * @property integer $numero_conta_corrente
 * @property integer $digito_verificador_conta
 * @property integer $identificacao_beneficiario
 * @property integer $nosso_numero_atual
 *
 * @property Boleto[] $boletos
 * @property Banco $bancoCodigo
 * @property Retorno[] $retornos
 */
class BoletoCedente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boleto_cedente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_codigo', 'nome', 'nome_impressao', 'numero_sequencia_arquivo', 'documento', 'tipo_documento', 'agencia', 'digito_verificador_agencia', 'numero_conta_corrente', 'digito_verificador_conta', 'identificacao_beneficiario', 'nosso_numero_atual'], 'required'],
            [['banco_codigo', 'tipo_documento', 'digito_verificador_agencia', 'numero_conta_corrente', 'digito_verificador_conta', 'identificacao_beneficiario', 'nosso_numero_atual'], 'integer'],
            [['nome', 'numero_sequencia_arquivo'], 'string', 'max' => 100],
            [['nome_impressao'], 'string', 'max' => 200],
            [['documento'], 'string', 'max' => 15],
            [['agencia'], 'string', 'max' => 5],
            [['banco_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Banco::className(), 'targetAttribute' => ['banco_codigo' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banco_codigo' => 'Banco Codigo',
            'nome' => 'Nome',
            'nome_impressao' => 'Nome Impressao',
            'numero_sequencia_arquivo' => 'Numero Sequencia Arquivo',
            'documento' => 'Documento',
            'tipo_documento' => 'Tipo Documento',
            'agencia' => 'Agencia',
            'digito_verificador_agencia' => 'Digito Verificador Agencia',
            'numero_conta_corrente' => 'Numero Conta Corrente',
            'digito_verificador_conta' => 'Digito Verificador Conta',
            'identificacao_beneficiario' => 'Identificacao Beneficiario',
            'nosso_numero_atual' => 'Nosso Numero Atual',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletos()
    {
        return $this->hasMany(Boleto::className(), ['boleto_cedente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancoCodigo()
    {
        return $this->hasOne(Banco::className(), ['codigo' => 'banco_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRetornos()
    {
        return $this->hasMany(Retorno::className(), ['boleto_cedente_id' => 'id']);
    }
}
