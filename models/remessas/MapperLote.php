<?php


interface MapperLote {
    /**
     * @param BoletoCedenteActiveRecord $cedente
     * @param ILayoutSegmento $segmentos
     * return ILayoutLote
     */
    public function map(BoletoCedenteActiveRecord $cedente,$segmentos);
    
}
