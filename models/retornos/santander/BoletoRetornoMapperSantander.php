<?php

class BoletoRetornoMapperSantander implements IBoletoRetornoMapper {

    /**
     * @var ILayoutSegmentoT
     */
    protected $segmentoT;

    /**
     * @var ILayoutSegmentoU
     */
    protected $segmentoU;
    protected $retorno_id; // TODO GETTER SETTER

    /**
     * @return IBoletoRetorno
     */

    public function map() {

        $boletoRetornoSantander = new BoletoRetornoSantander;
        // Map segmento T
        foreach ($this->segmentoT->attributeNames() as $attr) {
            foreach ($boletoRetornoSantander->attributeNames() as $attr2) {
                if ($attr2 == $attr) {
                    switch ($attr) {
                        case 'data_do_vencimento_do_titulo':
                            $dateBd = DateTime::createFromFormat('dmY', str_pad($this->segmentoT->$attr, 8, '0', STR_PAD_LEFT));
                            $dateBd = $dateBd->format('Y-m-d');
                            $boletoRetornoSantander->$attr = $dateBd;
                            break;
                        case 'valor_nominal_do_titulo':
                        case 'valor_liquido_a_ser_creditado':
                        case 'valor_de_outras_despesas':
                        case 'valor_de_outros_creditos':
                        case 'valor_da_ocorrencia_do_sacado':
                        case 'valor_da_tarifa_custas':    
                            $boletoRetornoSantander->$attr = $this->segmentoT->$attr /100;
                            break;
                        default :
                            $boletoRetornoSantander->$attr = $this->segmentoT->$attr;
                    }
                }
            }
        }
        $fragmentacao = str_pad($this->segmentoT->identificacao_para_rejeicoes_tarifas_custas_liquidacoes_e_baixas, 10, '0', STR_PAD_LEFT);
        $boletoRetornoSantander->nosso_numero = substr_replace($this->segmentoT->identificacao_do_titulo, "", -1); // Remove digito verificador
        $boletoRetornoSantander->identificacao_para_reijeicoes = substr($fragmentacao, 0, 2);
        $boletoRetornoSantander->identificacao_para_tarifas = substr($fragmentacao, 2, 2);
        $boletoRetornoSantander->identificacao_para_custas = substr($fragmentacao, 3, 2);
        $boletoRetornoSantander->identificacao_para_liquidacaoes = substr($fragmentacao, 5, 2);
        $boletoRetornoSantander->identificacao_para_baixas = substr($fragmentacao, 8, 2);
        $boletoRetornoSantander->conta_cobranca = $this->segmentoT->conta_cobranca;
        //Map segmento U

        foreach ($this->segmentoU->attributeNames() as $attr) {
            foreach ($boletoRetornoSantander->attributeNames() as $attr2) {
                if ($attr2 == $attr) {
                    switch ($attr) {
                        case 'data_da_ocorrencia':
                        case 'data_da_efetivacao_do_credito':
                        case 'data_da_ocorrencia_do_sacado':
                            $dateBd = DateTime::createFromFormat('dmY', str_pad($this->segmentoU->$attr, 8, '0', STR_PAD_LEFT));
                            $dateBd = $dateBd->format('Y-m-d');
                            $boletoRetornoSantander->$attr = $dateBd;
                            break;
                        case 'juros_multa_encargos':
                        case 'valor_do_desconto_concedido':
                        case 'valor_do_abatimento_concedido_cancelado':
                        case 'valor_do_iof_recolhido':
                        case 'valor_pago_pelo_sacado':
                        case 'valor_liquido_a_ser_creditado':
                        case 'valor_de_outras_despesas':
                        case 'valor_de_outros_creditos':
                        case 'valor_da_ocorrencia_do_sacado':    
                            $boletoRetornoSantander->$attr = $this->segmentoU->$attr /100;
                            break;
                        default :
                            $boletoRetornoSantander->$attr = $this->segmentoU->$attr;
                    }
                }
            }
        }

        return $boletoRetornoSantander;
    }

    public function setSegmentoT(ILayoutSegmentoT $segmento) {
        $this->segmentoT = $segmento;
    }

    public function getSegmentoT() {
        return $this->segmentoU;
    }

    public function setSegmentoU(ILayoutSegmentoU $segmento) {
        $this->segmentoU = $segmento;
    }

    public function getSegmentoU() {
        return $this->segmentoU;
    }

}
