<?php
namespace parallaxsolutions\yii2boletos\models\layouts\santander;
use parallaxsolutions\yii2boletos\models\layouts\cnab240\Layout240SegmentoU;
use parallaxsolutions\yii2boletos\models\layouts\IReadable;
use parallaxsolutions\yii2boletos\models\SantanderConstants;

class SantanderLayout240SegmentoU extends Layout240SegmentoU {

    public function __construct() {
        parent::__construct(IReadable::EOL_WIN);
        $this->codigo_do_banco_na_compensacao = SantanderConstants::CODIGO_DO_BANCO;
    }

    /**
     * @param string $input
     */
    public function read($input) {
        parent::read($input);
        $this->codigo_da_ocorrencia_do_sacado = (float) substr($input, 153, 4);
        $this->data_da_ocorrencia_do_sacado = (float) substr($input, 157, 8);
        unset($this->nosso_numero_banco_correspondente);
        $this->uso_exclusivo_febraban_cnab_1 = rtrim(substr($input, 213, 27));
    }

}
