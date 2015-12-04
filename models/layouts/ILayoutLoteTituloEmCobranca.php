<?php

interface ILayoutLoteTituloEmCobranca extends ILayoutLote {

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
    public function renderSegmentos();

    /**
     * @param string $input
     */
    public function read($input);

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
     * @return ILayoutSegmento[]
     * @throws LayoutReaderException
     */
    public function readSegmentos($input);

    /**
     * @param string $input
     * @return ILayoutSegmentoT
     */
    public function readSegmentoT($input);

    /**
     * @param string $input
     * @return ILayoutSegmentoU
     */
    public function readSegmentoU($input);
}
