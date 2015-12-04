<?php

/**
 * This is the model class for table "boleto_retorno".
 *
 * The followings are the available columns in table 'boleto_retorno':
 * @property integer $id
 * @property integer $retorno_id
 * @property string $boleto_id
 * @property integer $codigo_de_movimento
 * @property string $identificacao_do_titulo
 * @property integer $codigo_da_carteira
 * @property string $numero_do_documento_de_cobranca
 * @property string $data_do_vencimento_do_titulo
 * @property double $valor_nominal_do_titulo
 * @property string $identificacao_do_titulo_na_empresa
 * @property integer $codigo_da_moeda
 * @property integer $numero_do_contrato_da_operacao_de_credito
 * @property double $valor_da_tarifa_custas
 * @property string $identificacao_para_reijeicoes
 * @property string $identificacao_para_tarifas
 * @property string $identificacao_para_custas
 * @property string $identificacao_para_liquidacaoes
 * @property string $identificacao_para_baixas
 * @property double $juros_multa_encargos
 * @property double $valor_do_desconto_concedido
 * @property double $valor_do_abatimento_concedido_cancelado
 * @property double $valor_do_iof_recolhido
 * @property double $valor_pago_pelo_sacado
 * @property double $valor_liquido_a_ser_creditado
 * @property double $valor_de_outras_despesas
 * @property double $valor_de_outros_creditos
 * @property string $data_da_ocorrencia
 * @property string $data_da_efetivacao_do_credito
 * @property string $codigo_da_ocorrencia_do_sacado
 * @property string $data_da_ocorrencia_do_sacado
 * @property double $valor_da_ocorrencia_do_sacado
 * @property string $complemento_da_ocorrencia_do_sacado
 * @property integer $codigo_banco_correspondente_compensacao
 * @property integer $nosso_numero_banco_correspondente
 *
 * The followings are the available model relations:
 * @property BoletoActiveRecord $boleto
 * @property RetornoActiveRecord $retorno
 * @property BoletoRetornoSantanderActiveRecord[] $boletoRetornoSantanders
 */
class BoletoRetornoActiveRecord extends CActiveRecord
{       
        public $nosso_numero;
        
