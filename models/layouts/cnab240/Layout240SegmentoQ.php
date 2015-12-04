<?php

/**
 * @property int $tipo_de_inscricao_do_sacado
 * @property int $numero_de_inscricao_do_sacado
 * @property string $nome
 * @property string $endereco
 * @property string $bairro
 * @property int $cep
 * @property int $sufixo_do_cep
 * @property string $cidade
 * @property string $unidade_da_federacao
 * @property int $tipo_de_inscricao_sacador_avalista
 * @property int $numero_de_inscricao_sacador_avalista
 * @property string $nome_do_sacador_avalista
 * @property int $codigo_do_banco_correspondente_na_compensacao
 * @property string $nosso_numero_no_banco_correspodente
 * @property string $uso_exclusivo_febraban_cnab_1
 */
class Layout240SegmentoQ extends Layout240Segmento implements IRenderable, ILayoutSegmentoQ {

    /**
     * @param string $lineFeed
     */
    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->tipo_de_registro = Layout240Segmento::TIPO_DE_REGISTRO;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_Q;
    }

    function __set($propriedade, $valor) {
        switch ($propriedade) {
            case 'nome':
            case 'endereco':
                $this->$propriedade = strtoupper(Utils::removeAcentos(substr($valor, 0, 40)));
                break;
            case 'bairro':
            case 'cidade':
                $this->$propriedade = strtoupper(Utils::removeAcentos(substr($valor, 0, 15)));
                break;
            default :
                $this->$propriedade = $valor;
        }
    }

    public function rules() {
        return parent::rules() + array(
            array('tipo_de_inscricao_do_sacado,numero_de_inscricao_do_sacado,nome,endereco,bairro,cep,sufixo_do_cep,cidade,unidade_da_federacao,tipo_de_inscricao_sacador_avalista,numero_de_inscricao_sacador_avalista,nome_do_sacador_avalista,codigo_do_banco_correspondente_na_compensacao,nosso_numero_no_banco_correspodente,uso_exclusivo_febraban_cnab_2', 'required'),
            array('tipo_de_inscricao_do_sacado', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('tipo_de_inscricao_do_sacado', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('nome', 'length', 'min' => 0, 'max' => 40),
            array('endereco', 'length', 'min' => 0, 'max' => 40),
            array('bairro', 'length', 'min' => 0, 'max' => 15),
            array('cep', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 99999),
            array('sufixo_do_cep', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999),
            array('cidade', 'length', 'min' => 0, 'max' => 15),
            array('unidade_da_federacao', 'length', 'min' => 2, 'max' => 2),
            array('tipo_de_inscricao_sacador_avalista', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 9),
            array('numero_de_inscricao_sacador_avalista', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999999999999999),
            array('nome_do_sacador_avalista', 'length', 'min' => 0, 'max' => 40),
            array('codigo_do_banco_correspondente_na_compensacao', 'numerical', 'integerOnly' => true, 'min' => 0, 'max' => 999),
            array('nosso_numero_no_banco_correspodente', 'length', 'min' => 20, 'max' => 20),
            array('uso_exclusivo_febraban_cnab_1', 'length', 'min' => 8, 'max' => 8),
        );
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'tipo_de_inscricao_do_sacado',
            'numero_de_inscricao_do_sacado',
            'nome',
            'endereco',
            'bairro',
            'cep',
            'sufixo_do_cep',
            'cidade',
            'unidade_da_federacao',
            'tipo_de_inscricao_sacador_avalista',
            'numero_de_inscricao_sacador_avalista',
            'nome_do_sacador_avalista',
            'codigo_do_banco_correspondente_na_compensacao',
            'nosso_numero_no_banco_correspodente',
            'uso_exclusivo_febraban_cnab_1',
        ));
    }

    /**
     * @return string
     */
    public function render() {
        $out = '';
        $out .= str_pad($this->codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_sequencial_do_registro_no_lote, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_segmento_do_registro_detalhe, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_de_movimento, 2, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_inscricao_do_sacado, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_de_inscricao_do_sacado, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->nome, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->endereco, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->bairro, 15, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->cep, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->sufixo_do_cep, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->cidade, 15, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->unidade_da_federacao, 2, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->tipo_de_inscricao_sacador_avalista, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_de_inscricao_sacador_avalista, 15, '0', STR_PAD_LEFT);
        $out .= str_pad($this->nome_do_sacador_avalista, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_do_banco_correspondente_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->nosso_numero_no_banco_correspodente, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab_1, 8, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

}
