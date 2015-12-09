<?php

/**
 * @property int $header_codigo_do_banco_na_compensacao
 * @property int $header_lote_de_servico
 * @property int $header_tipo_de_registro
 * @property string $header_uso_exclusivo_febraban_cnab_1
 * @property int $header_tipo_de_inscricao_da_empresa
 * @property int $header_numero_de_inscricao_da_empresa
 * @property string $header_codigo_do_convenio_no_banco
 * @property int $header_agencia_mantenedora_da_conta
 * @property string $header_digito_verificador_da_agencia
 * @property int $header_numero_da_conta_corrente
 * @property string $header_digito_verificador_da_conta
 * @property string $header_digito_verificador_da_agencia_conta
 * @property string $header_nome_da_empresa
 * @property string $header_nome_do_banco
 * @property string $header_uso_exclusivo_febraban_cnab_2
 * @property int $header_codigo_remessa_retorno
 * @property int $header_data_de_geracao_do_arquivo
 * @property int $header_hora_de_geracao_do_arquivo
 * @property int $header_numero_sequencial_do_arquivo
 * @property int $header_numero_da_versao_do_layout_do_arquivo
 * @property int $header_densidade_de_gravacao_do_arquivo
 * @property string $header_para_uso_reservado_do_banco
 * @property string $header_para_uso_reservado_da_empresa
 * @property string $header_uso_exclusivo_febraban_cnab_3
 * @property int $trailer_codigo_do_banco_na_compensacao
 * @property int $trailer_lote_de_servico
 * @property int $trailer_tipo_de_registro
 * @property string $trailer_uso_exclusivo_febraban_cnab_1
 * @property int $trailer_quantidade_de_lotes_de_arquivo
 * @property int $trailer_quantidade_de_registros_do_arquivo
 * @property int $trailer_quantidade_de_contas_para_conciliacao_lotes
 * @property string $trailer_uso_exclusivo_febraban_cnab_2
 */
class Layout240 extends BaseModel implements ILayout {

    const HEADER_LOTE_DE_SERVICO = 0;
    const HEADER_TIPO_DE_REGISTRO = 0;
    const NUMERO_DA_VERSAO_DO_LAYOUT_DO_ARQUIVO = 90;
    const TRAILER_LOTE_DE_SERVICO = 9999;
    const TRAILER_TIPO_DE_REGISTRO = 9;

    /**
     * @var string
     */
    protected $_lineFeed;

    /**
     * @var int
     */
    protected $incrementoQuantidadeDeRegistro = 0;

    /**
     * @var CList
     */
    protected $_lotes;

    /**
     * @param string $lineFeed
     */
    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        $this->_lineFeed = $lineFeed;
        $this->_lotes = new CList;

        $this->header_lote_de_servico = self::HEADER_LOTE_DE_SERVICO;
        $this->header_tipo_de_registro = self::HEADER_TIPO_DE_REGISTRO;
        $this->header_numero_da_versao_do_layout_do_arquivo = self::NUMERO_DA_VERSAO_DO_LAYOUT_DO_ARQUIVO;

