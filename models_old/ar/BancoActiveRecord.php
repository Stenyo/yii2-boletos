<?php

/**
 * This is the model class for table "banco".
 *
 * The followings are the available columns in table 'banco':
 * @property string $codigo
 * @property string $descricao
 *
 * The followings are the available model relations:
 * @property BoletoCedenteActiveRecord[] $boletoCedentes
 * @property RemessaActiveRecord[] $remessas
 * @property RetornoActiveRecord[] $retornos
 */
class BancoActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'banco';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('codigo', 'required'),
            array('codigo', 'length', 'max' => 3),
            array('descricao', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('codigo, descricao', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boletoCedentes' => array(self::HAS_MANY, 'BoletoCedenteActiveRecord', 'banco_codigo'),
            'remessas' => array(self::HAS_MANY, 'RemessaActiveRecord', 'banco_codigo'),
            'retornos' => array(self::HAS_MANY, 'RetornoActiveRecord', 'banco_codigo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'codigo' => 'Codigo',
            'descricao' => 'Descricao',
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

        $criteria->compare('codigo', $this->codigo, true);
        $criteria->compare('descricao', $this->descricao, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BancoActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
