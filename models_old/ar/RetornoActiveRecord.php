<?php

/**
 * This is the model class for table "retorno".
 *
 * The followings are the available columns in table 'retorno':
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
 * The followings are the available model relations:
 * @property BoletoDesconhecidoActiveRecord[] $boletoDesconhecidos
 * @property BoletoRetornoActiveRecord[] $boletoRetornos
 * @property BancoActiveRecord $bancoCodigo
 * @property BoletoCedenteActiveRecord $boletoCedente
 * @property TipoServicoActiveRecord[] $tipoServicos
 */
class RetornoActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'retorno';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('banco_codigo, boleto_cedente_id, nome_arquivo, text, data, numero_boletos, hash', 'required'),
            array('boleto_cedente_id, numero_boletos, layout', 'numerical', 'integerOnly' => true),
            array('banco_codigo', 'length', 'max' => 3),
            array('nome_arquivo', 'length', 'max' => 140),
            array('hash', 'length', 'max' => 96),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, banco_codigo, boleto_cedente_id, nome_arquivo, text, data, numero_boletos, layout, hash', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boletoDesconhecidos' => array(self::HAS_MANY, 'BoletoDesconhecidoActiveRecord', 'retorno_id'),
            'boletoRetornos' => array(self::HAS_MANY, 'BoletoRetornoActiveRecord', 'retorno_id'),
            'banco' => array(self::BELONGS_TO, 'BancoActiveRecord', 'banco_codigo'),
            'boletoCedente' => array(self::BELONGS_TO, 'BoletoCedenteActiveRecord', 'boleto_cedente_id'),
            'tipoServicos' => array(self::MANY_MANY, 'TipoServicoActiveRecord', 'retorno_tipo_servico(retorno_id, tipo_servico_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'banco_codigo' => 'Código do Banco',
            'boleto_cedente_id' => 'Boleto Cedente',
            'nome_arquivo' => 'Nome do Arquivo',
            'text' => 'Texto',
            'data' => 'Data',
            'numero_boletos' => 'Número do Boletos',
            'layout' => 'Layout',
            'hash' => 'Hash',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('banco_codigo', $this->banco_codigo, true);
        $criteria->compare('boleto_cedente_id', $this->boleto_cedente_id);
        $criteria->compare('nome_arquivo', $this->nome_arquivo, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('numero_boletos', $this->numero_boletos);
        $criteria->compare('layout', $this->layout);
        $criteria->compare('hash', $this->hash, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'data DESC',
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RetornoActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
