<?php

/**
 * @todo
 * 
 * @property int $identificacao_registro_opcional
 * @property string $identificacao_do_cheque_1
 * @property string $identificacao_do_cheque_2
 * @property string $identificacao_do_cheque_3
 * @property string $identificacao_do_cheque_4
 * @property string $identificacao_do_cheque_5
 * @property int $identificacao_do_cheque_6
 * @property string $uso_exclusivo_febraban_cnab_1
 */
class Layout240SegmentoY05 extends Layout240Segmento implements IReadable, ILayoutSegmento {

    const IDENTIFICACAO_REGISTRO_OPCIONAL = 4;

    public function __construct() {
        $this->tipo_de_registro = Layout240Segmento::TIPO_DE_REGISTRO;
        $this->codigo_segmento_do_registro_detalhe = Layout240Segmento::CODIGO_DO_SEGMENTO_DO_REGISTRO_Y;
        $this->identificacao_registro_opcional = self::IDENTIFICACAO_REGISTRO_OPCIONAL;
        $this->uso_exclusivo_febraban_cnab_1 = str_repeat(' ', 17);
    }

    public function attributeNames() {
        return array_merge(parent::attributeNames(), array(
            'identificacao_registro_opcional',
            'identificacao_do_cheque_1',
            'identificacao_do_cheque_2',
            'identificacao_do_cheque_3',
            'identificacao_do_cheque_4',
            'identificacao_do_cheque_5',
            'identificacao_do_cheque_6',
            'uso_exclusivo_febraban_cnab_1',
        ));
    }

    public function read($input) {
        $linha = $input;
        $layout = new Layout240SegmentoY05;
        $layout->codigo_do_banco_na_compensacao = substr($linha, 1, 3);
        $layout->lote_de_servico = substr($linha, 4, 4);
        $layout->tipo_de_registro = substr($linha, 8, 1);
        $layout->numero_sequencial_do_registro_no_lote = substr($linha, 9, 5);
        $layout->codigo_segmento_do_registro_detalhe = substr($linha, 14, 1);
        $layout->uso_exclusivo_febraban_cnab = substr($linha, 15, 1);
        $layout->codigo_de_movimento = substr($linha, 16, 2);
        $layout->identificacao_registro_opcional = substr($linha, 18, 2);
        $layout->identificacao_do_cheque_1 = substr($linha, 20, 34);
        $layout->identificacao_do_cheque_2 = substr($linha, 54, 34);
        $layout->identificacao_do_cheque_3 = substr($linha, 88, 34);
        $layout->identificacao_do_cheque_4 = substr($linha, 122, 34);
        $layout->identificacao_do_cheque_5 = substr($linha, 156, 34);
        $layout->identificacao_do_cheque_6 = substr($linha, 190, 34);
        $layout->uso_exclusivo_febraban_cnab_1 = substr($linha, 224, 17);
    }

}
