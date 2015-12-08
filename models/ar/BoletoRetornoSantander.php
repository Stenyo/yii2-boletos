<?php

namespace parallaxsolutions\boletos\models\ar;

use Yii;

/**
 * This is the model class for table "boleto_retorno_santander".
 *
 * @property integer $boleto_retorno_id
 * @property string $conta_cobranca
 *
 * @property BoletoRetorno $boletoRetorno
 */
class BoletoRetornoSantander extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'boleto_retorno_santander';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['boleto_retorno_id', 'conta_cobranca'], 'required'],
            [['boleto_retorno_id'], 'integer'],
            [['conta_cobranca'], 'string', 'max' => 10],
            [['boleto_retorno_id'], 'exist', 'skipOnError' => true, 'targetClass' => BoletoRetorno::className(), 'targetAttribute' => ['boleto_retorno_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'boleto_retorno_id' => 'Boleto Retorno ID',
            'conta_cobranca' => 'Conta Cobranca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoletoRetorno()
    {
        return $this->hasOne(BoletoRetorno::className(), ['id' => 'boleto_retorno_id']);
    }
}
