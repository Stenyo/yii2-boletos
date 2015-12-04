<?php

abstract class ArquivoProcess240 implements IArquivoProcess {

    /**
     * @var CList
     */
    protected $movimentosRetorno;

    public function __construct() {
        $this->movimentosRetorno = new CList;
    }

   
    /**
     * @return Iterator
     */
    public function getMovimentosRetornoIterator(){
        return $this->movimentosRetorno->getIterator();
    }

    /**
     * @return int
     */
    public function movimentosRetornoCount(){
        return $this->movimentosRetorno->count();
    }

    /**
     * @param int $index
     * @return IMovimentoRetorno $movimentoRetorno
     */
    public function MovimentoRetornoAt($index){
        return $this->movimentosRetorno->itemAt($index);
    }

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function addMovimentoRetorno(IMovimentoRetorno $movimentoRetorno){
        return $this->movimentosRetorno->add($movimentoRetorno);
    }

    /**
     * @param int  $index
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function insertMovimentoRetornoAt($index, IMovimentoRetorno $movimentoRetorno){
        $this->movimentosRetorno->insertAt($index, $movimentoRetorno);
    }

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     */
    public function removeMovimentoRetorno(IMovimentoRetorno $movimentoRetorno){
        $this->movimentosRetorno->remove($movimentoRetorno);
    }

    /**
     * @param int $index
     * @return IMovimentoRetorno
     */
    public function removeMovimentoRetornoAt($index){
        return $this->movimentosRetorno->removeAt($index);
    }

    public function movimentoRetornosClear(){
        $this->movimentosRetorno->clear();
    }

    /**
     * @param IMovimentoRetorno $movimentosRetorno
     * @return bool
     */
    public function movimentosRetornoContains(IMovimentoRetorno $movimentosRetorno){
       return $this->movimentosRetorno->contains($movimentosRetorno);
    }

    /**
     * @param IMovimentoRetorno $movimentoRetorno
     * @return int
     */
    public function movimentosRetornoIndexOf(IMovimentoRetorno $movimentoRetorno){
        return $this->movimentosRetorno->indexOf($movimentoRetorno);
    }

}
