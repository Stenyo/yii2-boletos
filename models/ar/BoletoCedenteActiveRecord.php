<?php

/**
 * This is the model class for table "boleto_cedente".
 *
 * The followings are the available columns in table 'boleto_cedente':
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
 * @property string $nosso_numero_atual
 *
 * The followings are the available model relations:
 * @property Boleto[] $boletos
 * @property Banco $bancoCodigo
 * @property Remessa[] $remessas
 * @property Retorno[] $retornos
 */
class BoletoCedenteActiveRecord extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'boleto_cedente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('banco_codigo, nome, nome_impressao, numero_sequencia_arquivo, documento, tipo_documento, agencia, digito_verificador_agencia, numero_conta_corrente, digito_verificador_conta, identificacao_beneficiario, nosso_numero_atual', 'required'),
			array('tipo_documento, digito_verificador_agencia, numero_conta_corrente, digito_verificador_conta, identificacao_beneficiario', 'numerical', 'integerOnly'=>true),
			array('banco_codigo', 'length', 'max'=>3),
			array('nome, numero_sequencia_arquivo', 'length', 'max'=>100),
			array('nome_impressao', 'length', 'max'=>200),
			array('documento', 'length', 'max'=>15),
			array('agencia', 'length', 'max'=>5),
			array('nosso_numero_atual', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, banco_codigo, nome, nome_impressao, numero_sequencia_arquivo, documento, tipo_documento, agencia, digito_verificador_agencia, numero_conta_corrente, digito_verificador_conta, identificacao_beneficiario, nosso_numero_atual', 'safe', 'on'=>'search'),
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
			'boletos' => array(self::HAS_MANY, 'Boleto', 'boleto_cedente_id'),
			'bancoCodigo' => array(self::BELONGS_TO, 'Banco', 'banco_codigo'),
			'remessas' => array(self::HAS_MANY, 'Remessa', 'boleto_cedente_id'),
			'retornos' => array(self::HAS_MANY, 'Retorno', 'boleto_cedente_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
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
		$criteria->compare('banco_codigo',$this->banco_codigo,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('nome_impressao',$this->nome_impressao,true);
		$criteria->compare('numero_sequencia_arquivo',$this->numero_sequencia_arquivo,true);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('tipo_documento',$this->tipo_documento);
		$criteria->compare('agencia',$this->agencia,true);
		$criteria->compare('digito_verificador_agencia',$this->digito_verificador_agencia);
		$criteria->compare('numero_conta_corrente',$this->numero_conta_corrente);
		$criteria->compare('digito_verificador_conta',$this->digito_verificador_conta);
		$criteria->compare('identificacao_beneficiario',$this->identificacao_beneficiario);
		$criteria->compare('nosso_numero_atual',$this->nosso_numero_atual,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoletoCedenteActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
