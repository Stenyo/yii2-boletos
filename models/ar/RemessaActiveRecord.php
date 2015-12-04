<?php

/**
 * This is the model class for table "remessa".
 *
 * The followings are the available columns in table 'remessa':
 * @property integer $id
 * @property string $banco_codigo
 * @property integer $boleto_cedente_id
 * @property string $text
 * @property string $data
 * @property integer $enviado
 * @property integer $layout
 *
 * The followings are the available model relations:
 * @property BoletoRemessaActiveRecord[] $boletoRemessas
 * @property TipoServicoActiveRecord[] $tipoServicos
 * @property BancoActiveRecord $bancoCodigo
 * @property BoletoCedenteActiveRecord $boletoCedente
 */
class RemessaActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'remessa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('banco_codigo, boleto_cedente_id, data', 'required'),
            array('boleto_cedente_id, enviado, layout', 'numerical', 'integerOnly' => true),
            array('banco_codigo', 'length', 'max' => 3),
            array('text', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, banco_codigo, boleto_cedente_id, text, data, enviado, layout', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boletoRemessas' => array(self::HAS_MANY, 'BoletoRemessa', 'remessa_id'),
            'tipoServicos' => array(self::MANY_MANY, 'TipoServico', 'remesa_tipo_servico(remessa_id, tipo_servico_id)'),
            'bancoCodigo' => array(self::BELONGS_TO, 'Banco', 'banco_codigo'),
            'boletoCedente' => array(self::BELONGS_TO, 'BoletoCedente', 'boleto_cedente_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'banco_codigo' => 'Banco Codigo',
            'boleto_cedente_id' => 'Boleto Cedente',
            'text' => 'Text',
            'data' => 'Data',
            'enviado' => 'Enviado',
            'layout' => 'Layout',
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
        $criteria->compare('text', $this->text, true);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('enviado', $this->enviado);
        $criteria->compare('layout', $this->layout);

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
     * @return RemessaActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