        public $pago;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'boleto_retorno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('retorno_id, boleto_id, codigo_de_movimento', 'required'),
			array('retorno_id, codigo_de_movimento, codigo_da_carteira, codigo_da_moeda, numero_do_contrato_da_operacao_de_credito, codigo_banco_correspondente_compensacao, nosso_numero_banco_correspondente', 'numerical', 'integerOnly'=>true),
			array('valor_nominal_do_titulo, valor_da_tarifa_custas, juros_multa_encargos, valor_do_desconto_concedido, valor_do_abatimento_concedido_cancelado, valor_do_iof_recolhido, valor_pago_pelo_sacado, valor_liquido_a_ser_creditado, valor_de_outras_despesas, valor_de_outros_creditos, valor_da_ocorrencia_do_sacado', 'numerical'),
			array('boleto_id', 'length', 'max'=>11),
			array('identificacao_do_titulo', 'length', 'max'=>20),
			array('numero_do_documento_de_cobranca', 'length', 'max'=>15),
			array('identificacao_do_titulo_na_empresa', 'length', 'max'=>25),
			array('identificacao_para_reijeicoes, identificacao_para_tarifas, identificacao_para_custas, identificacao_para_liquidacaoes, identificacao_para_baixas', 'length', 'max'=>2),
			array('codigo_da_ocorrencia_do_sacado', 'length', 'max'=>4),
			array('complemento_da_ocorrencia_do_sacado', 'length', 'max'=>30),
			array('data_do_vencimento_do_titulo, data_da_ocorrencia, data_da_efetivacao_do_credito, data_da_ocorrencia_do_sacado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, retorno_id, boleto_id, codigo_de_movimento, identificacao_do_titulo, codigo_da_carteira, numero_do_documento_de_cobranca, data_do_vencimento_do_titulo, valor_nominal_do_titulo, identificacao_do_titulo_na_empresa, codigo_da_moeda, numero_do_contrato_da_operacao_de_credito, valor_da_tarifa_custas, identificacao_para_reijeicoes, identificacao_para_tarifas, identificacao_para_custas, identificacao_para_liquidacaoes, identificacao_para_baixas, juros_multa_encargos, valor_do_desconto_concedido, valor_do_abatimento_concedido_cancelado, valor_do_iof_recolhido, valor_pago_pelo_sacado, valor_liquido_a_ser_creditado, valor_de_outras_despesas, valor_de_outros_creditos, data_da_ocorrencia, data_da_efetivacao_do_credito, codigo_da_ocorrencia_do_sacado, data_da_ocorrencia_do_sacado, valor_da_ocorrencia_do_sacado, complemento_da_ocorrencia_do_sacado, codigo_banco_correspondente_compensacao, nosso_numero_banco_correspondente', 'safe', 'on'=>'search'),
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
			'boleto' => array(self::BELONGS_TO, 'BoletoActiveRecord', 'boleto_id'),
			'retorno' => array(self::BELONGS_TO, 'RetornoActiveRecord', 'retorno_id'),
			'boletoRetornoSantanders' => array(self::HAS_MANY, 'BoletoRetornoSantanderActiveRecord', 'boleto_retorno_id'),
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
			'boleto_id' => 'Boleto',
			'codigo_de_movimento' => 'Codigo De Movimento',
			'identificacao_do_titulo' => 'Identificacao Do Titulo',
			'codigo_da_carteira' => 'Codigo Da Carteira',
			'numero_do_documento_de_cobranca' => 'Numero Do Documento De Cobranca',
			'data_do_vencimento_do_titulo' => 'Data Do Vencimento Do Titulo',
			'valor_nominal_do_titulo' => 'Valor Nominal Do Titulo',
			'identificacao_do_titulo_na_empresa' => 'Identificacao Do Titulo Na Empresa',
			'codigo_da_moeda' => 'Codigo Da Moeda',
			'numero_do_contrato_da_operacao_de_credito' => 'Numero Do Contrato Da Operacao De Credito',
			'valor_da_tarifa_custas' => 'Valor Da Tarifa Custas',
			'identificacao_para_reijeicoes' => 'Identificacao Para Reijeicoes',
			'identificacao_para_tarifas' => 'Identificacao Para Tarifas',
			'identificacao_para_custas' => 'Identificacao Para Custas',
			'identificacao_para_liquidacaoes' => 'Identificacao Para Liquidacaoes',
			'identificacao_para_baixas' => 'Identificacao Para Baixas',
			'juros_multa_encargos' => 'Juros Multa Encargos',
			'valor_do_desconto_concedido' => 'Valor Do Desconto Concedido',
			'valor_do_abatimento_concedido_cancelado' => 'Valor Do Abatimento Concedido Cancelado',
			'valor_do_iof_recolhido' => 'Valor Do Iof Recolhido',
			'valor_pago_pelo_sacado' => 'Valor Pago Pelo Sacado',
			'valor_liquido_a_ser_creditado' => 'Valor Liquido A Ser Creditado',
			'valor_de_outras_despesas' => 'Valor De Outras Despesas',
			'valor_de_outros_creditos' => 'Valor De Outros Creditos',
			'data_da_ocorrencia' => 'Data Da Ocorrencia',
			'data_da_efetivacao_do_credito' => 'Data Da Efetivacao Do Credito',
			'codigo_da_ocorrencia_do_sacado' => 'Codigo Da Ocorrencia Do Sacado',
			'data_da_ocorrencia_do_sacado' => 'Data Da Ocorrencia Do Sacado',
			'valor_da_ocorrencia_do_sacado' => 'Valor Da Ocorrencia Do Sacado',
			'complemento_da_ocorrencia_do_sacado' => 'Complemento Da Ocorrencia Do Sacado',
			'codigo_banco_correspondente_compensacao' => 'Codigo Banco Correspondente Compensacao',
			'nosso_numero_banco_correspondente' => 'Nosso Numero Banco Correspondente',
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
		$criteria->compare('boleto_id',$this->boleto_id,true);
		$criteria->compare('codigo_de_movimento',$this->codigo_de_movimento);
		$criteria->compare('identificacao_do_titulo',$this->identificacao_do_titulo,true);
		$criteria->compare('codigo_da_carteira',$this->codigo_da_carteira);
		$criteria->compare('numero_do_documento_de_cobranca',$this->numero_do_documento_de_cobranca,true);
		$criteria->compare('data_do_vencimento_do_titulo',$this->data_do_vencimento_do_titulo,true);
		$criteria->compare('valor_nominal_do_titulo',$this->valor_nominal_do_titulo);
		$criteria->compare('identificacao_do_titulo_na_empresa',$this->identificacao_do_titulo_na_empresa,true);
		$criteria->compare('codigo_da_moeda',$this->codigo_da_moeda);
		$criteria->compare('numero_do_contrato_da_operacao_de_credito',$this->numero_do_contrato_da_operacao_de_credito);
		$criteria->compare('valor_da_tarifa_custas',$this->valor_da_tarifa_custas);
		$criteria->compare('identificacao_para_reijeicoes',$this->identificacao_para_reijeicoes,true);
		$criteria->compare('identificacao_para_tarifas',$this->identificacao_para_tarifas,true);
		$criteria->compare('identificacao_para_custas',$this->identificacao_para_custas,true);
		$criteria->compare('identificacao_para_liquidacaoes',$this->identificacao_para_liquidacaoes,true);
		$criteria->compare('identificacao_para_baixas',$this->identificacao_para_baixas,true);
		$criteria->compare('juros_multa_encargos',$this->juros_multa_encargos);
		$criteria->compare('valor_do_desconto_concedido',$this->valor_do_desconto_concedido);
		$criteria->compare('valor_do_abatimento_concedido_cancelado',$this->valor_do_abatimento_concedido_cancelado);
		$criteria->compare('valor_do_iof_recolhido',$this->valor_do_iof_recolhido);
		$criteria->compare('valor_pago_pelo_sacado',$this->valor_pago_pelo_sacado);
		$criteria->compare('valor_liquido_a_ser_creditado',$this->valor_liquido_a_ser_creditado);
		$criteria->compare('valor_de_outras_despesas',$this->valor_de_outras_despesas);
		$criteria->compare('valor_de_outros_creditos',$this->valor_de_outros_creditos);
		$criteria->compare('data_da_ocorrencia',$this->data_da_ocorrencia,true);
		$criteria->compare('data_da_efetivacao_do_credito',$this->data_da_efetivacao_do_credito,true);
		$criteria->compare('codigo_da_ocorrencia_do_sacado',$this->codigo_da_ocorrencia_do_sacado,true);
		$criteria->compare('data_da_ocorrencia_do_sacado',$this->data_da_ocorrencia_do_sacado,true);
		$criteria->compare('valor_da_ocorrencia_do_sacado',$this->valor_da_ocorrencia_do_sacado);
		$criteria->compare('complemento_da_ocorrencia_do_sacado',$this->complemento_da_ocorrencia_do_sacado,true);
		$criteria->compare('codigo_banco_correspondente_compensacao',$this->codigo_banco_correspondente_compensacao);
		$criteria->compare('nosso_numero_banco_correspondente',$this->nosso_numero_banco_correspondente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoletoRetornoActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
