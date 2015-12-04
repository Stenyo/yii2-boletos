<?php

interface MapperSegmento {
    /**
     * @param int $remessa
     * @param IBoletoRetorno $iboleto
     * @param int $numero_sequencial
     * @param BoletoCedenteActiveRecord $cedente
     */
    public function map($remessa, BoletoActiveRecord $iboleto,$numero_sequencial, BoletoCedenteActiveRecord $cedente);
}