        $this->trailer_lote_de_servico = self::TRAILER_LOTE_DE_SERVICO;
        $this->trailer_tipo_de_registro = self::TRAILER_TIPO_DE_REGISTRO;
        $this->trailer_quantidade_de_lotes_de_arquivo = 0;
        $this->trailer_quantidade_de_registros_do_arquivo = 0;
    }

    function __set($propriedade, $valor) {
        switch ($propriedade) {
            case 'header_nome_da_empresa':
                $this->header_nome_da_empresa = strtoupper(substr($valor, 0, 30));
                break;
            default :
                $this->$propriedade = $valor;
        }
    }

    public function attributeNames() {
        return array(
            'header_codigo_do_banco_na_compensacao',
            'header_lote_de_servico',
            'header_tipo_de_registro',
            'header_uso_exclusivo_febraban_cnab_1',
            'header_tipo_de_inscricao_da_empresa',
            'header_numero_de_inscricao_da_empresa',
            'header_codigo_do_convenio_no_banco',
            'header_agencia_mantenedora_da_conta',
            'header_digito_verificador_da_agencia',
            'header_numero_da_conta_corrente',
            'header_digito_verificador_da_conta',
            'header_digito_verificador_da_agencia_conta',
            'header_nome_da_empresa',
            'header_nome_do_banco',
            'header_uso_exclusivo_febraban_cnab_2',
            'header_codigo_remessa_retorno',
            'header_data_de_geracao_do_arquivo',
            'header_hora_de_geracao_do_arquivo',
            'header_numero_sequencial_do_arquivo',
            'header_numero_da_versao_do_layout_do_arquivo',
            'header_densidade_de_gravacao_do_arquivo',
            'header_para_uso_reservado_do_banco',
            'header_para_uso_reservado_da_empresa',
            'header_uso_exclusivo_febraban_cnab_3',
            'trailer_codigo_do_banco_na_compensacao',
            'trailer_lote_de_servico',
            'trailer_tipo_de_registro',
            'trailer_uso_exclusivo_febraban_cnab_1',
            'trailer_quantidade_de_lotes_de_arquivo',
            'trailer_quantidade_de_registros_do_arquivo',
            'trailer_quantidade_de_contas_para_conciliacao_lotes',
            'trailer_uso_exclusivo_febraban_cnab_2',
        );
    }

    /**
     * @return string
     */
    public function render() {
        $out = '';
        $out .= $this->renderHeader();
        $out .= $this->renderLotes();
        $out .= $this->renderTrailer();
        return $out;
    }

    /**
     * @return string
     */
    public function renderHeader() {
        $out = '';
        $out .= str_pad($this->header_codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_1, 9, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_tipo_de_inscricao_da_empresa, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_de_inscricao_da_empresa, 14, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_codigo_do_convenio_no_banco, 20, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_agencia_mantenedora_da_conta, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_digito_verificador_da_agencia, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_da_conta_corrente, 12, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_digito_verificador_da_conta, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_digito_verificador_da_agencia_conta, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_nome_da_empresa, 30, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_nome_do_banco, 30, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_2, 10, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_codigo_remessa_retorno, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_data_de_geracao_do_arquivo, 8, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_hora_de_geracao_do_arquivo, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_sequencial_do_arquivo, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_numero_da_versao_do_layout_do_arquivo, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_densidade_de_gravacao_do_arquivo, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->header_para_uso_reservado_do_banco, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_para_uso_reservado_da_empresa, 20, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->header_uso_exclusivo_febraban_cnab_3, 29, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderTrailer() {
        $out = '';
        $out .= str_pad($this->trailer_codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_1, 9, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->trailer_quantidade_de_lotes_de_arquivo, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_quantidade_de_registros_do_arquivo, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_quantidade_de_contas_para_conciliacao_lotes, 6, '0', STR_PAD_LEFT);
        $out .= str_pad($this->trailer_uso_exclusivo_febraban_cnab_2, 205, ' ', STR_PAD_RIGHT);
        $out .= $this->_lineFeed;
        return $out;
    }

    /**
     * @return string
     */
    public function renderLotes() {
        $out = '';
        foreach ($this->_lotes as $lote) {
            $out .= $this->renderLoteTituloEmCobranca($lote);
        }
        return $out;
    }

    /**
     * @param ILayoutLoteTituloEmCobranca $lote
     * @return string
     */
    public function renderLoteTituloEmCobranca(ILayoutLoteTituloEmCobranca $lote) {
        $out = '';
        $out .= $lote->render();
        return $out;
    }

    /**
     * @param string $input
     */
    public function read($input) {
        $linhas = explode($this->_lineFeed, $input);
        unset($linhas[count($linhas) - 1]);

        $this->readHeader($linhas[0]);
        $this->readTrailer($linhas[count($linhas) - 1]);

        unset($linhas[0]);
        unset($linhas[count($linhas)]);

        $this->readLotes(implode($this->_lineFeed, array_values($linhas)) . $this->_lineFeed);
    }

    /**
     * @param string $input
     */
    public function readHeader($input) {
        $this->header_codigo_do_banco_na_compensacao = (float) substr($input, 0, 3);
        $this->header_lote_de_servico = (float) substr($input, 3, 4);
        $this->header_tipo_de_registro = (float) substr($input, 7, 1);
        $this->header_uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 8, 9));
        $this->header_tipo_de_inscricao_da_empresa = (float) substr($input, 17, 1);
        $this->header_numero_de_inscricao_da_empresa = (float) substr($input, 18, 14);
        $this->header_codigo_do_convenio_no_banco = rtrim(substr($input, 32, 20));
        $this->header_agencia_mantenedora_da_conta = (float) substr($input, 52, 5);
        $this->header_digito_verificador_da_agencia = rtrim(substr($input, 57, 1));
        $this->header_numero_da_conta_corrente = (float) substr($input, 58, 12);
        $this->header_digito_verificador_da_conta = rtrim(substr($input, 70, 1));
        $this->header_digito_verificador_da_agencia_conta = rtrim(substr($input, 71, 1));
        $this->header_nome_da_empresa = rtrim(substr($input, 72, 30));
        $this->header_nome_do_banco = rtrim(substr($input, 102, 30));
        $this->header_uso_exclusivo_febraban_cnab_2 = rtrim(substr($input, 132, 10));
        $this->header_codigo_remessa_retorno = (float) substr($input, 142, 1);
        $this->header_data_de_geracao_do_arquivo = (float) substr($input, 143, 8);
        $this->header_hora_de_geracao_do_arquivo = (float) substr($input, 151, 6);
        $this->header_numero_sequencial_do_arquivo = (float) substr($input, 157, 6);
        $this->header_numero_da_versao_do_layout_do_arquivo = (float) substr($input, 163, 3);
        $this->header_densidade_de_gravacao_do_arquivo = (float) substr($input, 166, 5);
        $this->header_para_uso_reservado_do_banco = rtrim(substr($input, 171, 20));
        $this->header_para_uso_reservado_da_empresa = rtrim(substr($input, 191, 20));
        $this->header_uso_exclusivo_febraban_cnab_3 = rtrim(substr($input, 211, 29));
    }

    /**
     * @param string $input
     */
    public function readTrailer($input) {
        $this->trailer_codigo_do_banco_na_compensacao = (float) substr($input, 0, 3);
        $this->trailer_lote_de_servico = (float) substr($input, 3, 4);
        $this->trailer_tipo_de_registro = (float) substr($input, 7, 1);
        $this->trailer_uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 8, 9));
        $this->trailer_quantidade_de_lotes_de_arquivo = (float) substr($input, 17, 6);
        $this->trailer_quantidade_de_registros_do_arquivo = (float) substr($input, 23, 6);
        $this->trailer_quantidade_de_contas_para_conciliacao_lotes = (float) substr($input, 29, 6);
        $this->trailer_uso_exclusivo_febraban_cnab_2 = rtrim(substr($input, 35, 205));
    }

    /**
     * @param string $input
     * @return ILayoutLote[] Description
     */
    public function readLotes($input) {
        $linhas = explode($this->_lineFeed, $input);
        unset($linhas [count($linhas) - 1]);

        $lotes = array();

        $count = count($linhas);
        do {
            $lenght = intval(substr($linhas [$count - 1], 17, 6)) + $this->incrementoQuantidadeDeRegistro;

            $count -= $lenght;
            $loteInit = $count;

            $loteLines = implode($this->_lineFeed, array_slice($linhas, $loteInit, $lenght)) . $this->_lineFeed;

            $lote = $this->readLoteTituloEmCobranca($loteLines);
            $lotes[] = $lote;
        } while ($count > 0);

        return $lotes;
    }

    /**
     * @param string $input
     * @return ILayoutLoteTituloEmCobranca
     */
    public function readLoteTituloEmCobranca($input) {
        $lote = new Layout240LoteTitulosEmCobranca;
        $lote->read($input);
        $this->_lotes->insertAt(0, $lote);
        return $lote;
    }

    /**
     * @return Iterator
     */
    public function getLotesIterator() {
        return $this->_lotes->getIterator();
    }

    /**
     * @return int
     */
    public function lotesCount() {
        return $this->_lotes->count();
    }

    /**
     * @param int $index
     * @return ILayoutLote
     */
    public function loteAt($index) {
        return $this->_lotes->itemAt($index);
    }

    /**
     * @param ILayoutLote $lote
     * @return int
     */
    public function addLote(ILayoutLote $lote) {
        return $this->_lotes->add($lote);
    }

    /**
     * @param int $index
     * @param ILayoutLote $lote
     */
    public function insertLoteAt($index, ILayoutLote $lote) {
        $this->_lotes->insertAt($index, $lote);
    }

    /**
     * @param ILayoutLote $lote
     * @return int|bool
     */
    public function removeLote(ILayoutLote $lote) {
        return $this->_lotes->remove($lote);
    }

    /**
     * @param int $index
     * @return ILayoutLote
     */
    public function removeLoteAt($index) {
        return $this->_lotes->removeAt(
                        $index);
    }

    public function lotesClear() {
        $this->_lotes->clear();
    }

    /**
     * @param ILayoutLote $lote
     * @return bool
     */
    public function lotesContains(ILayoutLote $lote) {
        return $this->_lotes->contains($lote);
    }

    /**
     * @param ILayoutLote $lote
     * @return int
     */
    public function lotesIndexOf(ILayoutLote $lote) {
        return $this->_lotes->indexOf($lote);
    }

}
