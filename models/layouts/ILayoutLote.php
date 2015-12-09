<?php
namespace parallaxsolutions\yii2boletos\models\layouts;
interface ILayoutLote extends IRenderable, IReadable {

    /**
     * @return Iterator
     */
    public function getSegmentosIterator();

    /**
     * @return int
     */
    public function segmentosCount();

    /**
     * @param int $index
     * @return ILayoutSegmento
     */
    public function segmentoAt($index);

    /**
     * @param ILayoutSegmento $segmento
     * @return int
     */
    public function addSegmento(ILayoutSegmento $segmento);

    /**
     * @param int $index
     * @param ILayoutSegmento $segmento
     */
    public function insertSegmentoAt($index, ILayoutSegmento $segmento);

    /**
     * @param ILayoutSegmento $segmento
     * @return int|bool
     */
    public function removeSegmento(ILayoutSegmento $segmento);

    /**
     * @param int $index
     * @return ILayoutSegmento
     */
    public function removeSegmentoAt($index);

    /**
     */
    public function segmentosClear();

    /**
     * @param ILayoutSegmento $segmento
     * @return bool
     */
    public function segmentosContains(ILayoutSegmento $segmento);

    /**
     * @param ILayoutSegmento $segmento
     * @return int
     */
    public function segmentosIndexOf(ILayoutSegmento $segmento);
}
