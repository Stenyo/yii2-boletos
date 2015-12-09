<?php
namespace parallaxsolutions\yii2boletos\models\layouts;

;
interface ILayout extends IRenderable, IReadable {

    /**
     * @return string
     */
    public function renderHeader();

    /**
     * @return string
     */
    public function renderTrailer();

    /**
     * @return string
     */
    public function renderLotes();

    /**
     * @param ILayoutLoteTituloEmCobranca $lote
     * @return string
     */
    public function renderLoteTituloEmCobranca(ILayoutLoteTituloEmCobranca $lote);

    /**
     * @param string $input
     */
    public function readHeader($input);

    /**
     * @param string $input
     */
    public function readTrailer($input);

    /**
     * @param string $input
     * @return ILayoutLote[] Description
     */
    public function readLotes($input);

    /**
     * @param string $input
     * @return ILayoutLoteTituloEmCobranca
     */
    public function readLoteTituloEmCobranca($input);

    /**
     * @return Iterator
     */
    public function getLotesIterator();

    /**
     * @return int
     */
    public function lotesCount();

    /**
     * @param int $index
     * @return ILayoutLote
     */
    public function loteAt($index);

    /**
     * @param ILayoutLote $lote
     * @return int
     */
    public function addLote(ILayoutLote $lote);

    /**
     * @param int $index
     * @param ILayoutLote $lote
     */
    public function insertLoteAt($index, ILayoutLote $lote);

    /**
     * @param ILayoutLote $lote
     * @return int|bool
     */
    public function removeLote(ILayoutLote $lote);

    /**
     * @param int $index
     * @return ILayoutLote
     */
    public function removeLoteAt($index);

    /**
     */
    public function lotesClear();

    /**
     * @param ILayoutLote $lote
     * @return bool
     */
    public function lotesContains(ILayoutLote $lote);

    /**
     * @param ILayoutLote $lote
     * @return int
     */
    public function lotesIndexOf(ILayoutLote $lote);
}
