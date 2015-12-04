<?php

class BoletoRetornoSantander extends BoletoRetornoActiveRecord implements IBoletoRetorno{

    public $conta_cobranca;

    protected function afterSave() {
        parent::afterSave();
       
        if ($this->scenario === 'insert' && !empty($this->conta_cobranca)) {
            $modelBoletoRetornoSantanderModel = new BoletoRetornoSantanderActiveRecord;
            $modelBoletoRetornoSantanderModel->boleto_retorno_id = $this->id;
            $modelBoletoRetornoSantanderModel->conta_cobranca = $this->conta_cobranca;
            $modelBoletoRetornoSantanderModel->save();
        }
    }

}
