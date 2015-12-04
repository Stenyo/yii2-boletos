<?php

/**
 * @todo
 */
class Layout240SegmentoS extends Layout240Segmento implements IRenderable, ILayoutSegmento {

    const TIPO_DE_IMPRESSAO_FRENTE_DO_BLOQUETO = 1;
    const TIPO_DE_IMPRESSAO_VERSO_DO_BLOQUETO = 2;
    const TIPO_DE_IMPRESSAO_CORPO_DE_INSTRUCAO_DA_FICHA_DE_COMPENSACAO_DO_BLOQUETO = 3;

    /**
     *
     * @var Layout240SegmentoSImpressao1|Layout240SegmentoSImpressao2
     */
    protected $_impressao;

    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        parent::__construct($lineFeed);
        $this->tipo_de_registro = Layout240Segmento::TIPO_DE_REGISTRO;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_S;
        $this->uso_exclusivo_febraban_cnab = str_repeat(' ', 1);
    }

    public function setImpressao(IRenderable $_impressao) {
        $this->_impressao = $_impressao;
    }

    public function rules() {
        return parent::rules();
    }

    public function render() {
        $out = '';
        $out .= str_pad($this->codigo_do_banco_na_compensacao, 3, '0', STR_PAD_LEFT);
        $out .= str_pad($this->lote_de_servico, 4, '0', STR_PAD_LEFT);
        $out .= str_pad($this->tipo_de_registro, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->numero_sequencial_do_registro_no_lote, 5, '0', STR_PAD_LEFT);
        $out .= str_pad($this->codigo_segmento_do_registro_detalhe, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 1, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->codigo_de_movimento, 2, '0', STR_PAD_LEFT);
        $out .= $this->_impressao->render();
        $out .= $this->_lineFeed;
        return $out;
    }

}
