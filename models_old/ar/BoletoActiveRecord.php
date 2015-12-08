<?php

/**
 * This is the model class for table "boleto".
 *
 * The followings are the available columns in table 'boleto':
 * @property string $id
 * @property integer $nosso_numero
 * @property integer $boleto_cedente_id
 * @property string $data_documento
 * @property string $numero_documento
 * @property string $especie_de_documento
 * @property integer $codigo_da_moeda
 * @property string $aceite
 * @property string $data_processamento
 * @property integer $codigo_da_carteira
 * @property integer $quantidade
 * @property double $valor_unitario
 * @property string $instrucoes_1
 * @property string $instrucoes_2
 * @property string $instrucoes_3
 * @property string $instrucoes_4
 * @property string $instrucoes_5
 * @property string $data_vencimento
 * @property double $valor_boleto
 * @property double $valor_percentual_a_ser_concedido_do_desconto
 * @property double $valor_do_abatimento
 * @property double $outros_acrescimos
 * @property double $valor_cobrado
 * @property string $sacado_nome
 * @property integer $sacado_tipo_inscricao
 * @property string $sacado_documento
 * @property string $sacado_rua
 * @property string $sacado_numero
 * @property string $sacado_bairro
 * @property string $sacado_cep
 * @property string $sacado_cidade
 * @property string $sacado_uf
 * @property string $sacado_complemento
 * @property string $juros_de_mora_por_dia_taxa
 * @property integer $numero_de_dias_para_baixa_devolucao
 * @property integer $remessa
 *
 * The followings are the available model relations:
 * @property BoletoCedente $boletoCedente
 * @property BoletoAntigoPago[] $boletoAntigoPagos
 * @property BoletoRemessa[] $boletoRemessas
 * @property BoletoRetorno[] $boletoRetornos
 */
