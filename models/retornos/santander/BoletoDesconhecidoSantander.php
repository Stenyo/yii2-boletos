<?php

class BoletoDesconhecidoSantander implements IBoletoDesconhecido {

    /**
     * @var int 
     */
    protected $numero_de_sequencia_segmento_t;

    /**
     * @var int 
     */
    protected $numero_de_sequencia_segmento_u;

    /**
     * @param IBoletoRetorno $boletoRetorno
     */
    public function processar(IBoletoRetorno $boletoRetorno) {
        if (empty(BoletoSantander::model()->findByAttributes(array('nosso_numero' => $boletoRetorno->nosso_numero)))) {
            $boletoDesconhecido = new BoletoDesconhecidoActiveRecord;
            $boletoDesconhecido->nosso_numero = $boletoRetorno->nosso_numero;
            $boletoDesconhecido->numero_de_sequencia_segmento_t = $this->getNumero_de_sequencia_segmento_t();
            $boletoDesconhecido->numero_de_sequencia_segmento_u = $this->getNumero_de_sequencia_segmento_u();
            $boletoDesconhecido->retorno_id = $boletoRetorno->retorno_id;
            $boletoDesconhecido->save();       
            return true;
        } else {
            return false;
        }
    }

    function getNumero_de_sequencia_segmento_t() {
        return $this->numero_de_sequencia_segmento_t;
    }

    function setNumero_de_sequencia_segmento_t($numero_de_sequencia_segmento_t) {
        $this->numero_de_sequencia_segmento_t = $numero_de_sequencia_segmento_t;
    }

    function getNumero_de_sequencia_segmento_u() {
        return $this->numero_de_sequencia_segmento_u;
    }

    function setNumero_de_sequencia_segmento_u($numero_de_sequencia_segmento_u) {
        $this->numero_de_sequencia_segmento_u = $numero_de_sequencia_segmento_u;
    }

}
