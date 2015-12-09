<?php

namespace parallaxsolutions\yii2boletos\models\ar;

use Yii;

/**
 * This is the model class for table "retorno".
 *
 * @property integer $id
 * @property string $banco_codigo
 * @property integer $boleto_cedente_id
 * @property string $nome_arquivo
 * @property string $text
 * @property string $data
 * @property integer $numero_boletos
 * @property integer $layout
 * @property string $hash
 *
 * @property BoletoRetorno[] $boletoRetornos
 * @property Banco $bancoCodigo
 * @property BoletoCedente $boletoCedente
 */
class Retorno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retorno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banco_codigo', 'boleto_cedente_id', 'nome_arquivo', 'text', 'data', 'numero_boletos', 'hash'], 'required'],
            [['id', 'banco_codigo', 'boleto_cedente_id', 'numero_boletos', 'layout'], 'integer'],
            [['text'], 'string'],
            [['data'], 'safe'],
            [['nome_arquivo'], 'string', 'max' => 140],
            [['hash'], 'string', 'max' => 96],
            [['banco_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Banco::className(), 'targetAttribute' => ['banco_codigo' => 'codigo']],
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
            'banco_codigo' => 'Banco Codigo',
            'boleto_cedente_id' => 'Boleto Cedente ID',
            'nome_arquivo' => 'Nome Arquivo',
            'text' => 'Text',
            'data' => 'Data',
            'numero_boletos' => 'Numero Boletos',
            'layout' => 'Layout',
            'hash' => 'Hash',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoRetornos()
    {
        return $this->hasMany(BoletoRetorno::className(), ['retorno_id' => 'id']);
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
    public function getBoletoCedente()
    {
        return $this->hasOne(BoletoCedente::className(), ['id' => 'boleto_cedente_id']);
    }
}
