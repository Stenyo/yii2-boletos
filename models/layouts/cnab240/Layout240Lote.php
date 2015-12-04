<?php

abstract class Layout240Lote extends BaseModel implements ILayoutLote {

    /**
     * @var string 
     */
    protected $_lineFeed;

    /**
     * @var CList
     */
    protected $_segmentos;

    /**
     * @param string $lineFeed
     */
    public function __construct($lineFeed = IReadable::EOL_UNIX) {
        $this->_lineFeed = $lineFeed;
        $this->_segmentos = new CList;
    }

    /**
     * @return Iterator
     */
    public function getSegmentosIterator() {
        return $this->_segmentos->getIterator();
    }

    /**
     * @return int
     */
    public function segmentosCount() {
        return $this->_segmentos->count();
    }

    /**
     * @param int $index
     * @return ILayoutSegmento
     */
    public function segmentoAt($index) {
        return $this->_segmentos->itemAt($index);
    }

    /**
     * @param ILayoutSegmento $segmento
     * @return int
     */
    public function addSegmento(ILayoutSegmento $segmento) {
        return $this->_segmentos->add($segmento);
    }

    /**
     * @param int $index
     * @param ILayoutSegmento $segmento
     */
    public function insertSegmentoAt($index, ILayoutSegmento $segmento) {
        $this->_segmentos->insertAt($index, $segmento);
    }

    /**
     * @param ILayoutSegmento $segmento
     * @return int|bool
     */
    public function removeSegmento(ILayoutSegmento $segmento) {
        return $this->_segmentos->remove($segmento);
    }

    /**
     * @param int $index
     * @return ILayoutSegmento
     */
    public function removeSegmentoAt($index) {
        return $this->_segmentos->removeAt($index);
    }

    /**
     */
    public function segmentosClear() {
        $this->_segmentos->clear();
    }

    /**
     * @param ILayoutSegmento $segmento
     * @return bool
     */
    public function segmentosContains(ILayoutSegmento $segmento) {
        return $this->_segmentos->contains($segmento);
    }

    /**
     * @param ILayoutSegmento $segmento
     * @return int
     */
    public function segmentosIndexOf(ILayoutSegmento $segmento) {
        return $this->_segmentos->indexOf($segmento);
    }

}
