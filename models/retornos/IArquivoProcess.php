<?php
namespace parallaxsolutions\yii2boletos\models\retornos;
interface IArquivoProcess {

    /**
     * @param ILayout $layout
     */
    public function processar(ILayout $layout);

    /**
     * @return Iterator
     */
    public function getMovimentosRetornoIterator();

    /**
     * @return int
     */
    public function movimentosRetornoCount();

    /**
     * @param int $index
     * @return IMovimentoRetorno $movimentoRetorno
     */
    public function MovimentoRetornoAt($index);

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function addMovimentoRetorno(IMovimentoRetorno $movimentoRetorno);

    /**
     * @param int  $index
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function insertMovimentoRetornoAt($index, IMovimentoRetorno $movimentoRetorno);

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function removeMovimentoRetorno(IMovimentoRetorno $movimentoRetorno);

    /**
     * @param int $index
     * @return IMovimentoRetorno
     */
    public function removeMovimentoRetornoAt($index);

    public function movimentoRetornosClear();

    /**
     * @param IMovimentoRetorno $movimentosRetorno
     * @return bool
     */
    public function movimentosRetornoContains(IMovimentoRetorno $movimentosRetorno);

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     * @return int
     */
    public function movimentosRetornoIndexOf(IMovimentoRetorno $movimentoRetorno);
}
