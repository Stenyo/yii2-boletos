<?php

/**
 * @todo
 * 
 * @property string $identificacao_da_impressao
 * @property string $mensagem_5
 * @property string $mensagem_6
 * @property string $mensagem_7
 * @property string $mensagem_8
 * @property string $mensagem_9
 * @property string $uso_exclusivo_febraban_cnab
 */
class Layout240SegmentoSImpressao2 extends BaseModel implements IRenderable {

    public function __construct() {
        $this->identificacao_da_impressao = 2;
        $this->uso_exclusivo_febraban_cnab = str_repeat(' ', 22);
    }

    function __set($propriedade, $valor) {
        switch ($propriedade) {
            case 'mensagem_5':
            case 'mensagem_6':
            case 'mensagem_7':
            case 'mensagem_8':
            case 'mensagem_9':
                $this->$propriedade = strtoupper(Utils::removeAcentos(substr($valor, 0, 40)));
                break;
            default :
                $this->$propriedade = $valor;
        }
    }
    
    public function attributeNames() {
        return array(
            'identificacao_da_impressao',
            'mensagem_5',
            'mensagem_6',
            'mensagem_7',
            'mensagem_8',
            'mensagem_9',
            'uso_exclusivo_febraban_cnab',
        );
    }

    public function render() {
        $out = '';
        $out .= str_pad($this->identificacao_da_impressao, 1, '0', STR_PAD_LEFT);
        $out .= str_pad($this->mensagem_5, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_6, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_7, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_8, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->mensagem_9, 40, ' ', STR_PAD_RIGHT);
        $out .= str_pad($this->uso_exclusivo_febraban_cnab, 22, ' ', STR_PAD_RIGHT);
        return $out;
    }
   

}
