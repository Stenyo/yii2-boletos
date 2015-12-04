<?php

interface MapperArquivo240 {
    /**
     * @param ILayoutLoteTituloEmCobranca $lote
     * @param BoletoCedenteActiveRecord $cedente
     * @return ILayout
     */
    public function map(ILayoutLoteTituloEmCobranca $lote, BoletoCedenteActiveRecord $cedente);
}
