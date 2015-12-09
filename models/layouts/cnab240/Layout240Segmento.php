<?php
namespace parallaxsolutions\yii2boletos\models\layouts\cnab240;
use parallaxsolutions\yii2boletos\models\BaseModel;
use parallaxsolutions\yii2boletos\models\layouts\ILayoutSegmento;
use parallaxsolutions\yii2boletos\models\layouts\IReadable;
/**
 * @property int $codigo_do_banco_na_compensacao
 * @property int $lote_de_servico
 * @property int $tipo_de_registro
 * @property int $numero_sequencial_do_registro_no_lote
 * @property string $codigo_segmento_do_registro_detalhe
 * @property string $uso_exclusivo_febraban_cnab
 * @property int $codigo_de_movimento
 */
abstract class Layout240Segmento extends BaseModel implements ILayoutSegmento {

    const TIPO_DE_REGISTRO = 3;
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_P = 'P';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_Q = 'Q';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_R = 'R';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_S = 'S';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_T = 'T';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_U = 'U';
    const CODIGO_DO_SEGMENTO_DO_REGISTRO_Y = 'Y';

    protected $_lineFeed;

    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        $this->_lineFeed = $lineFeed;
        $this->tipo_de_registro = self::TIPO_DE_REGISTRO;
    }
    
    public function attributeNames() {
        return array(
            'codigo_do_banco_na_compensacao',
            'lote_de_servico',
            'tipo_de_registro',
            'numero_sequencial_do_registro_no_lote',
            'codigo_segmento_do_registro_detalhe',
            'uso_exclusivo_febraban_cnab',
            'codigo_de_movimento',
        );
    }

}
