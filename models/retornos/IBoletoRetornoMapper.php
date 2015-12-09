<?php
namespace parallaxsolutions\yii2boletos\models\retornos;
interface IBoletoRetornoMapper {

    /**
     * @param ILayoutSegmentoT $segmento
     */
    public function setSegmentoT(ILayoutSegmentoT $segmento);

    /**
     * @return ILayoutSegmentoT
     */
    public function getSegmentoT();

    /**
     * @param ILayoutSegmentoU $segmento
     */
    public function setSegmentoU(ILayoutSegmentoU $segmento);

    /**
     * @return ILayoutSegmentoU
     */
    public function getSegmentoU();

    /**
     * @return IBoletoRetorno
     */
    public function map();
}
