<?php

/**
 * This is the model class for table "boleto_remessa".
 *
 * The followings are the available columns in table 'boleto_remessa':
 * @property integer $id
 * @property integer $remessa_id
 * @property string $boleto_id
 * @property string $data_do_vencimento_do_titulo
 * @property string $valor_nominal_do_titulo
 * @property integer $codigo_do_juros_de_mora
 * @property string $data_do_juros_de_mora
 * @property string $juros_de_mora_por_dia_taxa
 * @property string $identificacao_do_titulo_na_empresa
 * @property integer $codigo_para_baixa_devolucao
 * @property string $numero_de_dias_para_baixa_devolucao
 * @property integer $codigo_movimento
 *
 * The followings are the available model relations:
 * @property BoletoActiveRecord $boleto
 * @property RemessaActiveRecord $remessa
 */
class BoletoRemessaActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'boleto_remessa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('remessa_id, boleto_id', 'required'),
            array('remessa_id, codigo_do_juros_de_mora, codigo_para_baixa_devolucao, codigo_movimento', 'numerical', 'integerOnly' => true),
            array('boleto_id', 'length', 'max' => 11),
            array('valor_nominal_do_titulo, juros_de_mora_por_dia_taxa', 'length', 'max' => 13),
            array('identificacao_do_titulo_na_empresa', 'length', 'max' => 25),
            array('numero_de_dias_para_baixa_devolucao', 'length', 'max' => 3),
            array('data_do_vencimento_do_titulo, data_do_juros_de_mora', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, remessa_id, boleto_id, data_do_vencimento_do_titulo, valor_nominal_do_titulo, codigo_do_juros_de_mora, data_do_juros_de_mora, juros_de_mora_por_dia_taxa, identificacao_do_titulo_na_empresa, codigo_para_baixa_devolucao, numero_de_dias_para_baixa_devolucao', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boleto' => array(self::BELONGS_TO, 'BoletoActiveRecord', 'boleto_id'),
            'remessa' => array(self::BELONGS_TO, 'RemessaActiveRecord', 'remessa_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'remessa_id' => 'Remessa',
            'boleto_id' => 'Boleto',
            'data_do_vencimento_do_titulo' => 'Data Do Vencimento Do Titulo',
            'valor_nominal_do_titulo' => 'Valor Nominal Do Titulo',
            'codigo_do_juros_de_mora' => 'Codigo Do Juros De Mora',
            'data_do_juros_de_mora' => 'Data Do Juros De Mora',
            'juros_de_mora_por_dia_taxa' => 'Juros De Mora Por Dia Taxa',
            'identificacao_do_titulo_na_empresa' => 'Identificacao Do Titulo Na Empresa',
            'codigo_para_baixa_devolucao' => 'Codigo Para Baixa Devolucao',
            'numero_de_dias_para_baixa_devolucao' => 'Numero De Dias Para Baixa Devolucao',
            'codigo_movimento' => 'Codigo Movimento'
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
        $criteria->compare('remessa_id', $this->remessa_id);
        $criteria->compare('boleto_id', $this->boleto_id, true);
        $criteria->compare('data_do_vencimento_do_titulo', $this->data_do_vencimento_do_titulo, true);
        $criteria->compare('valor_nominal_do_titulo', $this->valor_nominal_do_titulo, true);
        $criteria->compare('codigo_do_juros_de_mora', $this->codigo_do_juros_de_mora);
        $criteria->compare('data_do_juros_de_mora', $this->data_do_juros_de_mora, true);
        $criteria->compare('juros_de_mora_por_dia_taxa', $this->juros_de_mora_por_dia_taxa, true);
        $criteria->compare('identificacao_do_titulo_na_empresa', $this->identificacao_do_titulo_na_empresa, true);
        $criteria->compare('codigo_para_baixa_devolucao', $this->codigo_para_baixa_devolucao);
        $criteria->compare('numero_de_dias_para_baixa_devolucao', $this->numero_de_dias_para_baixa_devolucao, true);
        $criteria->compare('codigo_movimento', $this->codigo_movimento, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BoletoRemessaActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