class BoletoActiveRecord extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'boleto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nosso_numero, boleto_cedente_id, data_documento, numero_documento, especie_de_documento, codigo_da_moeda, aceite, data_processamento, codigo_da_carteira, data_vencimento, valor_boleto, sacado_nome, sacado_tipo_inscricao, sacado_documento, sacado_rua, sacado_numero, sacado_bairro, sacado_cep, sacado_cidade, sacado_uf', 'required'),
            array('nosso_numero, boleto_cedente_id, codigo_da_moeda, codigo_da_carteira, quantidade, sacado_tipo_inscricao, numero_de_dias_para_baixa_devolucao, remessa', 'numerical', 'integerOnly' => true),
            array('valor_unitario, valor_boleto, valor_percentual_a_ser_concedido_do_desconto, valor_do_abatimento, outros_acrescimos, valor_cobrado', 'numerical'),
            array('numero_documento, sacado_documento', 'length', 'max' => 15),
            array('especie_de_documento', 'length', 'max' => 25),
            array('aceite', 'length', 'max' => 1),
            array('instrucoes_1, instrucoes_2, instrucoes_3, instrucoes_4, instrucoes_5, sacado_nome, sacado_rua, sacado_bairro, sacado_cidade, sacado_complemento', 'length', 'max' => 80),
            array('sacado_numero', 'length', 'max' => 20),
            array('sacado_cep', 'length', 'max' => 8),
            array('sacado_uf', 'length', 'max' => 2),
            array('juros_de_mora_por_dia_taxa', 'length', 'max' => 13),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nosso_numero, boleto_cedente_id, data_documento, numero_documento, especie_de_documento, codigo_da_moeda, aceite, data_processamento, codigo_da_carteira, quantidade, valor_unitario, instrucoes_1, instrucoes_2, instrucoes_3, instrucoes_4, instrucoes_5, data_vencimento, valor_boleto, valor_percentual_a_ser_concedido_do_desconto, valor_do_abatimento, outros_acrescimos, valor_cobrado, sacado_nome, sacado_tipo_inscricao, sacado_documento, sacado_rua, sacado_numero, sacado_bairro, sacado_cep, sacado_cidade, sacado_uf, sacado_complemento, juros_de_mora_por_dia_taxa, numero_de_dias_para_baixa_devolucao, remessa', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'boletoCedente' => array(self::BELONGS_TO, 'BoletoCedenteActiveRecord', 'boleto_cedente_id'),
            'boletoRemessas' => array(self::HAS_MANY, 'BoletoRemessaActiveRecord', 'boleto_id'),
            'boletoRetornos' => array(self::HAS_MANY, 'BoletoRetornoActiveRecord', 'boleto_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nosso_numero' => 'Nosso Número',
            'boleto_cedente_id' => 'Boleto Cedente',
            'data_documento' => 'Data Documento',
            'numero_documento' => 'Numero Documento',
            'especie_de_documento' => 'Especie De Documento',
            'codigo_da_moeda' => 'Codigo Da Moeda',
            'aceite' => 'Aceite',
            'data_processamento' => 'Data Processamento',
            'codigo_da_carteira' => 'Codigo Da Carteira',
            'quantidade' => 'Quantidade',
            'valor_unitario' => 'Valor Unitario',
            'instrucoes_1' => 'Instrucoes 1',
            'instrucoes_2' => 'Instrucoes 2',
            'instrucoes_3' => 'Instrucoes 3',
            'instrucoes_4' => 'Instrucoes 4',
            'instrucoes_5' => 'Instrucoes 5',
            'data_vencimento' => 'Data Vencimento',
            'valor_boleto' => 'Valor Boleto',
            'valor_percentual_a_ser_concedido_do_desconto' => 'Valor Percentual A Ser Concedido Do Desconto',
            'valor_do_abatimento' => 'Valor Do Abatimento',
            'outros_acrescimos' => 'Outros Acrescimos',
            'valor_cobrado' => 'Valor Cobrado',
            'sacado_nome' => 'Sacado Nome',
            'sacado_tipo_inscricao' => 'Sacado Tipo Inscricao',
            'sacado_documento' => 'Sacado Documento',
            'sacado_rua' => 'Sacado Rua',
            'sacado_numero' => 'Sacado Numero',
            'sacado_bairro' => 'Sacado Bairro',
            'sacado_cep' => 'Sacado Cep',
            'sacado_cidade' => 'Sacado Cidade',
            'sacado_uf' => 'Sacado Uf',
            'sacado_complemento' => 'Sacado Complemento',
            'juros_de_mora_por_dia_taxa' => 'Juros De Mora Por Dia Taxa',
            'numero_de_dias_para_baixa_devolucao' => 'Numero De Dias Para Baixa Devolucao',
            'remessa' => 'Remessa',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('nosso_numero', $this->nosso_numero);
        $criteria->compare('boleto_cedente_id', $this->boleto_cedente_id);
        $criteria->compare('data_documento', $this->data_documento, true);
        $criteria->compare('numero_documento', $this->numero_documento, true);
        $criteria->compare('especie_de_documento', $this->especie_de_documento, true);
        $criteria->compare('codigo_da_moeda', $this->codigo_da_moeda);
        $criteria->compare('aceite', $this->aceite, true);
        $criteria->compare('data_processamento', $this->data_processamento, true);
        $criteria->compare('codigo_da_carteira', $this->codigo_da_carteira);
        $criteria->compare('quantidade', $this->quantidade);
        $criteria->compare('valor_unitario', $this->valor_unitario);
        $criteria->compare('instrucoes_1', $this->instrucoes_1, true);
        $criteria->compare('instrucoes_2', $this->instrucoes_2, true);
        $criteria->compare('instrucoes_3', $this->instrucoes_3, true);
        $criteria->compare('instrucoes_4', $this->instrucoes_4, true);
        $criteria->compare('instrucoes_5', $this->instrucoes_5, true);
        $criteria->compare('data_vencimento', $this->data_vencimento, true);
        $criteria->compare('valor_boleto', $this->valor_boleto);
        $criteria->compare('valor_percentual_a_ser_concedido_do_desconto', $this->valor_percentual_a_ser_concedido_do_desconto);
        $criteria->compare('valor_do_abatimento', $this->valor_do_abatimento);
        $criteria->compare('outros_acrescimos', $this->outros_acrescimos);
        $criteria->compare('valor_cobrado', $this->valor_cobrado);
        $criteria->compare('sacado_nome', $this->sacado_nome, true);
        $criteria->compare('sacado_tipo_inscricao', $this->sacado_tipo_inscricao);
        $criteria->compare('sacado_documento', $this->sacado_documento, true);
        $criteria->compare('sacado_rua', $this->sacado_rua, true);
        $criteria->compare('sacado_numero', $this->sacado_numero, true);
        $criteria->compare('sacado_bairro', $this->sacado_bairro, true);
        $criteria->compare('sacado_cep', $this->sacado_cep, true);
        $criteria->compare('sacado_cidade', $this->sacado_cidade, true);
        $criteria->compare('sacado_uf', $this->sacado_uf, true);
        $criteria->compare('sacado_complemento', $this->sacado_complemento, true);
        $criteria->compare('juros_de_mora_por_dia_taxa', $this->juros_de_mora_por_dia_taxa, true);
        $criteria->compare('numero_de_dias_para_baixa_devolucao', $this->numero_de_dias_para_baixa_devolucao);
        $criteria->compare('remessa', $this->remessa);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BoletoActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function pago() {
        $criteria = new CDbCriteria;
        $criteria->select = 'count(*) > 0 AS "pago"';
        $criteria->addInCondition('codigo_de_movimento', [SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_LIQUIDACAO, SantanderConstants::CODIGOS_DE_MOVIMENTO_PARA_RETORNO_LIQUIDACAO_APOS_BAIXA_OU_LIQUIDACAO_TITULO_NAO_REGISTRADO]);
        $criteria->compare('boleto_id', $this->id, false);
        return intval(BoletoRetornoActiveRecord::model()->find($criteria)->pago);
    }

    public function vencido() {
        if ($this->pago()) {
            return false;
        } else {
            $today = new DateTime('');
            $dataVencimentoDate = new DateTime($this->data_vencimento);
            return !($dataVencimentoDate > $today);
        }
    }

    public function estaNaRemessa() {
        return $this->remessa != NULL;
    }

    public function removerDaRemessa() {
        $this->remessa = '';
        $this->save(true, ['remessa']);
    }

}
