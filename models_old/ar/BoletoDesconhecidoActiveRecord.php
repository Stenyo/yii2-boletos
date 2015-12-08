<?php

/**
 * This is the model class for table "boleto_desconhecido".
 *
 * The followings are the available columns in table 'boleto_desconhecido':
 * @property integer $id
 * @property integer $retorno_id
 * @property integer $nosso_numero
 * @property integer $numero_de_sequencia_segmento_t
 * @property integer $numero_de_sequencia_segmento_u
 *
 * The followings are the available model relations:
 * @property Retorno $retorno
 */
class BoletoDesconhecidoActiveRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'boleto_desconhecido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('retorno_id, nosso_numero, numero_de_sequencia_segmento_t, numero_de_sequencia_segmento_u', 'required'),
			array('retorno_id, nosso_numero, numero_de_sequencia_segmento_t, numero_de_sequencia_segmento_u', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, retorno_id, nosso_numero, numero_de_sequencia_segmento_t, numero_de_sequencia_segmento_u', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'retorno' => array(self::BELONGS_TO, 'Retorno', 'retorno_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'retorno_id' => 'Retorno',
			'nosso_numero' => 'Nosso Numero',
			'numero_de_sequencia_segmento_t' => 'Numero De Sequencia Segmento T',
			'numero_de_sequencia_segmento_u' => 'Numero De Sequencia Segmento U',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('retorno_id',$this->retorno_id);
		$criteria->compare('nosso_numero',$this->nosso_numero);
		$criteria->compare('numero_de_sequencia_segmento_t',$this->numero_de_sequencia_segmento_t);
		$criteria->compare('numero_de_sequencia_segmento_u',$this->numero_de_sequencia_segmento_u);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoletoDesconhecidoActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
