<?php

/**
 * This is the model class for table "boleto_retorno_santander".
 *
 * The followings are the available columns in table 'boleto_retorno_santander':
 * @property integer $boleto_retorno_id
 * @property string $conta_cobranca
 *
 * The followings are the available model relations:
 * @property BoletoRetorno $boletoRetorno
 */
class BoletoRetornoSantanderActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'boleto_retorno_santander';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('boleto_retorno_id, conta_cobranca', 'required'),
            array('boleto_retorno_id', 'numerical', 'integerOnly' => true),
            array('conta_cobranca', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('boleto_retorno_id, conta_cobranca', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boletoRetorno' => array(self::BELONGS_TO, 'BoletoRetornoActiveRecord', 'boleto_retorno_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'boleto_retorno_id' => 'Boleto Retorno',
            'conta_cobranca' => 'Conta Cobranca',
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

        $criteria->compare('boleto_retorno_id', $this->boleto_retorno_id);
        $criteria->compare('conta_cobranca', $this->conta_cobranca, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BoletoRetornoSantanderActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
